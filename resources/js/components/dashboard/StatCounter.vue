<template>
    <div class="flex items-center flex-col w-full sm:w-40 md:w-48 lg:w-64 hover:shadow-lg bg-white rounded shadow pt-5 pb-10 mb-10">
        <i :class="[icon, fgColor, bgColor]" class="fas text-2xl mb-2 p-4 rounded-full"></i>
        <h4 class="font-bold text-5xl">21.2k</h4>
        <p class="text-gray-600">Total Followers</p>
    </div>
</template>

<script>
  export default {
    name: 'StatCounter',

    props: ['icon', 'fgColor', 'bgColor'],
  }
</script>

<style scoped>

</style>
