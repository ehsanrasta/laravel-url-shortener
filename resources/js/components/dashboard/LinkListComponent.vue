<template>
    <table class="w-full">
        <thead>
        <tr class="uppercase text-gray-600 text-sm">
            <th class="text-left sm:w-1/3 md:w-1/4 pb-5">Original</th>
            <th class="text-left sm:w-1/3 md:w-1/4 pb-5">Short</th>
            <th class="text-left sm:w-1/3 md:w-1/4 pb-5">Clicks</th>
            <th class="text-left sm:w-1/3 md:w-1/4 pb-5 hidden md:block whitespace-no-wrap">Created at</th>
            <th class="text-right sm:w-1/3 pb-5"></th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(link, index) in links" class="text-gray-700" :class="{ 'text-purple-700' : isSelected(index) }">
            <td class="font-semibold subpixel-antialiased py-5">{{ link.original | truncate(30) }}</td>
            <td>{{ APP_URL }}/{{ link.short }}</td>
            <td>{{ link.totalClicks }}</td>
            <td class="hidden md:inline-block py-5 whitespace-no-wrap">{{ link.created_at | momentDay }}</td>
            <td class="text-right">
                <i class="far fa-eye inline cursor-pointer" @click="setSelected(link, index)"></i>
                <i class="far fa-file inline ml-5 cursor-pointer"></i>
            </td>
        </tr>
        </tbody>
    </table>
</template>

<script>
  export default {
    name: 'LinksListComponent',

    props: ['links'],

    data () {
      return {
        APP_URL: process.env.MIX_APP_URL,
        selectedIndex: null,
        selectedLink: null,
      }
    },
    methods: {
      setSelected(link, index) {
        this.selectedLink = link
        this.selectedIndex = index
        this.$emit('input', link)
      },
      isSelected(index) {
        return index === this.selectedIndex
      }
    }
  }
</script>

<style scoped>
</style>
