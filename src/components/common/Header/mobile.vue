<template>
  <header class="mobile-header" :disabled="$route.name==='notFound'">
    <div class="left">
      <router-link to="/auth/regist">注册</router-link>
      <span>|</span>
      <router-link to="/auth/login">登录</router-link>
    </div>
    <img class="logo" :src="require('@/assets/images/mobile/logo.png')">
    <div></div>
  </header>
</template>

<script>
  export default {
    data () {
      return {
        article: {
          title: 'Blockchain Data Center'
        }
      }
    }
  }
</script>

<style type="text/css" lang="scss">
  @import '../../../assets/css/style.scss';
  @import '../../../assets/fonts/iconfont.css';
  .mobile-header {
    width: 100%;
    height: 45px;
    padding: 0 15px;
    box-sizing: border-box;
    background: #fff;
    @include flex;

    .left {
      a {
        color: #666;
      }
    }

    .logo {
      width: 90px;
      height: 20px;
      margin-left: calc(50% - 108px);
    }
  }
</style>
