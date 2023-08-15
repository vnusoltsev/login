<script>
export default {
    name: "Login as user",
    props: [
        'link',
        'errors'
    ],
    data() {
        return {
            email: '',
            secretKey: '',
        }
    },
    methods: {
        submit() {
            this.$inertia.post('/login-as-user', {email: this.email, secretKey: this.secretKey})
        }
    }
}
</script>
<template>
    <div class="w-96 mx-auto pt-8">
        <h1 class="text-lg">Log in as user</h1>
        <form @submit.prevent="submit">
            <div class="mb-4">
                <input v-model="email" class="w-full" type="text" placeholder="email">
            </div>
            <div class="mb-4">
                <input v-model="secretKey" class="w-full" type="text" placeholder="secret key">
            </div>
            <div>
                <button
                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                    type="submit">Login</button>
            </div>
        </form>
        <div v-if="errors">
            <div class="mt-8 pt-8 border-t border-gray-400" v-for="error in errors">
                <div>{{error}}</div>
            </div>
        </div>
    </div>
</template>

