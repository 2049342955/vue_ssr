<template>
  <form class="login" action="" @submit.prevent="login">
    <h2>欢迎登录算力网</h2>
    <div class="input" v-for="f in form">
      <span>{{f.title}}</span>
      <span>*</span>
      <input type="text" :name="f.name" :placeholder="f.placeholder">
    </div>
    <button>登录</button>
  </form>
</template>

<script>
  import dologin from '@/util/index'
  export default {
    name: 'login',
    data () {
      return {
        form: [{name: 'tel', title: '手机号码', placeholder: '请输入手机号'}, {name: 'pwd', title: '登录密码', placeholder: '密码应在6-16位之间'}]
      }
    },
    methods: {
      login () {
        var data = {}
        var ff = document.querySelector('.login')
        for (var i = ff.length - 1; i >= 0; i--) {
          if (ff[i].name) {
            data[ff[i].name] = ff[i].value
          }
        }
        dologin('/user/login', data).then(res => {
          if (res.bjt) {
            this.$router.push({name: 'home', params: {token: res.bjt}})
            this.$store.commit('setToken', res.bjt)
          } else {
            alert(res)
          }
        })
      }
    }
  }
</script>

<style type="text/css" lang="scss">
  @import '../../assets/css/style.scss';
  form{
    @include form
  }
</style>
