<template>
  <section class="product_nav">
    <router-link class="item" :to="'/'+page+'/list/'+(k+1)+'/'+$route.params.sort" v-for="n,k in nav" :key="k">
      <span :class="['iconfont', 'icon'+n.name]"></span>
      <span>{{n.name}}挖矿</span>
    </router-link>
  </section>
</template>

<script>
  import util from '@/util'
  import api from '@/util/function'
  import { mapState } from 'vuex'
  export default {
    props: {
      page: {
        type: String
      }
    },
    data () {
      return {
        nav: [{name: 'BTC'}, {name: 'BCC'}, {name: 'ETH'}, {name: 'ETC'}, {name: 'LTC'}]
      }
    },
    mounted () {
      var self = this
      util.post('getCurrencys', {sign: api.serialize({token: this.token})}).then(function (res) {
        self.nav = res
      })
    },
    computed: {
      ...mapState({
        token: state => state.info.token
      })
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
        &.iconBTC:before{
          content: "\e62d"
        }
        &.iconBCC:before{
          content: "\e6ad"
        }
        &.iconETH:before{
          content: "\e60f"
        }
        &.iconETC:before{
          content: "\e60d"
        }
        &.iconLTC:before{
          font-size: 26px;
          content: "\e612"
        }
      }
    }
  }
</style>
