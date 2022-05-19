<template>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <h4 class="text-center">All Design Template</h4><br/>
        <table class="min-w-full">
            <thead class="bg-white border-b">
            <tr>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">ID</th>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Name</th>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">IMG</th>
                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-if="!Array.isArray(designs)" class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                <td colspan="6" class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                    <button type="button" class="flex mx-auto items-center px-4 py-2 font-semibold leading-6 text-sm shadow rounded-md text-white bg-indigo-500 hover:bg-indigo-400 transition ease-in-out duration-150 cursor-not-allowed" disabled>
                      <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                      </svg>
                      Processing...
                    </button>
                </td>
            </tr>
            <tr v-for="design in designs" :key="design.id" class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ design.id }}</td>
                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ design.name }}</td>
                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"><img width="200" :src="design.filepath"></td>
                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'editbook', params: { id: design.id }}" class="btn btn-primary">Edit
                        </router-link>
                        <button class="btn btn-danger" @click="deleteBook(design.id)">Delete</button>
                    </div>
                </td>
            </tr>
            <!-- if empty -->
            <tr v-if="Array.isArray(designs) && designs.length < 1" class="text-center bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                <td colspan="6" class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">Empty Data</td>
            </tr>
            </tbody>
        </table>

        <button type="button" class="btn btn-info" @click="this.$router.push('/template/create')">Add new Template</button>
    </div>
</template>

<script>
import moment from 'moment';
export default {
    props: ["success"],
    data() {
        return {
            designs: null,
            moment: moment
        }
    },
    created() {
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
            this.$axios.get('/api/template')
                .then(response => {
                    this.designs = response.data;
                })
                .catch(function (error) {
                    console.error(error);
                });
        })
    },
    methods: {
        deleteBook(id) {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.delete(`/api/template/delete/${id}`)
                    .then(response => {
                        let i = this.designs.map(item => item.id).indexOf(id); // find index of your object
                        this.designs.splice(i, 1)
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