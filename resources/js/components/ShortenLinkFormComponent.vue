<template>
    <div>
        <div class="jumbotron mb-3">
            <form @submit.prevent="">
                <div class="input-group mt-3 justify-content-between">
                    <input class="form-control col-8" id="linkInput" name="original" placeholder="Shorten your link"
                           type="text" v-model="linkText">
                    <button @click="shorten()" class="btn btn-primary col-3" type="submit">Shorten!
                    </button>
                </div>
            </form>
        </div>

        <transition name="slide-fade">
            <div class="alert alert-info mb-3" role="alert" v-if="numberOfShortenedLinks > 1">
                Like our service? <a href="/register"><b>Sign up now</b></a> and get access to <b>analytics</b>, <b>custom
                links</b> and more!
            </div>
        </transition>
    </div>
</template>

<script>
  export default {
    data () {
      return {
        numberOfShortenedLinks: 0,
        linkText: '',
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
            this.numberOfShortenedLinks++
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