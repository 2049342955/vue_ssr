<template>
  <div class="login">
    <div class="info">
      <h1>开启您的挖矿之旅!</h1>
      <h3>非常简单-您的挖矿设备已经设置并运行了</h3>
      <h3>登录账号-您即可开始使用我们的运算力挖矿服务开始挖矿</h3>
    </div>
    <form class="form" action="" @submit.prevent="login" novalidate>
      <h3>
        <span>账户登录</span>
        <router-link to="/auth/passwordRetrieval">忘记密码</router-link>
      </h3>
      <div class="input" v-for="f in form">
        <span>{{f.title}}</span>
        <span></span>
        <input :type="f.type" :name="f.name" autocomplete="off" :placeholder="f.placeholder" @blur="test" :pattern="f.pattern" data-status="">
        <span :title="f.tips" :tips="f.placeholder"></span>
      </div>
      <button>登录</button>
      <div class="go_regist">
        <span>还没有账号？</span>
        <router-link to="/auth/regist">免费注册</router-link>
      </div>
    </form>
  </div>
</template>

<script>
  import dologin from '@/util/index'
  import api from '@/util/function'
  export default {
    name: 'login',
    data () {
      return {
        form: [{name: 'tel', type: 'text', title: '手机号码', placeholder: '请输入手机号', pattern: '^1[3578][0-9]{9}$', tips: '请输入11位手机号'}, {name: 'pwd', type: 'password', title: '登录密码', placeholder: '请输入您的登录密码', pattern: '^.{6,16}$', tips: '密码应在6-16位之间'}]
      }
    },
    methods: {
      login () {
        var ff = document.querySelector('.form')
        var data = api.checkFrom(ff, this)
        if (!data) return false
        dologin('/user/login', data).then(res => {
          if (res.bjt) {
            this.$router.push({name: 'home', params: {token: res.bjt}})
            this.$store.commit('setToken', res.bjt)
          } else {
            alert(res)
          }
        })
      },
      test (e) {
        var ele = e.target
        this.check(ele)
      },
      check (ele) {
        if (!ele.checkValidity()) {
          ele.setAttribute('data-status', 'invalid')
        } else {
          ele.setAttribute('data-status', 'valid')
          return true
        }
      }
    }
  }
</script>

<style type="text/css" lang="scss">
  @import '../../assets/css/style.scss';
  .login{
    width:100%;
    @include flex(space-between)
    color:$white;
    .info{
      line-height:2;
      h1{
        font-size: 46px;
        font-weight: bold;
        margin-bottom:20px;
        letter-spacing: 3px;
      }
      h3{
        font-size: 18px;
      }
    }
    .form{
      color:$light_text;
      background:$white;
      padding:35px;
      @include form
      h3{
        @include flex(space-between,flex-end)
        span{
          font-size: 24px;
        }
        margin-bottom:35px
      }
      .go_regist{
        border-top:1px dashed $border;
        padding-top:15px;
        text-align: center;
        a{
          color:$blue
        }
        &,a{
          font-size: 16px;
        }
      }
      .input{
        margin-bottom:40px;
        input{
          padding-left:134px;
        }
        span:nth-child(2){
          @include gap(10,h)
          top:15px;
          bottom:15px
        }
        span:last-child{
          top:58px;
          left:10px;
          width:400px
        }
      }
      button{
        margin-top:0
      }
    }
  }
</style>
