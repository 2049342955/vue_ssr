<template>
  <section>
    <div class="nav_list">
      <div class="logo">
        <img :src="logo">
      </div>
      <nav>
        <div class="item" v-for="(i,k) in nav">
          <router-link :to="i">{{ k }}</router-link>
        </div>
      </nav>
      <router-link to="/user/index">个人中心</router-link>
    </div>
  </section>
</template>

<script>
  export default {
    name: 'nav',
    data () {
      return {
        nav: {'首页': '/', 'BDC展示区': '/bdc/list', '云算力商城': '/cloudCompute/shop', '算力转让区': '/computeTransfer/List', '矿机市场': '/mine'},
        logo: require('@/assets/images/logo.png')
      }
    }
  }
</script>

<style type="text/css" lang="scss">
  @import '../../assets/css/style.scss';
  .nav_list{
    @include main
    @include flex
    @include gap(20,v)
    .logo{
      @include fitimg(122,54)
    }
    a{
      font-size: 16px;
      &:hover,a.router-link-exact-active{
        color: $text
      }
    }
    nav{
      flex:1;
      @include flex(center)
      .item{
        @include gap(20,h)
      }
    }
    > a{
      padding:5px 15px;
      border:1px solid $border
    }
  }
</style>
