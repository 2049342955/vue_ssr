<template>
  <section class="pay">
    <div class="pc_box" v-if="isMobile===0">
      <div class="left_box">
        <pay-info :detail="detail"></pay-info>
        <pay-profit :cloudMinerData="cloudMinerData"></pay-profit>
        <hire-purchase :totalPrice="totalPrice*loan" :rateList="rateList" :rate="rate" @setRate="setRate" v-if="detail.isLoan"></hire-purchase>
        <pay-form :totalPrice="totalPrice" :loan="loan" :payNo="payNo" :balance="balance" :form="form" @pay="pay" @setPayNo="setPayNo">
          <span @click="openMask(1)">阅读并接受<a href="javascript:;">《云算力销售协议》</a>、<a href="javascript:;">《云算力托管协议》</a></span>
        </pay-form>
      </div>
      <right-box :totalHash="number*detail.hash" :isLoan="detail.isLoan" :totalPrice="totalPrice" :loan="loan"></right-box>
    </div>
    <div class="mobile_box" v-else-if="isMobile===1">
      <pay-info :detail="detail" :totalPrice="totalPrice"></pay-info>
      <pay-profit :cloudMinerData="cloudMinerData"></pay-profit>
      <pay-form :payNo="payNo" :form="form" @pay="pay" @openMask="openMask">
        <span @click="openMask(1)">阅读并接受<a href="javascript:;">《云算力销售协议》</a>、<a href="javascript:;">《云算力托管协议》</a></span>
      </pay-form>
    </div>
    <my-mask :title="title" position="bottom" :contract="contract" v-if="edit" @closeMask="closeMask">
      <pay-type slot="pay_type" @setPayNo="setPayNo" :payNo="payNo" :balance="+balance"></pay-type>
    </my-mask>
  </section>
</template>

<script>
  import util, { fetchApiData } from '@/util/index'
  import api from '@/util/function'
  import { mapState } from 'vuex'
  import MyMask from '@/components/common/Mask'
  import PayForm from '@/components/pay/PayForm'
  import PayInfo from '@/components/pay/PayInfo'
  import PayType from '@/components/common/PayType'
  import PayProfit from '@/components/pay/PayProfit'
  import HirePurchase from '@/components/cloudCompute/HirePurchase'
  import RightBox from '@/components/pay/RightBox'
  export default {
    components: {
      MyMask, PayType, PayInfo, PayProfit, PayForm, HirePurchase, RightBox
    },
    data () {
      return {
        form: [{name: 'code', type: 'text', title: '短信验证', placeholder: '请输入短信验证码', addon: 2, pattern: 'telCode', len: 6, value2: 0, value3: 0}],
        totalPrice: 0,
        edit: false,
        contract: '',
        rateList: [],
        loan: 0,
        payNo: 2,
        rate: 3,
        detail: {},
        cloudMinerData: {},
        number: 0,
        balance: 0
      }
    },
    methods: {
      pay (e) {
        let ff = e.target
        let url = ''
        let callbackUrl = ''
        let data = {token: this.token}
        if (this.payNo === 1) {
          data = Object.assign({code: ff.code.value, mobile: ff.mobile.value}, data)
        } else {
          callbackUrl = location.protocol + '//' + location.host
        }
        if (this.isMobile) {
          callbackUrl += '/mobile/'
        } else {
          callbackUrl += '/user/'
        }
        callbackUrl += 'order/0'
        if (this.detail.isLoan) {
          url = 'productMallLoan'
          if (this.payNo === 2) {
            data = Object.assign({url: callbackUrl, mode: '3'}, data)
          }
          data = Object.assign({product_id: this.detail.id, rate_name: this.rate, num: this.number}, data)
        } else {
          url = 'productMall'
          if (this.payNo === 2) {
            data = Object.assign({url: callbackUrl, mode: '1'}, data)
          }
          data = Object.assign({product_id: this.detail.id, num: this.number}, data)
        }
        ff.btn.setAttribute('disabled', true)
        fetchApiData(this, url, data, (res) => {
          this.paySuccess(callbackUrl, res, ff.btn)
        }, ff.btn)
      },
      paySuccess (url, data, btn) {
        var str = '恭喜您购买成功！'
        if (this.payNo === 2) {
          this.alipay(url, data)
          btn.removeAttribute('disabled')
        } else {
          api.tips(str, () => {
            this.$router.push({path: '/cloudCompute/paySuccess'})
          })
        }
      },
      alipay (url, data) {
        if (api.checkWechat()) {
          api.tips('请在浏览器里打开')
          return false
        }
        data.subject = encodeURIComponent(data.subject)
        fetchApiData(this, 'alipay_wap', Object.assign({is_mobile: +this.isMobile, url: url, token: this.token}, data), (resData) => {
          location.href = resData.url
        })
      },
      openMask (n) {
        document.body.style.overflow = 'hidden'
        window.scroll(0, 0)
        this.edit = n
        this.contract = ''
        if (n === 1) {
          this.contract = this.content1 ? this.content + '<br>' + this.content1 : this.content
          this.title = '协议详情'
        } else if (n === 3) {
          this.title = '支付方式'
        }
      },
      closeMask () {
        document.body.style.overflow = 'auto'
        this.edit = false
      },
      setRate (n) {
        this.rate = +n
      },
      setPayNo (k) {
        this.payNo = k
        this.closeMask()
      },
      pageInit () {
        if (this.token && this.number) {
          this.totalPrice = this.detail.one_amount_value * +this.number
          this.form[0].value2 = this.detail.one_amount_value
          this.form[0].value3 = +this.number
          var url = 'productOrder'
          var data = {token: this.token, num: this.number, product_id: this.detail.id}
          fetchApiData(this, url, data, (res) => {
            this.balance = +res.balance
            if (res.output) {
              this.detail.output = res.output
              this.detail.total_electric_fee = res.total_electric_fee
            }
            if (this.detail.isLoan) {
              this.content = res.part_content
              this.rateList = res.period_num
              this.rate = this.rateList[0] && +this.rateList[0].num
              this.loan = +res.loan_limit
              if (this.isMobile) {
                this.totalPrice = this.totalPrice - this.detail.loanPrice
                this.rate = this.detail.rate
              }
            } else {
              this.content = res.content
            }
            this.content1 = res.content1
          })
          if (!this.detail.bdc_id) return false
          util.post('bdc_info', {token: this.token, bdc_id: this.detail.bdc_id}).then((res) => {
            this.cloudMinerData = {...res.msg, batch_area: this.detail.batch_area}
          })
        } else {
          setTimeout(() => {
            this.pageInit()
          }, 5)
        }
      }
    },
    mounted () {
      var p2 = api.getStorge('info')
      if (p2) {
        this.detail = p2
        this.number = this.detail.number
      } else {
        this.$router.push({path: '/minerShop/detail'})
      }
      this.pageInit()
    },
    filters: {
      format: api.decimal
    },
    computed: {
      ...mapState({
        token: state => state.info.token,
        mobile: state => state.info.mobile,
        isMobile: state => state.isMobile,
        trade_password: state => state.info.trade_password
      })
    }
  }
</script>

<style type="text/css" lang="scss">
  .pay{
    @include main
    color: #999;
    .pc_box {
      @include flex(flex-start,flex-start)
      .left_box{
        width:calc(100% - 280px);
        h3.title{
          font-size: 16px;
          font-weight: bold;
          color: #333;
          padding: 10px 15px;
          border-top: 2px solid $blue_border;
          background: #FAFAFA;
        }
      }
    }
    .mobile_box {
      min-height: calc(100vh - 0.88rem);
      padding-bottom: 57px;
      font-size: 0.3rem;
      color:$text;
      background: #F1F2F7;
      padding-top: 0.2rem;
    }
  }
</style>
