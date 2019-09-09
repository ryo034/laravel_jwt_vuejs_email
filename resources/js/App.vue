<template>
  <div class="container">
    <header>
      <Header />
    </header>
    <main>
      <div class="container">
        <div class="content">
          <router-view></router-view>
        </div>
      </div>
    </main>
    <Footer />
  </div>
</template>

<script>
import Header from './components/Header.vue'
import Footer from './components/Footer.vue'

export default {
    components: {
      Header,Footer
    },

    data: () => ({
    }),
    created() {
      this.$store.dispatch('auth/setUserInfo')
    },

    methods: {
    },
}
</script>
