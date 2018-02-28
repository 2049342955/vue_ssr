<template>
  <div class="pay_form">
    <template v-if="isMobile===0">
      <h3 class="title">支付订单信息</h3>
      <div :class="['pay_text',{active:payNo===2}]">
        <label class="pay_value">
          <input type="radio" name="payType" @click="setPayNo(2)" checked>
          <span class="zhifubao">支付宝</span>
        </label>
        <div class="pay_info">
          <span>支付</span>
          <span class="money">{{totalPrice*(1-loan)|format}}</span>
          <span>元</span>
        </div>
      </div>
      <div :class="['pay_text',{active:payNo===1}]">
        <label class="pay_value">
          <input type="radio" name="payType" @click="setPayNo(1)">
          <span class="yue">账户余额{{balance}}元</span>
        </label>
        <div class="pay_info">
          <span>金额不足，可先</span>
          <a href="javascript:;" @click="goRecharge('/user/recharge')">充值</a>
        </div>
      </div>
    </template>
    <div class="pay_item" @click="openMask(3)" v-else-if="isMobile===1">
      <span>支付方式</span>
      <span>{{payNo===1?'余额支付':'支付宝'}}</span>
    </div>
    <form :class="'form form'+isMobile" action="" @submit.prevent="checkPay" novalidate>
      <input type="hidden" name="mobile" :value="mobile">
      <FormField :form="form" class="form" v-if="payNo===1"></FormField>
       <label for="accept">
        <input type="checkbox" checked id="accept" name="accept">
        <slot></slot>
      </label> 
      <button name="btn" v-if="isMobile===0">确认支付</button>
      <div class="mobile_btn" v-else-if="isMobile===1">
        <button name="btn">确认支付</button>
      </div>
    </form>
  </div>
</template>

<script>
  import api from '@/util/function'
  import { mapState } from 'vuex'
  import FormField from '@/components/common/FormField'
  export default {
    components: {
      FormField
    },
    props: {
      totalPrice: {
        type: Number
      },
      balance: {
        type: Number
      },
      loan: {
        type: Number
      },
      form: {
        type: Array
      },
      payNo: {
        type: Number
      }
    },
    methods: {
      checkPay (e) {
        let ff = e.target
        let val = ff.code.value
        if (this.payNo === 1) {
          if (this.totalPrice > +this.balance) {
            api.tips('余额不足，请充值')
            return false
          }
          if (!val) {
            api.tips('短信验证码不能为空')
            return false
          } else if (!api.check('^[0-9]{6}$', val)) {
            if (this.isMobile) {
              api.tips('请输入6位数字')
            }
            return false
          }
        }
        if (!ff.accept.checked) {
          api.tips('请同意服务条款')
          return false
        }
        this.$emit('pay', e)
      },
      goRecharge (url) {
        this.$store.commit('SET_URL', this.$route.path)
        this.$router.push({path: url})
      },
      setPayNo (k) {
        this.$emit('setPayNo', k)
      },
      openMask (k) {
        this.$emit('openMask', k)
      }
    },
    filters: {
      format: api.decimal
    },
    computed: {
      ...mapState({
        mobile: state => state.info.mobile,
        isMobile: state => state.isMobile
      })
    }
  }
</script>

<style type="text/css" lang="scss">
  .pay_form{
    margin-top: 20px;
    background:$white;
    .pay_text{
      @include pay_type
    }
    .pay_item{
      padding:0 0.3rem;
      background: #fff;
      @include flex(space-between)
      line-height: 50px;
      span:last-child:after{
        content:'';
        @include block(8)
        @include arrow
      }
    }
    .form {
      @include form(h,1)
      label{
        color: #666;
        input{
          @include checkbox(18)
        }
        span{
          margin-left:10px;
          a{
            color:#327fff;
          }
        }
      }
      &.form0 {
        padding:15px;
        width:400px;
        margin:30px auto 0 auto;
        .input{
          margin-bottom: 15px;
          input{
            height:42px;
          }
          .count_btn {
            top: 0;
            right: 0;
            border-top-right-radius: 5px;
            border-bottom-right-radius: 5px;
            height: 42px;
            line-height: 42px;
          }
        }
        button{
          background: #FE5038;
          border-color: #FE5038;
          margin: 10px 0;
          line-height: 2.2;
        }
      }
      &.form1 {
        .form_field{
          padding:0.3rem;
          background: #fff;
        }
        label{
          display: block;
          padding: 0.3rem;
          font-size: 0.28rem;
        }
        .mobile_btn{
          @include mobile_footer_btn
          button{
            margin: 0;
          }
        }
      }
    }
  }
</style>
