<template>
    <div>
        <div class="jumbotron mb-3">
            <form @submit.prevent="">
                <div class="input-group mt-3 justify-content-between">
                    <input class="form-control col-8" id="linkInput" name="original" placeholder="Shorten your link"
                           type="text" v-model="original">
                    <button @click="shorten()" class="btn btn-primary col-3" type="submit">Shorten!
                    </button>
                </div>
            </form>
        </div>

        <transition name="slide-fade">
            <div class="alert alert-info mb-3" role="alert" v-if="previousLinks.length > 1">
                Like our service? <a href="/register"><b>Sign up now</b></a> and get access to <b>analytics</b>, <b>custom
                links</b> and more!
            </div>
        </transition>
    </div>
</template>

<script>
  import linksClient from './../api/links'

  export default {
    data () {
      return {
        previousLinks: [],
        original: '',
      }
    },

    methods: {
      async shorten () {
        let link = {
          original: this.original
        }

        await linksClient.shorten(link).then((response) => {
          this.original = ''

          let {
            id,
            original,
            short
          } = response.data

          this.addToPreviousLinks({id, original, short})
        }).catch((error) => {
          this.$swal({
            type: 'error',
            title: 'Oops...',
            text: 'Please check your link and try again.',
          })
          console.log(error)
        })
      },

      addToPreviousLinks (link) {
        if (this.previousLinks.length >= 3) {
          let removed = this.previousLinks.splice(-1)
        }

        this.previousLinks.unshift(link)
      }
    },
  }
</script>

<style scoped>

</style>