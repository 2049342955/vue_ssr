<template>
  <div class="miner_base_info">
    <div class="base_info_type">
      <div class="iconfont">&#xe603;</div>
      <span>算力服务器</span>
    </div>
    <div class="miner_left">
      <img :src="detail.minerPicture" alt="">
    </div>
    <div class="miner_right">
      <h4>
        <span :class="(detail.status===2||detail.status===3)?'gray':'red'">{{detail.statusStr}}</span>
        <span>{{detail.name}}</span>
      </h4>
      <p class="time">{{detail.DeliveryTime}}</p>
      <p class="suan_price">
        <span class="left_miner">单 价</span>
        <span class="right_miner">¥ <em>{{detail.one_amount_value}}</em></span>
      </p>
      <p class="address">
        <span class="left_miner">总 算 力</span>
        <span class="right_miner"><em>{{(detail.one_amount_value*number)|format}}</em>T</span>
      </p>
      <p class="address">
        <span class="left_miner">物&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;流</span>
        <span class="right_miner">订单委托第三方物流公司发货，物流费用到付</span>
      </p>
      <div class="miner_input">
        <span class="left_miner">数&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;量</span>
        <div class="input_box right_miner">
          <span :class="{active:number>detail.single_limit_amount}" @click="changeNum(+number-1)">-</span>
          <input type="text" :value="number" id="number" :placeholder="detail.single_limit_amount+'台起售'" @blur="changeNum($event.target.value)">
          <span :class="{active:number!==detail.leftNum}" @click="changeNum(+number+1)">+</span>
        </div>
        <p class="miner_number">库存{{detail.leftNum}}台<span class="detail_limit_text">({{detail.single_limit_amount+'台起售'}})</span></p>
      </div>
      <button class="btn" disabled v-if="detail.status===2">已售罄</button>
      <button class="btn" disabled v-else-if="detail.status===3">产品撤销</button>
      <button class="btn" @click="checkPay(false)" :disabled="detail.status===4" v-else>立即购买</button>
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
  .miner_base_info{
    .base_info_type{
      background: #fe5039;
    }
    .miner_left{
      width: 500px;
      border:1px solid #dcdcdc;
      height:324px;
      margin-top: 12px;
      margin-left: 12px;
      text-align: center;
      float: left;
      img{
        width: 50%;
        margin-top: 78px;
        height: 160px;
        object-fit: contain;
      }
    }
    .miner_right{
      padding:20px 90px 0 20px;
      width: calc(100% - 512px);
      float: left;
      h4{
        color: #666666;
        font-weight: 800;
        font-size: 22px;
        line-height: 0;
        margin-top: 10px;
        .red{
          display:inline-block;
          background: #327fff;
          padding:10px 15px;
          border-radius: 10px;
          font-size: 12px;
          font-weight:100;
          color:white;
          margin-right: 10px;
          position: relative;
          top: -4px;
        }
        .gray{
          display:inline-block;
          background: rgb(195, 187, 186);
          padding:10px 15px;
          border-radius: 10px;
          font-size: 12px;
          font-weight:100;
          color:white;
          margin-right: 10px;
        }
      }
      .time{
        color: #fe5039;
        font-size: 12px;
        margin:15px 0;
      }
      .suan_price{
        height: 50px;
        background:#f3f3f3;
        line-height: 50px;
        margin-bottom: 20px;
        .left_miner{
          position:relative;
          top:-5px;
        }
        .right_miner{
          color: #ea2c2c;
          font-weight: 800;
          font-size: 21px;
          em{
            font-size: 24px;
          }
        }
      }
      .left_miner{
        color: #999999;
        font-size: 12px;
        width: 80px;
        display:inline-block;
        text-align: left;
        padding-left: 12px;
        box-sizing: border-box;
      }
      .right_miner{
        color: #121212;
        font-size: 14px;
        em{
          font-style: normal;
          font-size: 14px;
        }
      }
      .address{
        margin-bottom: 15px;
      }
      .miner_input{
        height: 34px;
        .left_miner{
          float: left;
          line-height: 34px;
        }
        .input_box{
          display:inline-block;
          width: 142px;
          height: 34px;
          border:1px solid #e5e5e5;
          border-radius: 3px;
          box-sizing: border-box;
          float: left;
          margin-right: 28px;
          span{
            width: 22px;
            height: 100%;
            display:inline-block;
            background:#e5e5e5;
            float: left;
            font-size: 16px;
            text-align: center;
            line-height: 30px;
            cursor: pointer;
            color: #c5c5c5;
            user-select: none;
            &.active {
              color: #333333;
            }
          }
          input{
            width: 96px;
            height: 100%;
            float: left;
            text-align: center;
          }
          :nth-child(1){
            border-top-left-radius: 3px;
            border-bottom-left-radius: 3px;
          }
          :nth-child(3){
            border-top-right-radius: 3px;
            border-bottom-right-radius: 3px;
          }
        }
        .miner_number{
          float: left;
          line-height: 28px;
          color:#666666;
          span{
            color: #fe5039;
          }
        }
      }
      .btn{
        position: relative;
        width: 242px;
        height: 44px;
        border:0;
        margin-top: 26px;
        background: $orange;
        color: white;
        font-size: 18px;
        margin-left: 79px;
        &:disabled{
          background: #b5b0af;
        }
      }
    }
  }
</style>
