<template>
    <div>
        <div v-for="(link, index) in links"
             class="group flex flex-row rounded mt-5 bg-white p-8 shadow w-full md:w-2/3 mx-auto items-center cursor-pointer pointer select-none"
             :class="{ 'selected' : isSelected(index) }"
             @click="setSelected(index)">

            <div class="flex flex-col items-center bg-purple-100 text-purple-500 p-3 rounded">
                <i class="fas fa-eye text-xl"></i>
                <p class="mt-1">{{ link.totalClicks }}</p>
            </div>
            <div class="flex flex-col ml-8">
                <a :href="'/' + link.short" class="text-purple-600 font-semibold hover:underline">{{ APP_URL }}/{{ link.short }}</a>
                <a :href="link.original" class="text-purple-500 mt-1 hover:underline">{{ link.original | truncate(30) }}</a>
            </div>
        </div>
    </div>
</template>

<script>
  export default {
    name: 'LinkList',

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
      },
    },

    mounted () {
      this.setSelected(0)
    }
  }
</script>

<style scoped>
    .selected {
        @apply bg-purple-600;
    }

    .selected a {
        @apply text-white;
    }
</style>
