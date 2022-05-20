<template>
    <div>ini demo p</div>
    <Userpage />
</template>

<script>
    import { defineComponent, defineAsyncComponent } from "vue";
    export default {
        data() {
            return {
                name : this.$route.params.name,
                demo : '',
                componentPath: '',
            }
        },
        created(){
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.get(`/api/template/get-demo/${this.$route.params.name}`)
                    .then(response => {
                        this.demo = response.data;
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            });
        },
        computed: {
            userPage: function(){
              return import('../components/Uploads/tes1.vue');
            }
        }
    }
</script>