<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card-header">
          <router-link :to="{ name: 'register', params: {} }">Register</router-link>
          <router-link :to="{ name: 'login', params: {} }">Login</router-link>
        </div>
        <div class="card">
          <div class="card-body">
            <div class="alert alert-danger" v-if="has_error && !success">
              <p>{{error}}</p>
            </div>
            <form autocomplete="off" @submit.prevent="login" method="POST">
              <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">E-mail</label>
                <div class="col-md-6">
                    <input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="email" required>
                </div>
              </div>

              <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                <div class="col-md-6">
                  <input type="password" id="password" class="form-control" v-model="password" required>
                </div>
              </div>

              <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                  <button type="submit" class="form-submit btn btn-primary">Signin</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  export default {
    data() {
      return {
        email: null,
        password: null,
        success: false,
        has_error: false,
        error: '',
      }
    },
    methods: {

      login() {
        // get the redirect object
        var redirect = this.$auth.redirect()
        var app = this
        this.$auth.login({
          data: {
            email: app.email,
            password: app.password
          },
          success: function() {
            app.success = true
          },
          error: function(res) {
            app.has_error = true
            app.error = res.response.data.error
          },
          rememberMe: true,
          fetchUser: true
        })
      }
    }
  }
</script>
