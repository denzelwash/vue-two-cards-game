<template>
  <div class="container">
    <div class="b-form">
      <transition name="fade" mode="out-in">
        <form v-if="!loading" class="b-form__form" @submit.prevent="submit">
          <div class="b-form__top">
            <h2>Результат:</h2>
            <span>{{ time }} сек.</span>
          </div>
          <div class="b-form__group">
            <input v-model="name" type="text" required />
            <span class="highlight"></span>
            <span class="bar"></span>
            <label>Имя</label>
          </div>
          <button class="btn" type="submit">Сохранить</button>
        </form>
        <Loader v-else/>
      </transition>
    </div>
  </div>
</template>

<script>
  import Loader from '@/components/Loader.vue'

  export default {
    components: {
      Loader
    },
    props: ['complete', 'time'],
    data() {
      return {
        name: '',
        loading: false,
        recordId: null
      }
    },
    methods: {
      async submit() {
        this.loading = true
        try {
          const response = await fetch('http://1vue-two-cards/api/addResult.php', {
            method: 'POST',
            body: JSON.stringify({
              name: this.name,
              time: this.time,
              str: 'test'
            })
          })
          this.recordId = await response.text()
          this.loading = false
          this.name = ''
          this.$router.push({path: '/', query: {recordId: this.recordId}})
        } catch(e) {
          console.error(e)
          this.loading = false
        }
      }
    },
    beforeRouteEnter (to, from, next) {
      next(vm => {
        if(!vm.complete) {
          vm.$router.push('/')
        }
      })
    }
  }
</script>

<style lang="scss">

</style>