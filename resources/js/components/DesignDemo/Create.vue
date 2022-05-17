<template>
    <div class="relative overflow-hidden mb-8">
        <div class="rounded-t-lg overflow-hidden border-t border-l border-r border-gray-400 flex justify-center p-8">
          <form class="w-full max-w-lg" @submit.prevent="StoreDesign" enctype="multipart/form-data">
            <div class="flex flex-wrap -mx-3 mb-6">
              <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="design-name">
                    Name
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="design-name" type="text" placeholder="Harry Poter" v-model="design.name">
                <p class="text-red-500 text-xs italic" v-if="errors.name">{{ errors.name[0] }}</p>
              </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
              <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="file-name">
                  File
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="file-name" type="file" placeholder="Mary Jane" v-on:change="SelectedFile">
                <p class="text-red-500 text-xs italic" v-if="errors.file">{{ errors.file[0] }}</p>
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
            design: {
                name: null,
                file: null
            },
            errors: []
        }
    },
    methods: {
        SelectedFile(e){
            this.design.file = e.target.files[0];
        },
        StoreDesign() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post('/api/template/store', this.design)
                .then(response => {
                    if (response.status === 200) {
                        console.log(response.data);
                        //this.$router.push({name: 'design'});
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