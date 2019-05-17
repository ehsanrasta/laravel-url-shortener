<template>
    <div class="jumbotron">
        <form @submit.prevent="">
            <div class="input-group mt-3 justify-content-between">
                <input class="form-control col-8" id="linkInput" name="original" placeholder="Shorten your link"
                       type="text" v-model="linkText">
                <button @click="shorten()" class="btn btn-primary col-3" type="submit">Shorten!
                </button>
            </div>
        </form>
    </div>
</template>

<script>
  export default {
    data () {
      return {
        linkText: '',
      }
    },

    computed: {
      link () {
        return this.$store.state.link
      }
    },

    methods:
      {
        shorten () {
          var link = {
            original: this.linkText
          }

          if (!link.original.startsWith('http://') && !link.original.startsWith('https://')) {
            link.original = 'http://' + link.original
          }

          this.$store.dispatch('shorten', link).then(() => {
            this.linkText = ''
          }).catch((error) => {
            this.$swal({
              type: 'error',
              title: 'Oops...',
              text: 'Please check your link and try again.',
            })
          })
        },
      }
    ,
  }
</script>

<style scoped>

</style>