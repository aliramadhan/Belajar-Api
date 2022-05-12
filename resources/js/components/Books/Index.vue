<template>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <h4 class="text-center">All Books</h4><br/>
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Author</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-if="!books.length" class="text-center">
                <td colspan="6">
                    <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                      <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full" :style="ProgressCount"> {{ timerCount }}%</div>
                    </div>
                </td>
            </tr>
            <tr v-for="book in books" :key="book.id">
                <td>{{ book.id }}</td>
                <td>{{ book.name }}</td>
                <td>{{ book.author }}</td>
                <td>{{ book.created_at }}</td>
                <td>{{ book.updated_at }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'editbook', params: { id: book.id }}" class="btn btn-primary">Edit
                        </router-link>
                        <button class="btn btn-danger" @click="deleteBook(book.id)">Delete</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>

        <button type="button" class="btn btn-info" @click="this.$router.push('/books/add')">Add Book</button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            books: [],
            timerCount: 1,
        }
    },
    watch: {

        timerCount: {
            handler(value) {

                if (value < 100) {
                    setTimeout(() => {
                        this.timerCount+=10;
                    }, 500);
                }

            },
            immediate: true // This ensures the watcher is triggered upon creation
        }

    },
    created() {
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
            this.$axios.get('/api/books')
                .then(response => {
                    this.books = response.data;
                })
                .catch(function (error) {
                    console.error(error);
                });
        })
    },
    methods: {
        deleteBook(id) {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.delete(`/api/books/delete/${id}`)
                    .then(response => {
                        let i = this.books.map(item => item.id).indexOf(id); // find index of your object
                        this.books.splice(i, 1)
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            })
        }
    },
    computed:{
        ProgressCount(){
            return{
                'width': this.timerCount+'%'
            }
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