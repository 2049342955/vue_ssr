<template>
  <section class="pay">
    <div class="orderMsg">
      <h3 class="title">确认订单信息</h3>
      <div class="orderDetail">
        <div class="order_detail_info1">
          <template v-for="d,k in proData">
            <div class="item">
              <p class="value" v-if="k==='number'&&page==='cloudCompute'"><span>{{$parent.number}}{{d.unit}}</span></p>
              <p class="value" v-else-if="k==='number'&&page!=='cloudCompute'"><span>{{$parent.detail.hash}}{{d.unit}}</span></p>
              <p class="value" v-else><span>{{$parent.detail[k]}}{{d.unit}}</span></p>
              <p>{{d.title}}</p>
            </div>
            <div class="line"></div>
          </template>
        </div>
        <div class="order_detail_info2" v-if="$route.params.type!=='1'">
          <p v-for="t,k in proText">{{t}}：
            <span class="value" v-if="k==='hash'">{{$parent.detail[k]}}T</span>
            <span class="value" v-else-if="k==='status'">{{$parent.str[$parent.detail[k]]}}</span>
            <span class="value" v-else>{{$parent.detail[k]}}</span>
          </p>
        </div>
        <!-- <div class="address_input" @click="openContract(2)" v-else>
          <template v-if="addressData">{{decodeURIComponent(addressData.province_name+addressData.city_name+addressData.area_name+addressData.area_details+' '+addressData.post_user)+'('+addressData.post_mobile+')'}}</template>
          <template v-else>+ 添加地址</template>
        </div> -->
      </div>
    </div>
    <div class="orderMsg" v-show="$parent.show">
      <h3 class="title">分期详情</h3>
      <div class="orderDetail">
        <div class="order_detail_info1">
          <template v-for="d,k in proData3">
            <div class="item">
              <p class="value" v-if="k==='number'&&page==='cloudCompute'"><span>{{$parent.number}}{{d.unit}}</span></p>
              <p class="value" v-else-if="k==='number'&&page!=='cloudCompute'"><span>{{$parent.detail.hash}}{{d.unit}}</span></p>
              <p class="value" v-else><span>{{$parent.detail[k]}}{{d.unit}}</span></p>
              <p>{{d.title}}</p>
            </div>
            <div class="line"></div>
          </template>
        </div>
        <div class="order_detail_info2">
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
        <img :src="$parent.detail.product_img||$parent.detail.minerPicture" alt="">
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
          <input type="checkbox" :value="accept" id="accept" name="accept" @click="setAssept">
          <span @click="openContract(1)">阅读并接受<a href="javascript:;" style="color:#327fff;">《矿机{{page === 'cloudCompute'? ($parent.show?'分期':'销售'):'转让'}}协议》</a><template v-if="$route.params.type!=='1'">和<a href="javascript:;" style="color:#327fff;">《矿机托管协议》</a></template></span>
          <span class="select_accept">{{tips}}</span>
        </label>
        <button name="btn">确认支付</button>
        <!-- <div class="zhifubao_btn" @click="zhifubao">支付宝支付</div> -->
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
    <div class="mobile_box">
      <div class="price">
        <span>应付金额</span>
        <span class="val">{{$parent.totalPrice}}元</span>
      </div>
      <div class="confirm_info">
        <div class="item" v-for="m,k in mobileNav">
          <span>{{m.title}}</span>
          <span v-if="k==='number'&&page==='cloudCompute'">{{$parent.number}}{{m.unit}}</span>
          <span v-else-if="k==='number'&&page!=='cloudCompute'">{{$parent.detail.hash}}{{m.unit}}</span>
          <span v-else>{{$parent.detail[k]}}{{m.unit}}</span>
        </div>
      </div>
      <form action="" class="form payForm2" @submit.prevent="pay(1)" novalidate>
        <div class="pay_info">
          <div class="pay_item">
            <div>
              <span>可用余额</span>
              <span class="val">{{$parent.balance}}元</span>
            </div>
            <router-link to="/mobile/recharge">充值</router-link>
          </div>
          <div class="pay_item">
            <mt-field type="password" label="交易密码" name="password" placeholder="请输入交易密码" state="" @blur="test"></mt-field>
          </div>
        </div>
        <div class="mobile_btn">
          <mt-button type="primary" size="large" name="btn">确认支付</mt-button>
          <label for="accept">
            <input type="checkbox" :value="accept" id="accept" name="accept" @click="setAssept">
            <span @click="openContract(1,1)">阅读并接受<a href="javascript:;" style="color:#327fff;">《矿机{{page === 'cloudCompute'? ($parent.show?'分期':'销售'):'转让'}}协议》</a><template v-if="$route.params.type!=='1'">、<a href="javascript:;" style="color:#327fff;">《矿机托管协议》</a></template></span>
            <span class="select_accept">{{tips}}</span>
          </label>
        </div>
      </form>
    </div>
    <MyMask :form="address" :title="title" :contract="contract" v-if="edit"></MyMask>
    <mt-popup position="bottom" v-model="mobileEdit" :closeOnClickModal="false">
      <div class="close" @click="closeEdit(1)">
        <span class="icon"></span>
      </div>
      <div class="agreement" v-if="contract" v-html="contract"></div>
      <form class="form" @submit.prevent="submit" novalidate v-else>
        <FormField :form="address"></FormField>
        <button name="btn">提交</button>
      </form>
    </mt-popup>
  </section>
</template>

<script>
  import { Toast } from 'mint-ui'
  import util from '@/util/index'
  import api from '@/util/function'
  import FormField from '@/components/common/FormField'
  import MyMask from '@/components/common/Mask'
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
      FormField, MyMask
    },
    data () {
      return {
        form: [{name: 'password', type: 'password', title: '交易密码', placeholder: '请输入交易密码', pattern: 'telCode'}],
        tips: '请同意服务条款',
        totalPrice: 0,
        accept: false,
        edit: 0,
        mobileEdit: false,
        contract: '',
        showpay: '',
        close2: require('@/assets/images/close1.jpg'),
        mobileNav1: {one_amount_value: {title: '每台服务器价格', unit: '元'}, number: {title: '购买服务器数量', unit: '台'}, income: {title: '今日每T预期收益', unit: 'btc'}, electricityFees: {title: '运维费约', unit: 'btc'}, batch_area: {title: '批次所在区域', unit: ''}},
        mobileNav2: {one_amount_value: {title: '每台服务器价格', unit: '元'}, number: {title: '购买服务器数量', unit: '台'}, hash: {title: '每台服务器算力', unit: 'T'}},
        mobileNav: {},
        address: [{name: 'post_user', type: 'text', title: '姓名', placeholder: '请输入姓名', isChange: true}, {name: 'post_mobile', type: 'text', title: '手机号码', placeholder: '请输入手机号码', pattern: 'tel'}, {name: 'address', type: 'select', title: '地址', isChange: true}, {name: 'area_details', type: 'text', title: '详细地址', placeholder: '请输入详细地址', isChange: true}],
        isMobile: false,
        addressData: ''
      }
    },
    methods: {
      pay (mobile) {
        var ff = (mobile === 1) ? document.querySelector('.payForm2') : document.querySelector('.payForm')
        var val = ff[0].value
        var url = ''
        var callbackUrl = ''
        var data = {token: this.$parent.token, trade_password: md5(val)}
        if (this.totalPrice > this.$parent.balance) {
          this.tip(mobile, '余额不足，请充值', ff.accept)
          return false
        }
        if (!val) {
          this.tip(mobile, '交易密码不能为空', ff.accept)
          return false
        } else if (!api.check('^[0-9]{6}$', ff[0].value)) {
          if (mobile === 1) {
            Toast({
              message: '请输入6位数字',
              position: 'middle',
              duration: 3000
            })
          }
          return false
        }
        if (!ff.accept.checked) {
          this.tip(mobile, '请同意服务条款', ff.accept)
          return false
        }
        if (this.$route.params.type === '1') {
          if (!this.addressData) {
            this.tip(mobile, '请填写收货地址', ff.accept)
            this.openContract(2, mobile)
            return false
          }
          url = 'saveMiner'
          data = Object.assign({user_id: this.$parent.user_id, miner_id: this.$route.params.id, number: this.$parent.number}, data, this.addressData)
          callbackUrl = 'order/3/1'
        } else {
          if (this.page === 'cloudCompute') {
            if (this.$parent.show) {
              url = 'productMallLoan'
              data = Object.assign({product_id: this.$route.params.id, rate_name: this.$parent.rate, num: this.$parent.number}, data)
              callbackUrl = 'repayment/0'
            } else {
              url = 'productMall'
              data = Object.assign({product_id: this.$route.params.id, num: this.$parent.number}, data)
              callbackUrl = 'order/0/1'
            }
          } else {
            url = 'doTransfer_Hashrate'
            data = Object.assign({user_id: this.$parent.user_id, transfer_order_id: this.$route.params.id, num: this.$parent.number}, data)
            callbackUrl = 'order/1/1'
          }
        }
        var self = this
        ff.btn.setAttribute('disabled', true)
        util.post(url, {sign: api.serialize(data)}).then(function (res) {
          api.checkAjax(self, res, () => {
            if (mobile === 1) {
              callbackUrl = '/mobile/' + callbackUrl
            } else {
              callbackUrl = '/user/' + callbackUrl
            }
            self.paySuccess(mobile, callbackUrl)
          }, ff.btn)
        })
      },
      zhifubao (mobile) {
        console.log(mobile)
      },
      openContract (n, mobile) {
        this.isMobile = (mobile === 1) && 1
        this.openMask(mobile, n)
        document.body.style.overflow = 'hidden'
        if (n === 1) {
          this.contract = this.$parent.content1 ? this.$parent.content + '<br>' + this.$parent.content1 : this.$parent.content
          this.title = '协议详情'
          this.accept = true
        } else if (n === 2) {
          this.contract = ''
          this.title = '收货地址'
        }
      },
      closeEdit (mobile) {
        document.body.style.overflow = 'auto'
        if (mobile === 1) {
          this.mobileEdit = false
        } else {
          this.edit = ''
        }
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
      },
      test (e) {
        var ele = e.target
        var ff = document.querySelector('.form')
        api.checkFiled(ele, ff)
      },
      tip (mobile, str, ele) {
        if (mobile === 1) {
          Toast({
            message: str,
            position: 'middle',
            duration: 3000
          })
        } else {
          this.check(ele, str)
        }
      },
      paySuccess (mobile, url) {
        var str = '恭喜您购买成功！'
        if (mobile === 1) {
          Toast({
            message: str,
            position: 'middle',
            duration: 3000
          })
          setTimeout(() => {
            this.$router.push({path: url})
          }, 3000)
        } else {
          api.tips(str, () => {
            this.$router.push({path: url})
          })
        }
      },
      openMask (mobile, n) {
        window.scroll(0, 0)
        if (mobile === 1) {
          this.mobileEdit = true
        } else {
          this.edit = n
        }
      },
      submit (e) {
        var form = e.target
        var data = api.checkFrom(form, this, this.isMobile)
        if (!data) return false
        this.addressData = data
        this.prompt('收货地址已提交，点击“确认支付”完成购买')
        this.closeEdit(this.isMobile)
      },
      prompt (str) {
        if (this.isMobile) {
          this.myToast(str)
        } else {
          api.tips(str)
        }
      },
      myToast (str) {
        Toast({
          message: str,
          position: 'middle',
          duration: 3000
        })
      },
      setAssept (e) {
        this.accept = e.target.checked
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
      if (this.$route.params.type === '1') {
        this.mobileNav = this.mobileNav2
      } else {
        this.mobileNav = this.mobileNav1
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
        .order_detail_info1{
          @include flex(space-between);
          background: #fff9f3;
          padding: 25px;
          text-align: center;
          .item{
            .value span{
              font-size: 20px;
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
        .order_detail_info2{
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
      @include mobile_hide
      .address_input{
        border: 1px solid #eee;
        margin: 20px 0;
        padding: 10px 25px;
        text-align: center;
        color:$orange;
        cursor: pointer;
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
        width:50%;
        background: #f7f8fa;
        height: 290px;
        img{
          width:100%;
          height:100%;
          object-fit:cover
        }
      }
      form{
        @include form(v);
        width:45%;
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
        .zhifubao_btn{
          font-size: 16px;
          color:#fff;
          padding:5px 10px;
          cursor: pointer;
          border-radius:5px;
          background: $blue;
          text-align: center;
          line-height: 38px;
        }
        button{
          background: #ff721f;
          border-color: #ff721f;
          margin: 10px 0;
        }
      }
      @include mobile_hide
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
    .mobile_box{
      @include mobile_show
      margin-top:-15px;
      font-size: 0.56rem;
      color:$text;
      .price,.confirm_info,.pay_info{
        padding:0 15px;
        background: #fff;
      }
      .price{
        @include flex(space-between)
        line-height: 60px;
        margin-bottom:15px;
        .val{
          color:$orange
        }
      }
      .confirm_info{
        margin-bottom:15px;
        .item{
          @include flex(space-between)
          line-height: 50px;
          span:last-child{
            color:$light_black
          }
          &:not(:last-child){
            border-bottom:1px solid $border;
          }
        }
      }
      .pay_info{
        padding-bottom:15px;
        .pay_item{
          @include flex(space-between)
          line-height: 50px;
          div span.val{
            color:$light_text;
            margin-left:15px;
          }
          a{
            color:$blue
          }
          .mint-cell{
            width:100%;
            .mint-cell-wrapper{
              padding:10px 0;
              border:0;
              .mint-cell-title{
                width:85px;
                color:$text
              }
              .mint-cell-value{
                width:calc(100% - 85px);
                input{
                  width:100%;
                  height:40px;
                  line-height: 40px;
                  border:1px solid $border;
                  border-radius:3px;
                  padding: 0 10px;
                }
                .mint-field-state{
                  position: absolute;
                  right:15px;
                }
              }
            }
          }
        }
      }
      .mobile_btn{
        padding:15px;
        button{
          margin-bottom:10px;
          label{
            color:$white;
          }
        }
        label{
          font-size: 0.5rem;
          @include accept_label
          input{
            @include checkbox(18,0)
          }
        }
        // margin-top:15px
      }
    }
    .mask_con{
      h2{
        line-height: 52px;
        padding:0 28px;
        border-bottom: 1px solid $border;
      }
    }
    .mint-popup{
      @include popup
    }
  }
</style>
