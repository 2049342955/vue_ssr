<template>
  <section class="pay">
    <div class="left_box">
      <div class="order_msg" v-if="$route.params.type==='1'">
        <h3 class="title">选择收货地址</h3>
        <div class="address_box">
          <div :class="['item',{active:k===addressNo}]" v-for="a,k in addressData">
            <span @click="selectAddress(k)">{{a.province_name+a.city_name+a.area_name+a.area_details+'('+a.post_user+' 收) '+a.post_mobile}}</span>
            <span v-if="a.is_default">默认地址</span>
            <span class="set_default" v-else @click="setDefault(a.id)">设为默认地址</span>
          </div>
          <div class="address_btn" @click="openContract(2)">使用新地址</div>
        </div>
      </div>
      <div class="order_msg">
        <h3 class="title">确认订单信息</h3>
        <div class="order_detail">
          <div class="order_detail_info1">
            <template v-for="d,k in proData">
              <div class="item">
                <p class="value" v-if="k==='number'&&page==='minerShop'"><span>{{$parent.number}}{{d.unit}}</span></p>
                <p class="value" v-else-if="k==='number'&&page!=='minerShop'"><span>{{$parent.detail.hash}}{{d.unit}}</span></p>
                <p class="value" v-else><span>{{$parent.detail[k]}}{{d.unit}}</span></p>
                <p>{{d.title}}</p>
              </div>
              <div class="line"></div>
            </template>
          </div>
          <div class="order_detail_info2" v-if="$route.params.type!=='1'">
            <div class="item" v-for="t,k in proText">{{t}}：
              <span class="value" v-if="k==='hash'">{{$parent.detail[k]}}T</span>
              <span class="value" v-else-if="k==='status'">{{$parent.str[$parent.detail[k]]}}</span>
              <span class="value" v-else>{{$parent.detail[k]}}</span>
            </div>
          </div>
        </div>
      </div>
      <div class="order_msg" v-if="$route.params.type!=='1'">
        <h3 class="title" style="margin-bottom:15px;">挖矿收益信息</h3>
        <div class="order_info">
          <span class="infot_left">今日每T预期收益</span>
          <span class="infot_right">0.2356984<em>btc</em></span>
        </div>
        <div class="order_info">
          <span class="infot_left">每日电费支出约</span>
          <span class="infot_right">0.2356984<em>btc</em></span>
        </div>
        <div class="order_info" style="margin-bottom:42px;">
          <span class="infot_left">批次所在区域位于</span>
          <span class="infot_right" style="font-weight: 100;">{{$parent.detail.has_product_miner_base.batch_area}}</span>
        </div>
      </div>
      <div class="order_msg" v-show="$parent.show">
        <h3 class="title" style="background:#01bfb5;color:white;">分期购买计划</h3>
        <div class="orderDetail">
          <table border="0">
             <thead>
               <tr>
                 <th v-for="n,k in thead">{{n.title}}</th>
               </tr>
             </thead>
             <tbody>
               <tr :class="{active: check1===0}">
                 <td><input type="radio" class="teradio" name="qi" @click="radio(0)" checked/></td>
                 <td>{{$parent.detail.one_amount}}</td>
                 <td>3期</td>
                 <td>24%</td>                   
                 <td>{{(($parent.detail.one_amount + ($parent.detail.one_amount*0.24))/3).toFixed(2)}}（含每期手续费）</td>                
                 <td>{{(($parent.detail.one_amount*0.24)/3).toFixed(2)}}</td>                 
               </tr>
               <tr  :class="{active: check1===1}">
                 <td><input type="radio" name="qi" class="teradio" @click="radio(1)"/></td>
                 <td>{{$parent.detail.one_amount}}</td>
                 <td>6期</td>
                 <td>36%</td>
                 <td>{{(($parent.detail.one_amount + ($parent.detail.one_amount*0.36))/6).toFixed(2)}}（含每期手续费）</td>
                 <td>{{(($parent.detail.one_amount*0.36)/6).toFixed(2)}}</td>
               </tr>
             </tbody>
          </table>
        </div>
      </div>
      <div class="order_msg order_pay">
        <h3 class="title">支付订单信息</h3>
        <div :class="['pay_text',{active:payNo===1}]">
          <div class="pay_value">
            <input type="radio" name="payType" @click="setPay(1)" checked>
            <span class="yue">账户余额{{$parent.balance}}元</span>
          </div>
          <div class="pay_info">
            <span>金额不足，可先</span>
            <router-link to="/user/recharge">充值</router-link>
          </div>
        </div>
        <div :class="['pay_text',{active:payNo===2}]">
          <div class="pay_value">
            <input type="radio" name="payType" @click="setPay(2)">
            <span class="zhifubao">支付宝</span>
          </div>
          <div class="pay_info">
            <span>支付</span>
            <span class="money">{{(page==='minerShop'?totalPrice:$parent.detail.total_price)|format}}</span>
            <span>元</span>
          </div>
        </div>
        <form class="form payForm" action="" @submit.prevent="pay" novalidate>
          <FormField :form="form" class="form" v-if="payNo===1"></FormField>
          <label for="accept">
            <input type="checkbox" :value="accept" id="accept" name="accept" @click="setAssept">
            <span @click="openContract(1)">阅读并接受<a href="javascript:;" style="color:#327fff;">《矿机{{page === 'minerShop'? '销售':'转让'}}协议》</a><template v-if="$route.params.type!=='1'">和<a href="javascript:;" style="color:#327fff;">《矿机托管协议》</a></template></span>
            <span class="select_accept">{{tips}}</span>
          </label>
          <button name="btn">确认支付</button>
        </form>
      </div>
    </div>
    <div class="right_box">
      <div class="order_title">订单信息</div>
      <div class="item">
        <span>总算力</span>
        <span>{{$parent.number*$parent.detail.hash}}T</span>
      </div>
      <div class="item">
        <span>支付金额</span>
        <span class="price">￥{{(page==='minerShop'?totalPrice:$parent.detail.total_price)|format}}元</span>
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
          <span v-if="k==='number'&&page==='minerShop'">{{$parent.number}}{{m.unit}}</span>
          <span v-else-if="k==='number'&&page!=='minerShop'">{{$parent.detail.hash}}{{m.unit}}</span>
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
            <span @click="openContract(1,1)">阅读并接受<a href="javascript:;" style="color:#327fff;">《矿机{{page === 'minerShop'? '销售':'转让'}}协议》</a><template v-if="$route.params.type!=='1'">、<a href="javascript:;" style="color:#327fff;">《矿机托管协议》</a></template></span>
            <span class="select_accept">{{tips}}</span>
          </label>
        </div>
      </form>
    </div>
    <MyMask :form="address" :title="title" :contract="contract" :val="addressObject" v-if="edit"></MyMask>
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
  import MyMask from '@/components/common/AddressMask'
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
        tbody: [{fen: '85255'}],
        thead: [{title: '选择'}, {title: '分期金额（元）'}, {title: '分期期数'}, {title: '手续费率 （%）'}, {title: '每期应还（元）'}, {title: '每期手续费（元）'}],
        form: [{name: 'password', type: 'password', title: '交易密码', placeholder: '请输入交易密码', pattern: 'telCode'}],
        tips: '请同意服务条款',
        totalPrice: 0,
        accept: false,
        edit: 0,
        mobileEdit: false,
        contract: '',
        // showpay: '',
        close2: require('@/assets/images/close1.jpg'),
        mobileNav1: {one_amount_value: {title: '每台服务器价格', unit: '元'}, number: {title: '购买服务器数量', unit: '台'}, batch_area: {title: '批次所在区域', unit: ''}},
        mobileNav2: {one_amount_value: {title: '每台服务器价格', unit: '元'}, number: {title: '购买服务器数量', unit: '台'}, hash: {title: '每台服务器算力', unit: 'T'}},
        mobileNav: {},
        address: [{name: 'post_user', type: 'text', title: '姓名', placeholder: '请输入姓名', isChange: true}, {name: 'post_mobile', type: 'text', title: '手机号码', placeholder: '请输入手机号码', pattern: 'tel'}, {name: 'address', type: 'select', title: '地址', isChange: true}, {name: 'area_details', type: 'text', title: '详细地址', placeholder: '请输入详细地址', isChange: true}, {name: 'is_default', type: 'radio', title: '是否设为默认地址'}],
        isMobile: false,
        addressData: [],
        addressObject: {},
        addressNo: 0,
        payNo: 1,
        check1: 0
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
        if (this.payNo === 1) {
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
        } else {
          callbackUrl = location.protocol + '//' + location.host
        }
        if (mobile === 1) {
          callbackUrl += '/mobile/'
        } else {
          callbackUrl += '/user/'
        }
        if (!ff.accept.checked) {
          this.tip(mobile, '请同意服务条款', ff.accept)
          return false
        }
        if (this.$route.params.type === '1') {
          url = 'saveMiner'
          callbackUrl += 'order/3/1'
          if (this.payNo === 2) {
            data = Object.assign({url: callbackUrl, mode: '2'}, data)
          }
          data = Object.assign({post_id: this.addressData[this.addressNo].id, user_id: this.$parent.user_id, miner_id: this.$route.params.id, number: this.$parent.number}, data)
        } else {
          if (this.page === 'minerShop') {
            if (this.$parent.show) {
              var rate = ''
              if (this.check1 === 0) {
                rate = 3
              } else if (this.check1 === 1) {
                rate = 6
              }
              url = 'productMallLoan'
              data = Object.assign({product_id: this.$route.params.id, rate_name: rate, num: this.$parent.number}, data)
              callbackUrl = 'repayment/0'
            } else {
              callbackUrl += 'order/0/1'
              if (this.payNo === 2) {
                url = 'applyBalanceRecharge'
                data = Object.assign({url: callbackUrl, mode: '1'}, data)
              } else {
                url = 'productMall'
              }
              data = Object.assign({product_id: this.$route.params.id, num: this.$parent.number, user_id: this.$parent.user_id}, data)
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
            self.paySuccess(mobile, callbackUrl, res)
          }, ff.btn)
        })
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
      paySuccess (mobile, url, data) {
        var str = '恭喜您购买成功！'
        if (mobile === 1) {
          if (this.payNo === 2) {
            this.alipay(mobile, url, data)
          } else {
            Toast({
              message: str,
              position: 'middle',
              duration: 3000
            })
            setTimeout(() => {
              this.$router.push({path: url})
            }, 3000)
          }
        } else {
          if (this.payNo === 2) {
            this.alipay(mobile, url, data)
          } else {
            api.tips(str, () => {
              this.$router.push({path: url})
            })
          }
        }
      },
      alipay (mobile, url, data) {
        var self = this
        data.subject = encodeURIComponent(data.subject)
        util.post('alipay_wap', {sign: api.serialize(Object.assign({is_mobile: mobile, url: url, token: self.$parent.token}, data))}).then((resData) => {
          api.checkAjax(self, data, () => {
            location.href = resData.url
          })
        })
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
        data.is_default = 1
        data.token = this.$parent.token
        var self = this
        util.post('addAddress', {sign: api.serialize(data)}).then(function (res) {
          api.checkAjax(self, res, () => {
            self.getAddress()
            self.prompt('添加成功')
            self.closeEdit(self.isMobile)
          }, form.btn)
        })
      },
      selectAddress (k) {
        this.addressNo = k
      },
      setDefault (id) {
        var self = this
        util.post('setDefault', {sign: api.serialize({token: this.$parent.token, post_id: id})}).then(function (res) {
          api.checkAjax(self, res, () => {
            self.prompt('设置成功')
            self.getAddress()
          })
        })
      },
      checkeds () {
      },
      radio (k) {
        this.check1 = k
        var radios = document.getElementsByClassName('teradio')
        console.log(radios.length)
        for (var a = 0; a < radios.length; a++) {
        }
      },
      setPay (k) {
        this.payNo = k
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
      },
      getAddress () {
        var self = this
        util.post('showAddress', {sign: api.serialize({token: this.$parent.token, user_id: this.$parent.user_id})}).then(function (res) {
          api.checkAjax(self, res, () => {
            self.addressData = res
          })
        })
      }
    },
    mounted () {
      if (this.page === 'minerShop') {
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
      this.getAddress()
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
    @include flex(flex-start,flex-start)
    .left_box{
      width:calc(100% - 280px);
      .order_msg{
        background: #fff;
        h3.title{
          font-size: 16px;
          font-weight: bold;
          color: #333;
          padding: 10px 15px;
          border-top: 2px solid $blue_border;
          background: #FAFAFA;
        }
        .order_info{
          width: 100%;
          padding-left: 62px;
          margin-bottom: 15px;
          .infot_left{
            width: 121px;
            height: auto;
            display:inline-block;
            text-align: right;
            margin-right: 54px;
            font-size: 14px;
          }
          .infot_right{
            font-size: 16px;
            color: #121212;
            font-weight: 800;
            em{
              font-style: normal;
              font-size: 14px;
              margin-left: 10px;
              font-weight: 100;
            }
          }
        }
        .orderDetail{
          width: 100%;
          table{
            width: 900px;
          }
          thead{
            height: 40px !important;
            line-height: 40px;
            border:1px solid #e5e5e5;
            background:#f5f5f5;
            width: 900px;
            box-sizing: border-box;
          }
          tbody{
            tr{
              line-height: 56px;
              border-bottom: 1px solid #e5e5e5;
              td{
                color: #121212;
                font-size: 14px;
                text-align: center;
                input{
                  @include checkbox(18);
                  border:1px solid #d2d2d2;
                  width: 12px;
                  border-radius: 0;
                  height: 12px;
                  background:white;
                }
              }
              &:hover{
                background:#edffff;
              }
              &.active{
                background:#edffff;
              }
            }
          }
        }
        .order_detail{
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
            @include flex(space-between);
            margin: 20px 0;
            border: 1px solid #eee;
            padding: 20px 25px;
            .item{
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
        .address_box{
          @include address_data
        }
        @include mobile_hide
      }
      .order_pay{
        margin-top: 20px;
        background:$white;
        .pay_text{
          padding:15px 20px;
          margin:10px 15px;
          @include flex(space-between);
          color: $light_black;
          border-bottom:1px solid $border;
          .pay_value{
            input{
              @include checkbox(18)
              margin-right:5px;
              vertical-align: text-top;
            }
            span{
              line-height: 25px;
              height:25px;
              &:before{
                font-family:"iconfont" !important;
                font-size: 26px;
                padding-right:8px;
                line-height: 25px;
                vertical-align: bottom;
              }
              &.yue:before{
                content:'\e60c'
              }
              &.zhifubao:before{
                content:'\e615';
                color:#00AAF0
              }
            }
          }
          .pay_info{
            .money{
              color:$orange;
              font-weight: bold;
            }
          }
          a{
            color: #327fff;
          }
          &.active{
            outline:5px solid $blue_border
          }
        }
        form{
          padding:15px;
          @include form(v);
          width:340px;
          margin:30px auto 0 auto;
          .input,.input input{
            line-height: 1.5;
          }
          .input{
            margin-bottom: 25px;
            & > span:first-child,& > span:nth-child(2){
              display: none;
            }
            input{
              padding-left:15px;
              height:42px;
            }
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
            background: #FE5038;
            border-color: #FE5038;
            margin: 10px 0;
            line-height: 2.2;
          }
        }
        @include mobile_hide
      }
      .installment_plan{
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
        }
      }
    }
    .right_box{
      position: fixed;
      top:80px;
      right:calc(50% - 590px);
      width:260px;
      margin-left:20px;
      border:1px solid $blue_border;
      padding:15px 15px 30px 15px;
      background: #F2F6FF;
      line-height: 2.4;
      color:$text;
      .item{
        border-top:1px solid $blue_border;
        @include flex(space-between)
        .price{
          color:$orange;
          font-weight: bold;
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
