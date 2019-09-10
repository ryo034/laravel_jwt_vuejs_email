<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-body">
            <p>{{msg}}</p>
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
        msg: '',
      }
    },
    created(){
      if (this.$route.params.status === 'success') {
        this.msg = '本登録が完了しました。ログイン画面からログインを行なってください。'
      }else if (this.$route.params.status === 'fail') {
        this.msg = 'メール認証に失敗しました。再度、メールからリンクをクリックしてください。'
      }else if (this.$route.params.status === 'pre_register') {
        this.msg = '仮登録が完了しました。メールのリンクをクリックして本登録をしてください。'
      }else if (this.$route.params.status === 'invalid') {
        this.msg = '無効なトークンです。'
      }else if (this.$route.params.status === 'exist') {
        this.msg = 'すでに本登録されています。ログインして利用してください。'
      }else{
        this.$router.push({name: 'not_found'})
      }
    },
    methods: {
    }
  }
</script>
