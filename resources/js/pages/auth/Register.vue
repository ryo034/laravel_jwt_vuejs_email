<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card-header">
          <router-link :to="{ name: 'register', params: {} }">Register</router-link>
          <router-link :to="{ name: 'login', params: {} }">Login</router-link>
        </div>
        <div class="card">
          <div class="half-color"></div>
          <div class="card-body">
            <form autocomplete="off" @submit.prevent="register" v-if="!success" method="post">

              <div class="form-group row" v-bind:class="{ 'has-error': has_error && errors.name }">
                <label for="name">Name</label>
                <div class="col-md-6">
                  <input type="text" id="name" class="form-control" placeholder="Full Name" v-model="name" autocomplete="name" autofocus>
                  <span class="invalid-feedback" role="alert" v-if="has_error && errors.name">
                    <strong>{{ errors.name }}</strong>
                  </span>
                </div>
              </div>

              <div class="form-group row" v-bind:class="{ 'has-error': has_error && errors.email }">
                <label for="email">E-mail</label>
                <div class="col-md-6">
                  <input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="email" required autocomplete="email">
                  <span class="invalid-feedback" role="alert" v-if="has_error && errors.email">
                    <strong>{{ errors.email }}</strong>
                  </span>
                </div>
              </div>

              <div class="form-group row" v-bind:class="{ 'has-error': has_error && errors.password }">
                <label for="password">Password</label>
                <div class="col-md-6">
                  <input type="password" id="password" class="form-control" v-model="password" required autocomplete="new-password">
                  <span class="invalid-feedback" role="alert" v-if="has_error && errors.password">
                    <strong>{{ $message }}</strong>
                  </span>
                </div>
              </div>

              <div class="form-group row" v-bind:class="{ 'has-error': has_error && errors.password }">
                <label for="password_confirmation">Password confirmation</label>
                <div class="col-md-6">
                  <input type="password" id="password_confirmation" class="form-control" v-model="password_confirmation" required autocomplete="new-password">
                </div>
              </div>

              <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                  <button type="submit" class="form-submit btn btn-primary">Submit</button>
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
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        has_error: false,
        error: '',
        errors: {},
        success: false
      }
    },
    methods: {
      register() {
        var app = this
        this.$auth.register({
          data: {
            name: app.name,
            email: app.email,
            password: app.password,
            password_confirmation: app.password_confirmation
          },
          success: function () {
            app.success = true
          },
          error: function (res) {
            app.has_error = true
            app.error = res.response.data.error
            app.errors = res.response.data.errors || {}
          }
        })
      }
    }
  }
</script>
