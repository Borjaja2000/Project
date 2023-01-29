<template>
    <div class="relative flex flex-col items-center justify-center min-h-screen">
        <span v-for="value in errors.email" class="px-2 py-2 mb-4 text-red-600 rounded shadow">
             {{value}}
        </span>
            <span v-for="value in errors.password" class="px-2 py-2 mb-4 text-red-600 rounded shadow">
             {{value}}
    </span>
        <div class="w-full p-6 shadow bg-gray-50 lg:w-1/3">
            <h1 class="text-3xl font-semibold text-center text-sky-700 mb-5">Register</h1>
            <form class="space-y-4" @submit.prevent="submit">
                <div>
                    <label for="name" class="block text-sm text-gray-800">Name</label>
                    <input
                        v-model="fields.name"
                        id="name"
                        type="text"
                        class="block w-full px-4 py-2 mt-2 text-purple-700 bg-white border rounded-md focus:border-purple-400 focus:ring-purple-300 focus:outline-none focus:ring focus:ring-opacity-40"
                    />
                </div>
                <div>
                    <label for="email" class="block text-sm text-gray-800">Email</label>
                    <input
                        v-model="fields.email"
                        id="email"
                        type="email"
                        class="block w-full px-4 py-2 mt-2 text-purple-700 bg-white border rounded-md focus:border-purple-400 focus:ring-purple-300 focus:outline-none focus:ring focus:ring-opacity-40"
                    />
                </div>
                <div>
                    <label for="password" class="block text-sm text-gray-800"
                    >Password</label
                    >
                    <input
                        v-model="fields.password"
                        id="password"
                        type="password"
                        class="block w-full px-4 py-2 mt-2 text-purple-700 bg-white border rounded-md focus:border-purple-400 focus:ring-purple-300 focus:outline-none focus:ring focus:ring-opacity-40"
                    />
                </div>
                <div>
                    <label for="password" class="block text-sm text-gray-800">
                        Repeat Password
                    </label>
                    <input
                        v-model="fields.password_confirmation"
                        id="password_confirmation"
                        type="password"
                        class="block w-full px-4 py-2 mt-2 text-purple-700 bg-white border rounded-md focus:border-purple-400 focus:ring-purple-300 focus:outline-none focus:ring focus:ring-opacity-40"
                    />
                </div>
                <div>
                    <button
                        class="w-full px-4 py-2 tracking-wide text-white transition-colors duration-200 transform bg-sky-800 rounded-md hover:bg-sky-700 focus:outline-none focus:bg-sky-700">
                        Create Account
                    </button>
                </div>
            </form>
            <p class="mt-8 text-xs font-light text-center text-gray-700">
                Don't have an account?

                <RouterLink
                    to="/login"
                    class="font-medium text-sky-700 hover:underline"
                >Login</RouterLink>
            </p>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            fields: {},
            errors: {},
        };
    },
    methods: {
        submit() {
            axios
                .post("/register", this.fields)
                .then(() => {
                    this.$router.push('login');
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                });
        },
    },
};
</script>
