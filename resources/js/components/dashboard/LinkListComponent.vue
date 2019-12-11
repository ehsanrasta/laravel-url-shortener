<template>
    <table class="w-full whitespace-no-wrap">
        <thead>
        <tr class="uppercase text-gray-600 text-sm">
            <th class="text-left py-3 px-8">Original</th>
            <th class="text-left py-3 px-1">Short</th>
            <th class="text-right py-3 px-1">Clicks</th>
            <th class="text-right py-3 px-1">Created at</th>
            <th class="text-center py-3 px-1">View / Copy</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(link, index) in links" class="text-gray-600" :class="{ 'text-purple-700 font-semibold' : isSelected(index) }">
            <td class="py-3 px-8">{{ link.original | truncate(40) }}</td>
            <td class="py-3 px-1">{{ APP_URL }}/{{ link.short }}</td>
            <td class="text-right py-3 px-1">{{ link.totalClicks }}</td>
            <td class="text-right py-3 px-1">{{ link.created_at | momentDay }}</td>
            <td class="text-center py-3 px-1">
                <i class="far fa-eye inline cursor-pointer" @click="setSelected(index)"></i>
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
      }
    },

    methods: {
      setSelected (index) {
        this.selectedIndex = index
        this.$emit('input', this.links[index])
      },
      isSelected (index) {
        return index === this.selectedIndex
      }
    },

    mounted () {
      this.setSelected(0)
    }
  }
</script>

<style scoped>

</style>
