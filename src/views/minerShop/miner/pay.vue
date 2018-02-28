<template>
  <section class="pay">
    <div class="pc_box" v-if="isMobile===0">
      <div class="left_box">
        <pay-info :detail="detail"></pay-info>
        <miner-address :addressObject="addressObject" :addressData="addressData" @getAddress="getAddress" @selectAddress="selectAddress" @openMask="openMask"></miner-address>
        <pay-form :totalPrice="totalPrice" :payNo="payNo" :balance="balance" :form="form" @pay="pay" @setPayNo="setPayNo">
          <span @click="openMask(1)">阅读并接受<a href="javascript:;">《算力服务器销售协议》</a></span>
        </pay-form>
      </div>
      <right-box :totalHash="number*detail.hash" :totalPrice="totalPrice"></right-box>
    </div>
    <div class="mobile_box" v-else-if="isMobile===1">
      <pay-info :detail="detail" :totalPrice="totalPrice"></pay-info>
      <miner-address :addressObject="addressObject" @selectAddress="selectAddress"></miner-address>
      <pay-form :payNo="payNo" :form="form" @pay="pay" @openMask="openMask">
        <span @click="openMask(1)">阅读并接受<a href="javascript:;">《算力服务器销售协议》</a></span>
      </pay-form>
    </div>
    <my-mask :form="addressForm" :title="title" position="bottom" :contract="contract" v-if="edit" @submit="submit" @closeMask="closeMask">
      <pay-type slot="pay_type" @setPayNo="setPayNo" :payNo="payNo" :balance="+balance"></pay-type>
    </my-mask>
  </section>
</template>

<script>
  import { fetchApiData } from '@/util'
  import { paySuccess, alipay, closeMask, openMask } from '@/service/pay'
  import api from '@/util/function'
  import { mapState } from 'vuex'
  import { postAddress } from '@/util/form'
  import MyMask from '@/components/common/Mask'
  import PayType from '@/components/common/PayType'
  import PayInfo from '@/components/pay/PayInfo'
  import PayForm from '@/components/pay/PayForm'
  import MinerAddress from '@/components/miner/MinerAddress'
  import HirePurchase from '@/components/cloudCompute/HirePurchase'
  import RightBox from '@/components/pay/RightBox'
  export default {
    components: {
      MyMask, PayInfo, PayForm, PayType, MinerAddress, HirePurchase, RightBox
    },
    data () {
      return {
        form: [{name: 'code', type: 'text', title: '短信验证', placeholder: '请输入短信验证码', addon: 2, pattern: 'telCode', len: 6, value2: 0, value3: 0}],
        address: postAddress,
        totalPrice: 0,
        edit: false,
        contract: '',
        addressData: [],
        addressObject: {},
        addressForm: [],
        payNo: 2,
        detail: {},
        number: 0,
        balance: 0
      }
    },
    methods: {
      pay (e) {
        let ff = e.target
        let callbackUrl = ''
        let data = {token: this.token}
        let newData = {}
        if (!this.addressObject.id) {
          api.tips('请添加地址')
          return false
        }
        if (this.payNo === 1) {
          newData = {code: ff.code.value, mobile: ff.mobile.value}
        }
        if (this.payNo === 2) {
          callbackUrl = location.protocol + '//' + location.host + '/user/order/3'
          newData = {url: callbackUrl, mode: '2'}
        }
        data = Object.assign({post_id: this.addressObject.id, miner_id: this.detail.id, number: this.number}, data, newData)
        ff.btn.setAttribute('disabled', true)
        fetchApiData(this, 'saveMiner', data, (res) => {
          this.paySuccess(callbackUrl, res, ff.btn)
        }, ff.btn)
      },
      alipay,
      paySuccess,
      submit (e) {
        var form = e.target
        var data = api.checkForm(form, this.isMobile)
        if (!data) return false
        data.is_default = 1
        data.token = this.token
        fetchApiData(this, 'addAddress', data, (res) => {
          this.getAddress()
          api.tips('添加成功')
          this.closeMask()
        }, form.btn)
      },
      openMask (n) {
        openMask(n)
        this.addressForm = []
        if (n === 2) {
          this.addressForm = this.address
          this.title = '收货地址'
        }
      },
      closeMask,
      setPayNo (k) {
        this.payNo = k
        this.closeMask()
      },
      getAddress () {
        fetchApiData(this, 'showAddress', {token: this.token}, (res) => {
          this.addressData = res
          this.addressObject = this.addressData[0] || {}
        })
      },
      selectAddress (k) {
        if (this.isMobile) {
          this.$store.commit('SET_ADDRESS', {url: this.detail.id, num: this.number})
          this.$router.push({path: '/mobile/address?select'})
        } else {
          this.addressObject = this.addressData[k]
        }
      },
      goRecharge (url) {
        this.$store.commit('SET_URL', this.$route.path)
        this.$router.push({path: url})
      },
      pageInit () {
        if (this.token && this.number) {
          this.totalPrice = this.detail.one_amount_value * +this.number
          this.form[0].value2 = this.detail.one_amount_value
          this.form[0].value3 = +this.number
          if (this.addressObj.id) {
            this.addressObject = this.addressObj
          }
          this.getAddress()
          let data = {token: this.token, num: this.number, miner_id: this.detail.id}
          fetchApiData(this, 'buy_miner', data, (res) => {
            this.balance = +res.balance
            if (res.output) {
              this.detail.output = res.output
              this.detail.total_electric_fee = res.total_electric_fee
            }
            this.content = res.content
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
        trade_password: state => state.info.trade_password,
        addressObj: state => state.addressData
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
