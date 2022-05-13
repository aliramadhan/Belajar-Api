<template>
    <div class="relative overflow-hidden mb-8">
        <div class="rounded-t-lg overflow-hidden border-t border-l border-r border-gray-400 flex justify-center p-8">
          <form class="w-full max-w-lg" @submit.prevent="addBook">
            <div class="flex flex-wrap -mx-3 mb-6">
              <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="book-name">
                  Book Name
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="book-name" type="text" placeholder="Harry Poter" v-model="book.name">
                <p class="text-red-500 text-xs italic" v-if="errors.name">{{ errors.name[0] }}</p>
              </div>
              <!--
              <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                  Last Name
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text" placeholder="Doe">
              </div>
                -->
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
              <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="author-name">
                  Author Name
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="author-name" type="text" placeholder="Mary Jane" v-model="book.author">
                <p class="text-red-500 text-xs italic" v-if="errors.author">{{ errors.author[0] }}</p>
              </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <button class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded" type="submit">
                      Add New Book
                    </button>
                </div>
            </div>
          </form>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            book: {},
            errors: []
        }
    },
    methods: {
        addBook() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post('/api/books/add', this.book)
                    .then(response => {
                        if (response.status === 200) {
                            this.$router.push({name: 'books', params: { success: "Air-conditioning" }});
                        }
                        else{
                            this.errors = response.data.errors;
                        }
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            })
        }
    },
    beforeRouteEnter(to, from, next) {
        if (!window.Laravel.isLoggedin) {
            window.location.href = "/";
        }
        next();
    }
}
</script>