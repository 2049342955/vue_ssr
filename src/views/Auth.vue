<template>
  <section :class="['auth', {login_box:$route.path.includes('login')}]">
    <img class="bg" :src="bg" alt="" v-if="$route.path.includes('login')">
    <img class="bg" :src="banner" alt="" v-else>
    <div class="box">
      <router-view></router-view>
    </div>
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
    height:calc(100vh - 80px);
    position: relative;
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
    &.login_box{
      height:100vh;
      .box .text a{
        color:$white
      }
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
</style>
