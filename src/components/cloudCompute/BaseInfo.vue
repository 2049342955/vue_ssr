<template>
  <div class="cloud_base_info">
    <div class="base_info_type">
      <div class="iconfont">&#xe610;</div>
      <span>云算力</span>
    </div>
    <div class="cloud_miner_left">
      <h4>
        {{detail.product_name}}
        <span>{{(detail.sell_type===2&&detail.status!==7&&'转售')||detail.statusStr}}</span>
      </h4>
      <div class="product_data">
        <div class="item" v-for="d,k in proData">
          <div class="item_word">
            <span class="num" v-if="k==='price'">{{detail[k]|format}}</span>
            <span class="num" v-else>{{detail[k]}}</span>
            <span class="unit">{{d.unit}}</span>
          </div>
          <p class="tips">{{d.title}}</p>
        </div>
      </div>
      <div class="progress_info press">
        <div class="progress_box">
          <div class="box" :style="{margin:0,width:detail.sellProgress}"></div>
        </div>
      </div>
      <div class="progress_price">
        <span class="one">当前进度 {{detail.sellProgress}}</span>
        <span class="two">剩余可售 {{detail.leftNum}}台</span>
      </div>
    </div>
    <div class="cloud_miner_right">
      <div class="price_text">我要购买<span class="detail_limit_text">({{detail.single_limit_amount+'台起售'}})</span></div>
      <div class="input_box">
        <input type="text" :value="number" id="number" :placeholder="detail.single_limit_amount+'台起售'" @blur="changeNum($event.target.value)">
        <span>台</span>
      </div>
      <div class="price_text1">总算力：<span class="money">{{(detail.hash*number)|format}}T</span></div>
      <div class="price_text1">需支付：<span class="money">{{(detail.one_amount_value*number)|format}}元</span></div>
      <button class="btn" disabled v-if="detail.status===7">已售罄</button>
      <button class="btn" @click="checkPay(false)" v-else :disabled="detail.status===4">立即购买</button>
      <button class="btn loan_btn" @click="checkPay(true)" v-if="detail.status!==4&&detail.is_loan===1">分期购买</button>
    </div>
  </div>
</template>

<script>
  import api from '@/util/function'
  export default {
    props: {
      detail: {
        type: Object
      },
      number: {
        type: Number
      }
    },
    data () {
      return {
        proData: {
          one_amount_value: {title: '每台价格', unit: '元'},
          hash: {title: '每台算力', unit: 'T'},
          amount: {title: '出售总数', unit: '台'}
        }
      }
    },
    filters: {
      format: api.decimal
    },
    methods: {
      changeNum (n) {
        this.$emit('changeNum', n)
      },
      checkPay (isLoan) {
        this.$emit('checkPay', isLoan)
      }
    }
  }
</script>

<style type="text/css" lang="scss">
  .cloud_base_info{
    .base_info_type{
      background:#327fff;
    }
    .cloud_miner_left{
      width: 722px;
      height: 100%;
      padding-top: 53px;
      padding-left: 98px;
      box-sizing: border-box;
      float: left;
      background: #f3f8ff;
      h4{
        font-size: 27px;
        color: #333333;
        font-weight: 800;
        span{
          width: 56px;
          height: 16px;
          display:inline-block;
          border-radius: 16px;
          border:1px solid #fe5039;
          text-align: center;
          margin-left: 20px;
          line-height: 15px;
          font-size: 12px;
          color: #fe5039;
          font-weight: 100;
        }
      }
      .white{
        color: #327fff;
        border:1px solid #327fff;
        width: 115px;
        height: 25px;
        text-align: center;
        margin-top: 12px;
        font-size: 12px;
        line-height: 22px;
      }
      .product_data{
        width: 550px;
        height: 60px;
        margin-top: 30px;
        display: flex;
        justify-content: space-between;
        aligns-item: center;
        .item {
          display: flex;
          justify: flex-start;
          flex-direction: column;
          .num {
            color: #333;
            font-size: 30px;
          }
          .unit {
            margin-left: 7px;
          }
          &:nth-of-type(1) {
            .num {
              color: #f00;
              font-weight: 800;
            }
            .unit {
              color: #f00;
            }
          }
        }
      }
      .press{
        width: 550px;
        height: 16px;
        background: #e3e3e3;
        margin-top: 44px;
        margin-bottom:15px;
        border-radius: 16px;
        overflow:hidden;
        .progress_box{
          position: relative;
          overflow:hidden;
          height:100%;
          .box{
            @include position;
            background: linear-gradient(to right, #337eff 20%, #c72abc);
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#337eff', endColorstr='#c72abc',GradientType=1 );
            border-top-left-radius: 16px;
            border-bottom-left-radius: 16px;
          }
        }
      }
      .progress_price{
        width: 550px;
        height: auto;
        .one{
          color:#327fff;
          font-weight: 800;
          float: left;
        }
        .two{
          float:right;
        }
      }
    }
    .cloud_miner_right{
      width: 456px;
      overflow: hidden;
      background: white;
      padding-bottom: 20px;
      float: left;
      padding-top: 40px;
      padding-left: 44px;
      box-sizing: border-box;
      .price_text{
        font-size: 18px;
        color:#121212;
        .buy_tips{
          color: #fe5039;
          font-size: 14px;
          margin-left: 20px;
        }
      }
      .input_box{
        border:1px solid #d2d2d2;
        margin-top: 20px;
        width: 288px;
        height: 50px;
        line-height: 50px;
        box-sizing: border-box;
        border-radius: 5px;
        display: block;
        margin-bottom: 20px;
        input{
          width: 90%;
          float: left;
          padding-left: 22px;
          line-height: 50px;
        }
      }
      .price_text1{
        text-align: left;
        color: #666666;
        font-size: 14px;
        margin-top: 10px;
        .money{
          color: #fe5039;
          font-size: 14px;
        }
      }
      .btn{
        width: 242px;
        height: 44px;
        border:0;
        margin-top: 20px;
        background: #fe5039;
        color: white;
        font-size: 18px;
        &:disabled{
          background: #b5b0af;
        }
        &.loan_btn{
          background: #01bfb5;
          margin-top: 12px;
        }
      }
    }
  }
</style>
