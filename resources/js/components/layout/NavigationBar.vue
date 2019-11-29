<template>
    <header class="bg-white shadow p-3 sm:flex sm:justify-between">
        <div class="flex items-center justify-between">
            <!-- todo: make this go somewhere -->
            <a :href="APP_URL" class="text-purple-700 font-semibold subpixel-antialiased text-xl">Short.test</a>
            <div class="sm:hidden">
                <button @click="isOpen = !isOpen" type="button" class="block text-gray-500 hover:text-purple-700 focus:outline-none">
                    <svg class="h-6 w-6 fill-current" viewBox="0 0 24 24">
                        <path v-if="isOpen" fill-rule="evenodd" d="M18.278 16.864a1 1 0 0 1-1.414 1.414l-4.829-4.828-4.828 4.828a1 1 0 0 1-1.414-1.414l4.828-4.829-4.828-4.828a1 1 0 0 1 1.414-1.414l4.829 4.828 4.828-4.828a1 1 0 1 1 1.414 1.414l-4.828 4.829 4.828 4.828z"/>
                        <path v-if="!isOpen" fill-rule="evenodd" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"/>
                    </svg>
                </button>
            </div>
        </div>
        <div :class="isOpen ? 'block' : 'hidden'" class="pt-2 pb-4 sm:flex">
            <a :href="APP_URL + '/login'" class="block py-1 hover:text-purple-700 sm:py-0 sm:ml-5">Login</a>
            <a :href="APP_URL + '/register'" class="block py-1 hover:text-purple-700 sm:py-0 sm:ml-5">Register</a>
        </div>
    </header>
</template>

<script>
  export default {
    name: 'navigation-bar',

    data() {
      return {
        APP_URL: process.env.MIX_APP_URL,
        isOpen: false,
      }
    }
  }
</script>

<style scoped>

</style>
