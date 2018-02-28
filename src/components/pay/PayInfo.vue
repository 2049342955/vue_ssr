<template>
  <div :class="'pay_info pay_info'+isMobile">
    <template v-if="isMobile===0">
      <h3 class="title">确认订单信息</h3>
      <div class="pay_info_detail">
        <template v-for="d in proData">
          <div class="item">
            <p class="value"><span>{{detail[d]}}{{params[d].unit}}</span></p>
            <p>{{params[d].title}}</p>
          </div>
          <div class="line"></div>
        </template>
      </div>
    </template>
    <template v-if="isMobile===1">
      <div class="confirm_value">
        <div class="data_img_name">
          <div class="data_img">
            <img :src="detail.img" alt="">
          </div>
          <div class="data_name">
            <div class="name">{{detail.name}}</div>
            <div class="hash">{{detail.hash}}T算力</div>
          </div>
        </div>
        <div class="data_price_number">
          <div class="data_price">￥{{detail.one_amount_value}}</div>
          <div class="data_number">&times;{{detail.number}}</div>
        </div>
      </div>
      <div class="confirm_price">
        <span>应付金额</span>
        <span class="val">￥<i>{{totalPrice}}</i></span>
      </div>
    </template>
  </div>
</template>

<script>
  import { mapState } from 'vuex'
  export default {
    props: {
      totalPrice: {
        type: Number
      },
      detail: {
        type: Object
      }
    },
    data () {
      return {
        params: {
          name: {title: '服务器名称', unit: ''},
          one_amount_value: {title: '服务器单价', unit: '元'},
          number: {title: '购买数量', unit: '台'},
          hash: {title: '每台算力', unit: 'T'}
        },
        proData: ['name', 'one_amount_value', 'number', 'hash']
      }
    },
    computed: {
      ...mapState({
        isMobile: state => state.isMobile
      })
    }
  }
</script>

<style type="text/css" lang="scss">
  .pay_info{
    &.pay_info0 {
      .pay_info_detail{
        @include flex(space-between);
        background: #fff9f3;
        margin: 20px 0;
        color: #999;
        padding: 25px;
        text-align: center;
        .item{
          .value{
            color:#333;
            span {
              font-size: 20px;
            }
          }
        }
        .line:not(:last-child){
          width:1px;
          height:35px;
          background: $border;
        }
        .line:last-child{
          display: none;
        }
      }
    }
    &.pay_info1 {
      background: #fff;
      padding: 0.3rem;
      margin-bottom: 0.2rem;
      .confirm_value,.confirm_price {
        @include flex(space-between)
      }
      .confirm_value {
        border-bottom: 1px solid $border;
        padding-bottom: 0.3rem;
        .data_img_name {
          @include flex
          .data_img{
            width: 90px;
            height: 70px;
            text-align: center;
            border: 1px solid $border;
            margin-right: 0.3rem;
            img{
              width:60px;
              height: 50px;
              margin-top: 10px;
              object-fit: contain;
            }
          }
          .data_name {
            .name {
              font-size: 0.36rem;
              font-weight: bold;
            }
            .hash {
              color: $light_text;
              font-size: 0.3rem;
            }
          }
        }
        .data_price_number{
          text-align: right;
          .data_price {
            margin-bottom: 15px;
          }
        }
      }
      .confirm_price {
        padding-top: 0.3rem;
        .val{
          color:$orange;
          i {
            font-size: 0.4rem;
          }
        }
      }
    }
  }
</style>
