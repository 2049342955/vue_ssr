<template>
  <article class="auth">
    <header :class="{login_box:$route.path.includes('login')}">
      <div class="box" v-if="$route.path.includes('login')">
        <div class="logo">
          <img :src="loginLogo" alt="logo">
        </div>
        <div class="text">
          <router-link to="/">返回首页</router-link>
        </div>
      </div>
      <div class="box" v-else>
        <div class="logo">
          <img :src="logo" alt="logo">
          <span v-if="$route.path.includes('regist')">用户注册</span>
          <span v-if="$route.path.includes('passwordRetrieval')">找回密码</span>
        </div>
        <div class="text">
          <span>已经拥有账号,</span>
          <router-link to="/auth/login">直接登录</router-link>
        </div>
      </div>
    </header>
    <section class="main">
      <img class="bg" :src="bg" alt="" v-if="$route.path.includes('login')">
      <img class="bg" :src="banner" alt="" v-else>
      <div class="box">
        <router-view></router-view>
      </div>
    </section>
    <footer>Copyright © 2013-2017 Zhejiang Shuqin Technology Co., Ltd. All Rights Reserved. 算力网 版权所有</footer>
  </article>
</template>

<script>
  export default {
    data () {
      return {
        banner: require('@/assets/images/auth_bg.jpg'),
        bg: require('@/assets/images/login_bg.jpg'),
        logo: require('@/assets/images/logo.png'),
        loginLogo: require('@/assets/images/login_logo.png')
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
      &.login_box{
        @include position(0,0,auto,0)
        height:80px;
        box-shadow:none;
        border-bottom:1px solid #313131;
        .box .text a{
          color:$white
        }
        & + .main{
          height:100vh;
          background: #181a1c;
          .bg{
            height: 800px;
          }
          .box{
            top:160px;
            background:transparent
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
    footer{
      font-size: 12px;
      @include position(auto,0,80,0)
      text-align: center;
    }
  }
</style>
