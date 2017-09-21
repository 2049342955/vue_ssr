<template>
  <article class="auth">
    <header>
      <div class="box">
        <div class="logo">
          <img :src="logo" alt="logo">
          <span v-if="$route.path.includes('regist')">用户注册</span>
          <span v-else>用户登录</span>
        </div>
        <div class="text" v-if="$route.path.includes('regist')">
          <span>已经拥有账号,</span>
          <router-link to="/auth/login">直接登录</router-link>
        </div>
        <div class="text" v-else>
          <span></span>
          <router-link to="/auth/regist">注册</router-link>
        </div>
      </div>
    </header>
    <section class="main">
      <img class="bg" :src="banner" alt="">
      <div class="box">
        <router-view></router-view>
      </div>
    </section>
  </article>
</template>

<script>
  export default {
    data () {
      return {
        banner: require('@/assets/images/auth_bg.jpg'),
        logo: require('@/assets/images/logo.png')
      }
    }
  }
</script>

<style type="text/css" lang="scss">
  @import '../assets/css/style.scss';
  .auth{
    color:$light_text;
    header{
      position: relative;
      box-shadow:0px 4px 7px 0px rgba(138, 126, 126, 0.21);
      z-index: 2;
      .box{
        @include main
        @include flex(space-between)
        height:80px;
        .logo{
          @include flex
          img{
            width:139px;
            height:51px
          }
          span{
            display: inline-block;
            padding-left:15px;
            margin-left:15px;
            border-left:1px solid $border;
            font-size: 18px
          }
        }
        .text{
          a{
            color:$blue
          }
        }
      }
    }
    .main{
      position: relative;
      height:calc(100vh - 80px);
      .bg{
        height:100%;
        object-fit:cover
      }
      .box{
        @include position(40)
        @include flex(center,flex-start)
        bottom:auto;
        height:700px;
        @include main
        background:$white
      }
    }
  }
</style>
