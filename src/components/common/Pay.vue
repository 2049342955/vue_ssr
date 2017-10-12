<template>
  <section class="pay">
    <div class="orderMsg">
      <h3 class="title">确认订单信息</h3>
      <div class="orderDetail">
        <div class="detailH">
          <div class="borderR" v-for="d,k in proData">
            <p class="value"><span>{{$parent.detail[k]}}{{d.unit}}</span></p>
            <p>{{d.title}}</p>
          </div>
        </div>
        <div class="detailF">
          <p v-for="t,k in proText">{{t}}：
            <span class="value">{{$parent.detail[k]}}</span>
          </p>
        </div>
      </div>
    </div>
    <div class="orderPay">
      <div class="detail">
        <p class="title">
          批次所在区域：
          <span class="value">{{$parent.detail.address}}</span>
        </p>
        <div class="text">{{$parent.detail.desc}}</div>
      </div>
      <form class="form payForm" action="" @submit.prevent="pay" novalidate>
        <p class="sum">
          应付金额：
          <span class="value"><span>{{$parent.detail.price * $parent.number}}</span> 元</span>
        </p>
        <p class="account">
          <span>
          账户余额：
            <span class="value"><span>{{$parent.account.balance}}</span> 元</span>
          </span>
          <router-link to="/user/moneyFlow">充值</router-link>
        </p>
        <FormField :form="form" class="form"></FormField>
        <label for="accept">
          <input type="checkbox" id="accept" name="accept" checked>
          <span>阅读并接受<router-link to="/auth/serviceTerms">《算力网服务条款》</router-link></span>
          <span class="select_accept">请选择</span>
        </label>
        <button>确认支付</button>
      </form>
    </div>
  </section>
</template>

<script>
  // import util from '@/util/index'
  import api from '@/util/function'
  import FormField from '@/components/common/FormField'
  export default {
    components: {
      FormField
    },
    data () {
      return {
        proData: {title: {title: '矿机名称', unit: ''}, price: {title: '每台服务器价格', unit: '元'}, number: {title: '购买服务器数量', unit: '台'}, income: {title: '今日每T预期收益', unit: 'btc'}, electricityFees: {title: '每日电费约', unit: 'btc'}},
        proText: {hashType: '算力类型', hash: '每台矿机算力', buyType: '购买类型', incomeType: '结算方式'},
        form:
        [
          {
            name: 'payPsd',
            type: 'password',
            title: '交易密码',
            placeholder: '请输入交易密码',
            pattern: '^.{6,16}$',
            tips: '密码应是6到16位,请输入密码'
          }
        ],
        tips: ''
      }
    },
    methods: {
      pay () {
        var ff = document.querySelector('.payForm')
        var account = this.orderDetail.purchase.number * this.orderDetail.purchase.unitPrice
        var balance = this.$parent.account.balance
        if (account > balance) { // 余额不足验证
          this.tips = '余额不足'
          alert(this.tips)
          return false
        }
        var data = api.checkFrom(ff)
        if (!data) return false
        if (!ff.accept.checked) {
          ff.accept.setAttribute('data-status', 'invalid')
          return false
        }
        // 确认支付
        // util.post('/register', {sign: api.serialize(Object.assign(data, {token: 0}))}).then(res => {
        //   if (res) {
        //     this.$router.push({name: 'login'})
        //   }
        // })
      }
    }
  }
</script>
<style type="text/css" lang="scss">
  @import '../../assets/css/style.scss';
  .pay{
    @include main
    color: #999;
    .orderMsg{
      background: #fff;
      padding: 0 30px 15px;
      h3.title{
        font-size: 18px;
        font-weight: bold;
        color: #333;
        padding: 8px 0;
        border-bottom: 1px solid #eee;
      }
      .orderDetail{
        margin-top: 20px;
        color: #999;
        .value{
          color:#333;
        }
        .detailH{
          @include flex(space-between);
          background: #fff9f3;
          padding: 25px;
          text-align: center;
          div{
            width: 20%;
            // text-align: left;
            .value span{
              font-size: 20px;
            }
          }
          .borderR{
            border-right: 1px solid #e5e5e5;
          }
        }
        .detailF{
          @include flex(flex-start);
          margin: 20px 0;
          border: 1px solid #eee;
          padding: 20px 25px;
          p{
            padding: 0 48px 0 42px;
          }
        }
      }
    }
    .orderPay{
      margin-top: 20px;
      height: 288px;
      border: 5px solid #ffe6d7;
      box-shadow: 0 0 5px 5px #ffe6d7 inset;
      background:$white;
      padding: 20px 25px;
      @include flex(space-between);
      .detail{
        background: #f7f8fa;
        width: 642px;
        height: 235px;
        padding: 0 30px 0 318px;
        .title{
          margin: 53px 0 25px;
          padding-left: 20px;
          .value{
            font-size: 18px;
            font-weight: bold;
            color:#333;
          }
        }
        .text{
          color: #666;
        }
      }
      form{
        @include form(v);
        p{
          margin-bottom: 20px;
        }
        .sum{
          .value{
            color: #c80009;
            span{
              font-size: 24px;
              font-weight: bold;
            }
          }
        }
        .account{
          @include flex(space-between);
          span{
            .value{
              color: #333;
              span{
                font-weight: bold;
              }
            }
          }
          a{
            color: #327fff;
          }
        }
        label{
          color: #666;
          input{
            &:checked{
              background: #ff721f;
              border-color: #ff721f;
            }
            & ~ span.select_accept{
              display: none;
              color: #ff721f;
              font-size: 12px;
            }
            &[data-status='invalid'] ~ span.select_accept{
              display: inline;
            }
          }
        }
        button{
          background: #ff721f;
          border-color: #ff721f;
          margin: 15px 0;
        }
      }
    }
  }
</style>
