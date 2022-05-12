<template>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <router-link to="/" class="navbar-brand">App-Vue</router-link>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">

                        <!-- for logged-in user-->
                        <div class="navbar-nav" v-if="isLoggedIn">
                            <li class="nav-item">
                                <router-link to="/dashboard" class="nav-link">Dashboard</router-link>
                            </li>
                            <li class="nav-item">
                                <router-link to="/books" class="nav-link">Books</router-link>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ name }}</a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item cursor-pointer" @click="logout">Logout</a>
                                </div>
                            </li>
                        </div>
                        <!-- for non-logged user-->
                        <div class="navbar-nav" v-else>
                            <li class="nav-item">
                                <router-link to="/" class="nav-link">Home</router-link>
                            </li>
                            <li class="nav-item">
                                <router-link to="/login" class="nav-link">Login</router-link>
                            </li>
                            <li class="nav-item">
                                <router-link to="/register" class="nav-link">Register</router-link>
                            </li>
                            <li class="nav-item">
                                <router-link to="/about" class="nav-link">About</router-link>
                            </li>
                        </div>
                    </ul>
                </div>

            </div>
        </nav>
        <div class="py-4">
            <div class="w-full max-w-screen-xl mx-auto px-6">
                <router-view/>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "App",
    data() {
        return {
            isLoggedIn: false,
            name: 'asd',
        }
    },
    created() {
        if (window.Laravel.isLoggedin) {
            this.isLoggedIn = true,
            this.name = window.Laravel.user.name;
        }
    },
    methods: {
        logout(e) {
            console.log('ss')
            e.preventDefault()
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post('/api/logout')
                    .then(response => {
                        if (response.data.success) {
                            window.location.href = "/"
                        } else {
                            console.log(response)
                        }
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            })
        }
    },
}
</script>