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

      </div>
      <form class="form" action="" @submit.prevent="login" novalidate>
        <p class="sum">
          应付金额：
          <span class="value">{{orderDetail.purchase.unitPrice * orderDetail.purchase.number}}</span>
        </p>
        <p class="account">
          账户余额：
          <span></span>
        </p>
        <FormField :form="form"></FormField>
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
  export default {
    name: 'pay',
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
            placeholder: '请输入手机号',
            pattern: '^1[3578][0-9]{9}$',
            tips: '请输入11位手机号'
          }
        ]
      }
    },
    methods: {
      // 确认支付
    }
  }
</script>
<style type="text/css" lang="scss">
  @import '../../assets/css/style.scss';
  .pay{
    width: 1180px;
    margin: 20px auto;
    color: #333;
    .orderMsg{
      background: #fff;
      padding: 0 30px 25px;
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
          @include flex(space-between);
          margin: 20px 0;
          border: 1px solid #eee;
          padding: 20px;
        }
      }
      .orderPay{
        @include flex(space-between);
        .form{
          color:$light_text;
          background:$white;
          padding:35px;
          @include form(v);
          .go_regist{
            border-top:1px dashed $border;
            padding-top:15px;
            text-align: center;
            a{
              color:$blue
            }
            &,a{
              font-size: 16px;
            }
          }
          .input{
            input{
              padding-left:134px;
            }
            span:nth-child(2){
              @include gap(10,h);
              top:15px;
              bottom:15px
            }
          }
          button{
            margin-top:0
          }
        }
      }
    }
  }
</style>
