<template>
    <div class="relative flex flex-col items-center justify-center min-h-screen">
        <span v-if="message" class="px-2 py-2 mb-4 text-red-600 rounded shadow">
         {{message}}
    </span>
        <div class="w-full p-6 shadow bg-gray-50 lg:w-1/3 relative flex flex-col items-center">
            <h1 class="text-3xl font-semibold text-center text-sky-700 mb-5">Login</h1>
            <form @submit.prevent="submit" class="space-y-4 w-full flex flex-col items-center" >
                <div class="w-full">
                    <label for="email" class="block text-sm text-gray-800">Email</label>
                    <input
                        type="email"
                        id="email"
                        v-model="fields.email"
                        class="block w-full px-4 py-2 mt-2 text-purple-700 bg-white border rounded-md focus:border-purple-400 focus:ring-purple-300 focus:outline-none focus:ring focus:ring-opacity-40"
                    />
                </div>
                <div class="w-full">
                    <label for="password" class="block text-sm text-gray-800">Password</label>
                    <input
                        type="password"
                        :type="showPassword ? 'password' : 'text'"
                        id="password"
                        v-model="fields.password"
                        class="block w-full px-4 py-2 mt-2 text-purple-700 bg-white border rounded-md focus:border-purple-400 focus:ring-purple-300 focus:outline-none focus:ring focus:ring-opacity-40"
                    />

                </div>

                    <button
                        class="w-2/3 align-center justify-center px-4 py-2 tracking-wide text-white transition-colors duration-200 transform bg-sky-800 rounded-md hover:bg-sky-700 focus:outline-none focus:bg-sky-700">
                        Login
                    </button>

            </form>
            <p class="mt-8 text-xs font-light text-center text-gray-700">
                Don't have an account?
                <RouterLink
                    to="/register"
                    class="font-medium text-sky-700 hover:underline"
                >Register</RouterLink>
            </p>
            <div class="mt-5 align-content-center">
            <button type="button"
                    @click="loginProvider('google')"
                    class="w-45 text-center  tracking-wide text-white bg-[#4285F4] hover:bg-[#4285F4]/90 focus:ring-4 focus:outline-none focus:ring-[#4285F4]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#4285F4]/55 mb-2">
                <svg class="mr-2 -ml-1 w-4 h-4" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="google" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 488 512"><path fill="currentColor" d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z"></path></svg>
                Sign in with Google
            </button>
            <button type="button"
                    @click="loginProvider('facebook')"
                    class="w-45 ml-5 text-center text-white bg-[#3b5998] hover:bg-[#3b5998]/90 focus:ring-4 focus:outline-none focus:ring-[#3b5998]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#3b5998]/55 mb-2">
                <svg class="mr-2 -ml-1 w-4 h-4" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="facebook-f" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path fill="currentColor" d="M279.1 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.4 0 225.4 0c-73.22 0-121.1 44.38-121.1 124.7v70.62H22.89V288h81.39v224h100.2V288z"></path></svg>
                Sign in with Facebook
            </button>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    data() {
        return {
            fields: {},
            message: '',
            loading: false,
            showPassword:true,
        };
    },
    computed: {
        loggedIn() {
            // return this.$store.state.auth.status.loggedIn;
        },
    },
    created() {
        if (this.loggedIn) {
            this.$router.push("/profile");
        }
    },
    methods: {
        submit() {
            axios
                .post("/login", this.fields)
                .then((response) => {
                     if (response.data.token) {
                         localStorage.setItem('user', JSON.stringify(response.data));
                     }
                    this.message = response.data.message;
                    if(response.data.success){
                        this.$router.push('home');
                    }
                    return response.data;
                })
                .catch((error) => {
                    this.message = error.data.message;
                });
        },
        loginProvider(provider){
            window.location.href='login/'+provider;
        },
    },
};
</script>


