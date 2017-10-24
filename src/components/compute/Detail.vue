<template>
  <section class="compute_detail">
    <div class="main">
      <Pay v-if="next" page="cloudCompute" :proData="proData2" :proText="proText2"></Pay>
      <Product v-else page="cloudCompute" :proData="proData" :proText="proText"></Product>
    </div>
    <div class="web_tips" ref="tips"></div>
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
        detail: {imgurl: require('@/assets/images/detail_img.jpg'), income: 0.12441251, electricityFees: 0.12441251, buyType: '预售', incomeType: '每日结算，次日发放', machine_intro: '*  BTC挖矿阿瓦隆001号算力矿机来源嘉楠耘智A741矿机', buyed_amount: 5, machine_advantage: '一次购买，全程无忧挖矿，购买后立即享受收益<br>算力网提供专业挖矿配件以及后续收益派发服务<br>正规矿场运营，国家电力保证矿机7*24小时正常运行<br>算力网提供专业技术维护，保证您矿机超长时间挖矿<br>用户可收回矿机残值，保证投资收益<br>用户可对矿机所有权进行转让', machine_agreement: '算力宝A7 云挖矿合约产品将A7矿机算力拆分成T，以按T销售的模式运作，以提升产品整体的灵活性。<br>以下是无忧挖矿六号的合约介绍：<br>售 价：        每份合约原价968RMB，其中包含的硬件费用包含矿机设备和矿机配件两部份。现算力宝平台补贴用户100RMB/T，售价868.00RMB/T。<br>算力单位：   每份合约代表A7矿机1T的算力。<br>电 费：        每份合约功耗为170W，电费为0.40CNY/KWH,其中矿机功耗为150W，电源功耗为20W，合计为170W，每天总电费为1.632CNY。<br>算力收益：   合约合作矿池为1hash，1hash选用PPS收益模式，矿池收益当日结算，次日发放。算力收益=挖矿收益-电费。电费按次日16:00的比特币价格从前一天的比特币收益中抵扣。<br>停电维护：   每月1号为矿场停电维护时间，当天比特币收益为0，同时也不需交电费。（2017年4月起，停电维护时间改为每月10号）<br>停止挖矿：   如果连续10天挖矿收入小于电费，合约终止', minerImg: [require('@/assets/images/miner1.jpg'), require('@/assets/images/miner2.jpg')]},
        proData: {one_amount_value: {title: '每台服务器价格', unit: '元'}, hash: {title: '每台服务器算力', unit: 'T'}, amount: {title: '服务器总台数', unit: '台'}},
        proText: {hashType: '算力类型', buyType: '购买类型', incomeType: '结算方式'},
        proData2: {name: {title: '矿机名称', unit: ''}, one_amount_value: {title: '每台服务器价格', unit: '元'}, number: {title: '购买服务器数量', unit: '台'}, income: {title: '今日每T预期收益', unit: 'btc'}, electricityFees: {title: '每日电费约', unit: 'btc'}},
        proText2: {hashType: '算力类型', hash: '每台矿机算力', buyType: '购买类型', incomeType: '结算方式'},
        totalPrice: 0,
        totalHash: 0,
        number: '',
        initNum: 0,
        leftNum: 0,
        balance: 0,
        leftStatus: false,
        overStatus: false,
        content: ''
      }
    },
    methods: {
      goPay (e) {
        if (!this.trade_password) {
          api.tips(this.$refs.tips, '请先设置交易密码', () => {
            this.$router.push({name: 'password'})
          })
          return false
        }
        if (this.number < 1) {
          e.target.classList.add('error')
          setTimeout(() => {
            e.target.classList.remove('error')
          }, 2000)
          return false
        }
        var self = this
        // 100002:参数缺失，200009：不能购买自己发布的订单
        util.post('productOrder', {sign: api.serialize({token: this.token, product_id: this.$route.params.id, num: this.number})}).then(function (res) {
          api.checkAjax(self, res, () => {
            self.next = true
            self.balance = res.balance
            self.content = res.content
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
