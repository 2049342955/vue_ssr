<template>
  <my-mask title="选择购买数量" @closeMask="closeMask" :maskClose="true" position="bottom">
    <template slot="buy_box">
      <div class="buy_text">
        <div>单价</div>
        <div>{{detail.one_amount_value}}元/台</div>
      </div>
      <div class="buy_text">
        <div>数量</div>
        <div class="input_box">
          <span :class="{active:number>detail.single_limit_amount}" @click="changeNum(+number-1)">-</span>
          <input type="text" id="number" :value="number" :placeholder="detail.single_limit_amount+'台起售'" @blur="changeNum($event.target.value)">
          <span :class="{active:number!==detail.leftNum}" @click="changeNum(+number+1)">+</span>
        </div>
      </div>
      <div class="buy_text last">
        <div>总价</div>
        <div>{{(detail.one_amount_value*number)|format}}元</div>
      </div>
      <div class="buy_text" v-if="detail.status!==4&&detail.is_loan===1">
        <div>分期购买</div>
        <div class="icon_loan">
          <label for="isLoan1">
            <input id="isLoan1" type="radio" value="1" name="isLoan"> 是
          </label>
          <label for="isLoan2">
            <input id="isLoan2" type="radio" value="0" name="isLoan" checked> 否
          </label>
        </div>
      </div>
      <div class="mobile_btn">
        <button @click="goPay(false)">确认购买</button>
      </div>
    </template>
  </my-mask>
</template>

<script>
  import api from '@/util/function'
  import MyMask from '@/components/common/Mask'
  export default {
    components: {
      MyMask
    },
    props: {
      detail: {
        type: Object
      },
      number: {
        type: Number
      }
    },
    methods: {
      closeMask () {
        this.$emit('closeMask')
      },
      changeNum (n) {
        this.$emit('changeNum', n)
      },
      goPay () {
        this.$emit('goPay')
      }
    },
    filters: {
      format: api.decimal
    }
  }
</script>

<style type="text/css" lang="scss">
  .popup{
    .buy_box{
      font-size: 16px;
      .buy_text{
        @include flex(space-between)
        border-bottom: 1px solid $border;
        margin: 0 15px;
        padding: 10px 0;
        .input_box{
          width:160px;
          line-height: 30px;
          border:1px solid $border;
          @include flex
          span{
            width:30%;
            font-size: 22px;
            text-align: center;
            color: #c5c5c5;
            &.active {
              color:$light_text;
            }
          }
          input{
            width:40%;
            border-left: 1px solid $border;
            border-right: 1px solid $border;
            line-height: 30px;
            text-align: center;
          }
        }
        &.last{
          .item:last-child{
            color: $orange;
          }
        }
        .icon_loan {
          label {
            input {
              @include checkbox
            }
            & + label {
              margin-left: 0.5rem
            }
          }
        }
      }
      .mobile_btn{
        position: relative;
        border: 0;
        padding: 15px;
        button{
          background: transparent;
          color: $blue;
          border: 1px solid $blue;
        }
      }
    }
  }
</style>
