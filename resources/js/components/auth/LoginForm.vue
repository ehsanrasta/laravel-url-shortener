<template>
    <div class="container flex">
        <form action="/login" method="POST" class="sm:w-2/3 md:w-2/3 lg:w-1/3 bg-white mx-auto shadow rounded px-8 pt-6 pb-8 mb-4">
            <input type="hidden" name="_token" :value="csrfToken">

            <h1 class="text-lg text-center text-gray-700 font-semibold subpixel-antialiased mb-4">Welcome Back!</h1>
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm
                    font-bold mb-2">
                    Email
                </label>
                <input type="text" id="email" name="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray">
            </div>
            <div class="mb-6">
                <label for="password" class="block text-gray-700 text-sm
                    font-bold mb-2">
                    Password
                </label>
                <input type="text" id="password" name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray">
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-purple-500 hover:bg-purple-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Sign in
                </button>
                <a href="password/reset" class="inline-block align-baseline font-bold text-sm text-purple-500 hover:text-purple-600">Forgot password?</a>
            </div>
        </form>

    </div>
</template>

<script>
  export default {
    name: 'LoginForm',

    data() {
      return {
        csrfToken : null,
      }
    },

    created() {
      this.csrfToken = document.querySelector('meta[name="csrf-token"]').content
    }
  }
</script>

<style scoped>

</style>
