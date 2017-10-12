<template>
  <section class="product_nav">
    <router-link class="item" :to="'/'+page+'/list/'+(k+1)+'/'+$route.params.sort" v-for="n,k in nav" :key="k">
      <span :class="['iconfont', 'icon'+k]"></span>
      <span>{{n}}</span>
    </router-link>
  </section>
</template>

<script>
  export default {
    props: {
      page: {
        type: String
      }
    },
    data () {
      return {
        nav: ['BTC挖矿', 'BCC挖矿', 'ETH挖矿', 'ETC挖矿']
      }
    }
  }
</script>

<style type="text/css" lang="scss">
  @import '../../assets/css/style.scss';
  .product_nav{
    position: relative;
    z-index: 1;
    margin-top:-40px;
    line-height: 60px;
    @include main
    @include gap(70,h)
    @include flex(space-between)
    background: $white;
    box-shadow:5px 10px 15px 0px rgba(50, 127, 255, 0.12);
    .item{
      color: $text;
      font-size: 18px;
      cursor: pointer;
      border-bottom:2px solid transparent;
      @include gap(10,h)
      &:hover,&.router-link-active{
        color:$blue;
        border-bottom:2px solid $blue
      }
      .iconfont{
        @include block(36)
        vertical-align: middle;
        &:before{
          font-size: 36px
        }
        &.icon0:before{
          content: "\e62d"
        }
        &.icon1:before{
          content: "\e6ad"
        }
        &.icon2:before{
          content: "\e60f"
        }
        &.icon3:before{
          content: "\e60d"
        }
      }
    }
  }
</style>
