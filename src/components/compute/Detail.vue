<template>
  <section class="compute_detail">
    <div class="main">
      <Pay v-if="next" page="cloudCompute" :proData="proData2" :proText="proText2" :proData3="proData3" :proText3="proText3"></Pay>
      <Product v-else page="cloudCompute" :proData="proData" :proText="proText"></Product>
    </div>
  </section>
</template>

<script>
  import util from '@/util'
  import api from '@/util/function'
  import Pay from '../common/Pay'
  import Product from '../common/Product'
  import { mapState } from 'vuex'
  export default {
    components: {
      Pay, Product
    },
    data () {
      return {
        next: false,
        detail: {incomeType: '每日结算，次日发放', fee: ''},
        proData: {one_amount_value: {title: '每台服务器价格', unit: '元'}, hash: {title: '每台服务器算力', unit: 'T'}, amount: {title: '服务器总台数', unit: '台'}},
        proText: {hashType: '算力类型', status: '购买类型', incomeType: '结算方式'},
        proData2: {name: {title: '矿机名称', unit: ''}, one_amount_value: {title: '每台服务器价格', unit: '元'}, number: {title: '购买服务器数量', unit: '台'}, income: {title: '今日每T预期收益', unit: 'btc'}, electricityFees: {title: '运维费约', unit: 'btc'}},
        proText2: {hashType: '算力类型', hash: '每台矿机算力', status: '购买类型', incomeType: '结算方式'},
        proData3: {one_amount: {title: '分期金额', unit: '元'}, fee: {title: '手续费率', unit: '%'}, payment: {title: '还款来源', unit: '算力收益/资金余额'}},
        proText3: {hashfee: '手续费'},
        items: {month_money: {title: '月还款', unit: '元'}, rate: {title: '分期期数', unit: '期'}, fee_money: {title: '手续费', unit: '元'}, total_money: {title: '费用总计', unit: '元'}},
        table: [],
        totalPrice: 0,
        totalHash: 0,
        number: '',
        initNum: 0,
        leftNum: 0,
        balance: 0,
        leftStatus: false,
        overStatus: false,
        content: '',
        content1: '',
        str: {4: '预热', 5: '可售'},
        show: '',
        rateshow: '',
        sort: ['24', '36'],
        month: ['6', '3'],
        rate: 6
      }
    },
    methods: {
      goPay (e, show) {
        this.show = show
        if (!this.trade_password) {
          api.tips('请先设置交易密码', () => {
            this.$router.push({name: 'password'})
          })
          return false
        }
        if (this.number < 1) {
          e.target.className = 'btn error'
          setTimeout(() => {
            e.target.className = 'btn'
          }, 2000)
          return false
        }
        if (this.detail.status === 4) {
          api.tips('暂不能购买')
          return false
        }
        this.det(this.rate)
        var self = this
        util.post('productOrder', {sign: api.serialize({token: this.token, product_id: this.$route.params.id, num: this.number})}).then(function (res) {
          api.checkAjax(self, res, () => {
            self.next = true
            self.balance = res.balance
            self.content = res.content
            self.content1 = res.content1
          })
        })
      },
      changeNum (n) {
        if (this.leftStatus) return false
        this.number = n < 1 || isNaN(+n) || typeof +n !== 'number' ? 1 : n > this.initNum ? this.initNum : n
        this.number = parseInt(this.number)
        if (n > this.initNum) {
          this.overStatus = true
          setTimeout(() => {
            this.overStatus = false
          }, 2000)
        }
        this.totalPrice = this.detail.one_amount_value * this.number
        this.totalHash = this.detail.hash * this.number
        var leftAmount = this.initNum - this.number
        this.leftNum = leftAmount < 0 ? 0 : leftAmount
      },
      det (rate) {
        var self = this
        util.post('getRate', {sign: api.serialize({token: this.token, rate_name: rate})}).then(function (res) {
          api.checkAjax(self, res, () => {
            self.detail.one_amount = self.detail.one_amount_value * self.number / 2
            self.detail.fee = res.fee * 100
            self.detail.hashfee = self.detail.one_amount * res.fee
          })
        })
        var loanAmount = this.detail.one_amount_value * this.number / 2
        console.log(this.detail.one_amount_value)
        util.post('getLoanDetail', {sign: api.serialize({token: this.token, rate_name: rate, loan_money: loanAmount})}).then(function (res) {
          api.checkAjax(self, res, () => {
            self.detail.month_money = res.month_money
            self.detail.fee_money = res.fee_money
            self.detail.rate = res.rate
            self.detail.total_money = res.total_money
            self.table = res.list
          })
        })
      },
      onChange (e) {
        this.rate = this.month[e.target.value]
        this.det(this.rate)
        this.detail.fee = this.sort[e.target.value]
      }
    },
    mounted () {
      var self = this
      util.post('productDetail', {sign: api.serialize({token: this.token, product_id: this.$route.params.id})}).then(function (res) {
        api.checkAjax(self, res, () => {
          self.initNum = res.amount - res.buyed_amount
          self.leftNum = self.initNum
          self.leftStatus = self.leftNum === 0
          self.detail = Object.assign(self.detail, res)
          self.detail = Object.assign(self.detail, res.has_product_miner_base)
          self.detail.hashType = res.hashtype.name
        })
      })
    },
    computed: {
      ...mapState({
        token: state => state.info.token,
        user_id: state => state.info.user_id,
        trade_password: state => state.info.trade_password
      })
    }
  }
</script>

<style type="text/css" lang="scss">
  @import '../../assets/css/style.scss';
  .compute_detail{
    padding-top: 30px;
    padding-bottom: 110px;
    background: #f7f8fa;
    .main{
      @include main
    }
  }
</style>
