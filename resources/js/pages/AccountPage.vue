<template>
  <div class="account-page-wrap">
    <div class="account-page-content">
      <div class="account-content">
        <div class="account-head">
          <h1>Your Accouts</h1>
          <div class="account-logout" v-on:click="logout">
            <p>sign out</p>
          </div>
        </div>
        <div class="account-info">
          <div class="account-section">
            <h2>Mail</h2>
            <p>{{$store.state.auth.user.email}}</p>
          </div>
          <div class="account-section">
            <h2>Name</h2>
            <p>{{$store.state.auth.user.name}}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  created() {
    this.$store.dispatch('auth/setUserInfo')
  },
  methods: {
    logout() {
      this.$auth.logout()
    },
  },
}
</script>
