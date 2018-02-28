<template>
  <div :class="['right_box', {fix_top:isFixTop}]">
    <div class="order_title">订单信息</div>
    <div class="item">
      <span>总算力</span>
      <span>{{totalHash}}T</span>
    </div>
    <div class="item" v-if="isLoan">
      <span>总金额</span>
      <span class="price">￥{{totalPrice|format}}元</span>
    </div>
    <div class="item">
      <span>支付金额</span>
      <span class="price">￥{{totalPrice*(1-loan)|format}}元</span>
    </div>
  </div>
</template>

<script>
  import api from '@/util/function'
  export default {
    props: {
      totalHash: {
        type: Number
      },
      totalPrice: {
        type: Number
      },
      loan: {
        type: Number
      },
      isLoan: {
        type: Boolean
      }
    },
    data () {
      return {
        isFixTop: false
      }
    },
    methods: {
      fixTop (e) {
        var scrollTop = document.documentElement.scrollTop || window.pageYOffset || document.body.scrollTop
        if (scrollTop > 5) {
          this.isFixTop = true
        } else {
          this.isFixTop = false
        }
      }
    },
    mounted () {
      window.addEventListener('scroll', this.fixTop, false)
    },
    filters: {
      format: api.decimal
    }
  }
</script>

<style type="text/css" lang="scss">
  .right_box{
    position: fixed;
    right:calc(50% - 590px);
    width:260px;
    margin-left:20px;
    border:1px solid $blue_border;
    padding:15px 15px 30px 15px;
    background: #F2F6FF;
    line-height: 2.4;
    color:$text;
    top:80px;
    transition: all .3s;
    .item{
      border-top:1px solid $blue_border;
      @include flex(space-between)
      .price{
        color:$orange;
        font-weight: bold;
        font-size: 18px;
      }
    }
    &.fix_top{
      top:0
    }
  }
</style>
