<template>
  <section :class="['auth', {login_box:$route.path.includes('login')}]">
    <div class="box">
      <router-view></router-view>
    </div>
    <p class="copyright">Copyright © 2013-2017 Zhejiang Shuqin Technology Co., Ltd. All Rights Reserved. 算力网 版权所有</p>
  </section>
</template>

<script>
  export default {
    data () {
      return {
        banner: require('@/assets/images/auth_bg.jpg'),
        bg: require('@/assets/images/login_bg.jpg')
      }
    }
  }
</script>

<style type="text/css" lang="scss">
  @import '../assets/css/style.scss';
  .auth{
    color:$light_text;
    min-height:calc(100vh - 80px);
    background:$white url(../assets/images/auth_bg.jpg) no-repeat;
    &.login_box{
      min-height: 100vh;
      background:#181a1c url(../assets/images/login_bg.jpg) no-repeat;
      .box{
        padding-top:160px;
        background:transparent;
        .text a{
          color:$white
        }
      }
    }
    background-size: cover;
    .box{
      @include flex(center,flex-start)
      @include main
    }
    .copyright{
      font-size: 12px;
      text-align: center;
      padding: 15px 0
    }
  }
</style>
