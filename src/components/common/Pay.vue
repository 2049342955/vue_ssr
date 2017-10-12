<template>
  <section class="pay">
    <div class="orderMsg">
      <h3 class="title">确认订单信息</h3>
      <div class="orderDetail">
        <div class="detailH">
          <div class="borderR">
            <p class="value"><span>{{orderDetail.name}}</span></p>
            <p>每台服务器价格</p>
          </div>
          <div class="borderR">
            <p class="value"><span>{{orderDetail.price}}</span> 元</p>
            <p>每台服务器价格</p>
          </div>
          <div class="borderR">
            <p class="value"><span>{{orderDetail.amount}}</span> 台</p>
            <p>每台服务器数量</p>
          </div>
          <div class="borderR">
            <p class="value"><span>{{orderDetail.income}}</span> btc</p>
            <p>今日每T预计收益</p>
          </div>
          <div>
            <p class="value"><span>{{orderDetail.electricityFees}}</span> btc</p>
            <p>每日电费约</p>
          </div>
        </div>
        <div class="detailF">
          <p>算力类型：
            <span class="value">{{orderDetail.types}}</span>
          </p>
          <p>每台矿机算力：
            <span class="value">{{orderDetail.power}}</span>
          </p>
          <p>购买类型：
            <span class="value">{{orderDetail.purchase.state}}</span>
          </p>
          <p>结算方式：
            <span class="value">{{orderDetail.purchase.settleMethod}}</span>
          </p>
        </div>
      </div>
    </div>
    <div class="orderPay">
      <div class="detail">
        <p class="title">
          批次所在区域：
          <span class="value">{{orderDetail.area}}</span>
        </p>
        <div class="text">
          * {{orderDetail.detail}}
        </div>
      </div>
      <form class="form payForm" action="" @submit.prevent="pay" novalidate>
        <p class="sum">
          应付金额：
          <span class="value"><span>{{orderDetail.purchase.unitPrice * orderDetail.purchase.number}}</span> 元</span>
        </p>
        <p class="account">
          <span>
          账户余额：
            <span class="value"><span>{{$parent.account.balance}}</span> 元</span>
          </span>
          <!-- <router-link >充值</router-link> -->
          <a>充值</a>
        </p>
        <FormField :form="form" class="form"></FormField>
        <label for="accept">
          <span class="tips">0000000{{tips.text}}</span>
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
  import util from '@/util/index'
  import api from '@/util/function'
  import FormField from '@/components/common/FormField'
  export default {
    name: 'pay',
    components: {
      util, api, FormField
    },
    data () {
      return {
        orderDetail:
        {
          name: '阿瓦隆1号矿机',
          price: '10000.00',
          amount: '100',
          income: '0.12441251',
          electricityFees: '0.12441251',
          types: 'BTC',
          power: '9.00',
          area: '1号楼A区',
          detail: 'BTC挖矿阿瓦隆001号算力矿机来源嘉楠智A741矿机BTC挖矿阿瓦隆001号算力矿机来源嘉楠智A741矿机',
          logoImg: '',
          purchase:
          {
            state: '预售',
            settleMethod: '每日结算，次日发放',
            number: 5,
            unitPrice: 1900.00
          }
        },
        form:
        [
          {
            name: 'payPsd',
            type: 'password',
            title: '交易密码',
            placeholder: '',
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
        var tips = document.querySelector('.tips')
        var account = this.orderDetail.purchase.number * this.orderDetail.purchase.unitPrice
        var balance = this.$parent.account.balance
        if (account > balance) { // 余额不足验证
          this.tips = '余额不足'
          tips.setAttribute('display', 'block')
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
    width: 1180px;
    margin: 20px auto;
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
          display:block;
          // margin: -10px 0 0;
          color: #666;
          position: relative;
          input{
            &:checked{
              background: #ff721f;
              border-color: #ff721f;
            }
            .select_accept{
              color: #ff721f;
              font-size: 12px;
            }
            &[data-status='invalid'] ~ span.select_accept{
              display: inline;
            }
          }
          .tips{
            position: absolute;
            top: -20px;
            color: #ea2c2c;
            display: none;
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
