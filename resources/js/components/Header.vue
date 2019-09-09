<template>
  <nav class="navbar spa_head">
    <div class="navbar__menu">
      <div class="navbar-logo">
        <router-link v-bind:to="{ name : 'index'}">
          <p>Home</p>
        </router-link>
      </div>
    </div>
  </nav>
</template>

<script>
  export default {
    data() {
      return {
        routes: {
          // UNLOGGED
          unlogged: [
            { name: 'Register', path: 'register' },
            { name: 'Login', path: 'login'}
          ],
          // LOGGED USER
          user: [
            { name: 'Dashboard', path: 'dashboard' }
          ],
          // LOGGED ADMIN
          admin: [
            { name: 'Dashboard', path: 'admin.dashboard' }
          ]
        }
      }
    },

    methods: {
      logout() {
        var app = this
        this.$auth.logout()
      }
    }
  }
</script>
