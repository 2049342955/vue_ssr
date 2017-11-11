<template>
  <section class="pay">
    <template v-if="!showAgreement">
      <div class="orderMsg">
        <h3 class="title">确认订单信息</h3>
        <div class="orderDetail">
          <div class="detailH">
            <div class="borderR" v-for="d,k in proData">
              <p class="value" v-if="k==='number'&&page==='cloudCompute'"><span>{{$parent.number}}{{d.unit}}</span></p>
              <p class="value" v-else-if="k==='number'&&page!=='cloudCompute'"><span>{{$parent.detail.hash}}{{d.unit}}</span></p>
              <p class="value" v-else><span>{{$parent.detail[k]}}{{d.unit}}</span></p>
              <p>{{d.title}}</p>
            </div>
          </div>
          <div class="detailF">
            <p v-for="t,k in proText">{{t}}：
              <span class="value" v-if="k==='hash'">{{$parent.detail[k]}}T</span>
              <span class="value" v-else-if="k==='status'">{{$parent.str[$parent.detail[k]]}}</span>
              <span class="value" v-else>{{$parent.detail[k]}}</span>
            </p>
          </div>
        </div>
      </div>
      <div class="orderMsg" v-show="$parent.show">
        <h3 class="title">分期详情</h3>
        <div class="orderDetail">
          <div class="detailH">
            <div class="borderR" v-for="d,k in proData3" style="width:33.3%;">
              <p class="value" v-if="k==='number'&&page==='cloudCompute'"><span>{{$parent.number}}{{d.unit}}</span></p>
              <p class="value" v-else-if="k==='number'&&page!=='cloudCompute'"><span>{{$parent.detail.hash}}{{d.unit}}</span></p>
              <p class="value" v-else><span>{{$parent.detail[k]}}{{d.unit}}</span></p>
              <p>{{d.title}}</p>
            </div>
          </div>
          <div class="detailF">
            <p>
              <span>分期期限 ： </span>
              <select @change="$parent.onChange" class="mont">
                <option v-for="n,k in $parent.month" :value="k">{{n}}个月</option>
              </select>
            </p>
            <p v-for="t,k in proText3">{{t}}：
              <span class="value" v-if="k==='hash'">{{$parent.detail[k]}}T</span>
              <span class="value" v-else-if="k==='status'">{{$parent.str[$parent.detail[k]]}}</span>
              <span class="value" v-else>{{$parent.detail[k]}}</span>
            </p>
            <p><a href="javascript:;" @click="close(true)">查看分期计划</a></p>
          </div>
        </div>
      </div>
      <div class="orderPay">
        <div class="detail">
          <div class="img">
            <img :src="$parent.detail.product_img" alt="">
          </div>
          <div class="text">
            <p>
              <span class="title">批次所在区域：</span>
              <span class="value">{{$parent.detail.batch_area}}</span>
            </p>
          </div>
        </div>
        <form class="form payForm" action="" @submit.prevent="pay" novalidate>
          <div class="pay_text">
            <div class="pay_value">
              应付金额：
              <span class="value">{{(page==='cloudCompute'?totalPrice:$parent.detail.total_price)|format}}</span>
              <span>元</span>
            </div>
          </div>
          <div class="pay_text">
            <div class="pay_money">
              账户余额：
              <span class="money">{{$parent.balance}}</span>
              <span>元</span>
            </div>
            <router-link to="/user/recharge">充值</router-link>
          </div>
          <FormField :form="form" class="form"></FormField>
          <label for="accept">
            <input type="checkbox" v-model="toggle" id="accept" name="accept">
            <span @click="openContract(1)">阅读并接受<a href="javascript:;" style="color:#327fff;">《算力网{{page === 'cloudCompute'?'购买':'转让'}}协议》</a>和<a href="javascript:;" style="color:#327fff;">《算力网托管协议》</a></span>
            <span class="select_accept">{{tips}}</span>
          </label>
          <button name="btn">确认支付</button>
        </form>
      </div>
      <div class="Installment_plan" v-show="showpay">
        <div class="opacity">
          <p class="title">分期计划<span @click="close(false)"><img :src="close2" style="width:12px;height:12px;position:relative;top:-6px;"/></span></p>
          <div class="item" style="overflow:hidden;">
            <p  v-for="n,k in $parent.items">{{n.title}} : {{$parent.detail[k]}}{{n.unit}}</p>
          </div>
          <table border="1" style="margin-top:24px;">
             <thead>
               <tr>
                 <th>期数</th>
                 <th>还款日期</th>
                 <th>分期余额</th>
                 <th>手续费</th>
                 <th>本期还款额</th>
               </tr>
             </thead>
             <tbody>
               <tr v-for="n,k in $parent.table">
                 <td>{{n.rate}}</td>
                 <td>{{n.datetime}}</td>
                 <td>{{n.loan_money_balance}}</td>
                 <td>{{n.fee}}</td>
                 <td>{{n.repaymoney}}</td>
               </tr>
             </tbody>
          </table>
        </div>
      </div>
    </template>
    <div v-else-if="showAgreement===1" class="agreement_text">
      <div class="" v-html="$parent.content"></div>
      <div class="" v-html="$parent.content1"></div>
      <div class="btn_box">
        <button @click="agree">我同意</button>
      </div>
    </div>
  </section>
</template>

<script>
  import util from '@/util/index'
  import api from '@/util/function'
  import FormField from '@/components/common/FormField'
  import md5 from 'js-md5'
  export default {
    props: {
      page: {
        type: String
      },
      proData: {
        type: Object
      },
      proText: {
        type: Object
      },
      proData3: {
        type: Object
      },
      proText3: {
        type: Object
      },
      show: {
        type: String
      },
      items: {
        type: Object
      },
      month: {
        type: Object
      }
    },
    components: {
      FormField
    },
    data () {
      return {
        form: [{name: 'password', type: 'password', title: '交易密码', placeholder: '请输入交易密码', pattern: 'telCode'}],
        tips: '请同意服务条款',
        totalPrice: 0,
        showAgreement: 0,
        toggle: false,
        showpay: '',
        close2: require('@/assets/images/close1.jpg')
      }
    },
    methods: {
      pay () {
        var ff = document.querySelector('.payForm')
        if (this.totalPrice > this.$parent.balance) {
          this.check(ff.accept, '余额不足，请充值')
          return false
        }
        var data = api.checkFrom(ff)
        if (!data) return false
        if (!ff.accept.checked) {
          this.check(ff.accept, '请同意服务条款')
          return false
        }
        var self = this
        ff.btn.setAttribute('disabled', true)
        if (this.page === 'cloudCompute') {
          if (this.$parent.show) {
            util.post('productMallLoan', {sign: api.serialize({token: this.$parent.token, product_id: this.$route.params.id, num: this.$parent.number, trade_password: md5(data.password), rate_name: this.$parent.rate})}).then(function (res) {
              api.checkAjax(self, res, () => {
                api.tips('恭喜您购买成功！', () => {
                  self.$router.push({path: '/user/repayment/0'})
                })
              }, ff.btn)
            })
          } else {
            util.post('productMall', {sign: api.serialize({token: this.$parent.token, product_id: this.$route.params.id, num: this.$parent.number, trade_password: md5(data.password)})}).then(function (res) {
              api.checkAjax(self, res, () => {
                api.tips('恭喜您购买成功！', () => {
                  self.$router.push({path: '/user/order/0/1'})
                })
              }, ff.btn)
            })
          }
        } else {
          // 100002:参数缺失，200004：账户余额不足，1000：交易成功，800007：交易失败，800003：禁止交易，200006：交易密码错误，800004：转让已结束，800005：产品已撤销,800008:不能购买自己的产品
          util.post('doTransfer_Hashrate', {sign: api.serialize({token: this.$parent.token, user_id: this.$parent.user_id, transfer_order_id: this.$route.params.id, trade_password: md5(data.password)})}).then(function (res) {
            api.checkAjax(self, res, () => {
              api.tips('恭喜您购买成功！', () => {
                self.$router.push({path: '/user/order/1/1'})
              })
            }, ff.btn)
          })
        }
      },
      openContract (v) {
        this.showAgreement = v
        this.toggle = true
      },
      agree () {
        this.showAgreement = 0
      },
      close (sh) {
        this.showpay = sh
      },
      check (ele, str) {
        this.tips = str
        ele.setAttribute('data-status', 'invalid')
        setTimeout(() => {
          ele.setAttribute('data-status', '')
        }, 2000)
      }
    },
    mounted () {
      if (this.page === 'cloudCompute') {
        if (this.$parent.show) {
          this.totalPrice = this.$parent.detail.one_amount_value * this.$parent.number / 2
        } else {
          this.totalPrice = this.$parent.detail.one_amount_value * this.$parent.number
        }
      } else {
        this.totalPrice = this.$parent.detail.total_price
      }
    },
    filters: {
      format: api.decimal
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
        padding: 10px 0;
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
            .value span{
              font-size: 20px;
            }
          }
          .borderR:not(:last-child){
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
            select{
              width:178px;
              height:22px;
              border:1px solid #dcdcdc;
              border-radius:4px;
              background:#f7f8fa;
              padding-left:15px;
              font-size:12px;
              box-sizing:border-box;
              display:inline-block;
            }
            a{
              color: #327fff;
            }
          }
        }
      }
    }
    .orderPay{
      margin-top: 20px;
      outline: 1px solid #ff975a;
      border: 5px solid #ffe6d7;
      background:$white;
      padding: 20px 25px;
      @include flex(space-between)
      .detail{
        width:60%;
        background: #f7f8fa;
        height: 290px;
        @include flex(space-between)
        .img{
          @include fitimg(295,235)
        }
        .text{
          width:50%;
          padding:25px;
          p{
            color:$light_text;
            .title{
              color: $light_black;
            }
            .value{
              font-size: 18px;
              font-weight: bold;
              color:$text;
            }
            & + p{
              margin-top:30px
            }
          }
        }
      }
      form{
        @include form(v);
        width:360px;
        .pay_text{
          margin-bottom: 20px;
          @include flex(space-between);
          color: $light_black;
          .pay_value{
            span{
              color: #c80009;
              &.value{
                font-size: 24px;
                font-weight: bold;
              }
            }
          }
          .pay_money{
            span{
              color: $text;
              &.money{
                font-weight: bold;
              }
            }
          }
          a{
            color: #327fff;
          }
        }
        .input,.input input{
          line-height: 1.5;
        }
        .input{
          margin-bottom: 25px;
          & span:last-child{
            top: 44px;
            &:before{
              top:0px
            }
          }
        }
        label{
          @include accept_label
        }
        button{
          background: #ff721f;
          border-color: #ff721f;
          margin: 15px 0;
        }
      }
    }
    .agreement_text{
      padding:15px;
      background: #fff;
      .btn_box{
        text-align: center;
        button{
          line-height: 2;
          width:100px;
          margin:30px auto;
          @include button($blue)
        }
      }
    }
    .Installment_plan{
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.2);
      left: 0;
      top:0;
      position: fixed;
      .opacity{
        width: 566px;
        height: 472px;
        background: white;
        top:50%;
        left: 50%;
        margin-left: -333px;
        margin-top:-386px;
        position: absolute;
        padding:0 43px;
        box-sizing: border-box;
        .title{
          width: 100%;
          text-align: center;
          font-size: 18px;
          margin-top: 37px;
          color: black;
          span{
            font-size: 14px;
            font-family: cursive;
            position: absolute;
            right: 0;
            margin-right: 40px;
            cursor: pointer;
          }
        }
        .item{
          width: 100%;
          p{
            float: left;
            font-size: 14px;
            color: black;
            width: 50%;
            text-align: left;
            margin-top: 18px;
          }
        }
        table{
          width: 100%;
          th{
            color: black;
            text-align: center;
          }
          td{
            color: black;
            text-align: center;
          }
        }
      }
    }
  }
</style>
