<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                

                <div class="card card-default">
                    <div class="card-header">Register</div>
                    <div class="card-body">
                        <form>
                            <div class="row mb-3">
                                <label for="name" class="col-sm-4 col-form-label text-md-right">Name</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" v-model="name" required autocomplete="email" autofocus placeholder="Fulan">
                                    <div class="text-red-500 text-xs italic" role="alert" v-if="errors.name">
                                        {{ errors.name[0] }}
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-sm-4 col-form-label text-md-right">Email</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" v-model="email" required autocomplete="email" autofocus placeholder="user@domain.com">
                                    <div class="text-red-500 text-xs italic" role="alert" v-if="errors.email">
                                        {{ errors.email[0] }}
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="password" class="col-sm-4 col-form-label text-md-right">Password</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" v-model="password" required autocomplete="email" autofocus placeholder="******************">
                                    <div class="text-red-500 text-xs italic" role="alert" v-if="errors.password">
                                        {{ errors.password[0] }}
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded" @click="handleSubmit">
                                        Register
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            name: "",
            email: "",
            password: "",
            errors: [],
        }
    },
    methods: {
        handleSubmit(e) {
            e.preventDefault()
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('api/register', {
                    name: this.name,
                    email: this.email,
                    password: this.password
                })
                    .then(response => {
                        if (response.data.success) {
                            window.location.href = "/login"
                        } else {
                            this.errors = response.data.errors
                            this.error = response.data.message;
                        }
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            })
        }
    },
    beforeRouteEnter(to, from, next) {
        if (window.Laravel.isLoggedin) {
            return next('dashboard');
        }
        next();
    }
}
</script>