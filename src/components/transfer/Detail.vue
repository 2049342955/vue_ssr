<template>
  <section class="transfer_detail">
    <div class="main">
      <Pay v-if="next" page="computeTransfer" :proData="proData" :proText="proText"></Pay>
      <Product v-else page="computeTransfer" :proData="proData" :proText="proText"></Product>
    </div>
    <div class="web_tips" ref="tips"></div>
  </section>
</template>

<script>
  import util from '@/util'
  import api from '@/util/function'
  import { mapState } from 'vuex'
  import Pay from '../common/Pay'
  import Product from '../common/Product'
  export default {
    components: {
      Pay, Product
    },
    data () {
      return {
        next: false,
        detail: {address: '1号楼A区', imgurl: require('@/assets/images/detail_img.jpg'), buyType: '转让', total_price: 0, transfer_amount: 0, incomeType: '每日结算，次日发放', machine_advantage: '一次购买，全程无忧挖矿，购买后立即享受收益<br>算力网提供专业挖矿配件以及后续收益派发服务<br>正规矿场运营，国家电力保证矿机7*24小时正常运行<br>算力网提供专业技术维护，保证您矿机超长时间挖矿<br>用户可收回矿机残值，保证投资收益<br>用户可对矿机所有权进行转让', machine_agreement: '算力宝A7 云挖矿合约产品将A7矿机算力拆分成T，以按T销售的模式运作，以提升产品整体的灵活性。<br>以下是无忧挖矿六号的合约介绍：<br>以下是无忧挖矿六号的合约介绍：<br>售 价：        每份合约原价968RMB，其中包含的硬件费用包含矿机设备和矿机配件两部份。现算力宝平台补贴用户100RMB/T，售价868.00RMB/T。<br>算力单位：   每份合约代表A7矿机1T的算力。<br>电 费：        每份合约功耗为170W，电费为0.40CNY/KWH,其中矿机功耗为150W，电源功耗为20W，合计为170W，每天总电费为1.632CNY。<br>算力收益：   合约合作矿池为1hash，1hash选用PPS收益模式，矿池收益当日结算，次日发放。算力收益=挖矿收益-电费。电费按次日16:00的比特币价格从前一天的比特币收益中抵扣。<br>停电维护：   每月1号为矿场停电维护时间，当天比特币收益为0，同时也不需交电费。（2017年4月起，停电维护时间改为每月10号）<br>', machine_intro: '*  BTC挖矿阿瓦隆001号算力矿机来源嘉楠耘智A741矿机', minerImg: [require('@/assets/images/miner1.jpg'), require('@/assets/images/miner2.jpg')], transfer: 0},
        proData: {product_name: {title: '矿机名称', unit: ''}, transfer_price: {title: '每T算力价格', unit: '元'}, transfer_amount: {title: '算力总量', unit: 'T'}, transfer_time: {title: '转让时长', unit: '天'}},
        proText: {hashType: '算力类型', buyType: '购买类型', incomeType: '结算方式'},
        balance: 0
      }
    },
    methods: {
      goPay () {
        if (!this.trade_password) {
          api.tips(this.$refs.tips, '请先设置交易密码', () => {
            this.$router.push({name: 'password'})
          })
          return false
        }
        var self = this
        console.log(this.user_id)
        util.post('doTransfer_Hashrate_show', {sign: api.serialize({token: this.token, user_id: this.user_id, transfer_order_id: this.$route.params.id})}).then(function (res) {
          console.log(res)
          if (!res.code) {
            self.next = true
            self.balance = res.balance_account
          } else {
            api.tips(self.$refs.tips, res.msg)
          }
        })
      }
    },
    mounted () {
      var self = this
      util.post('getHashrate_details', {sign: api.serialize({token: this.token, transfer_order_id: this.$route.params.id})}).then(function (res) {
        self.detail = Object.assign(self.detail, res)
        self.detail = Object.assign(self.detail, res.has_product_hash.has_product_miner_base)
        self.detail.hashType = res.hashtype.name
        self.detail.transfer = res.status
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
  .transfer_detail{
    padding-top: 30px;
    padding-bottom: 110px;
    background: #f7f8fa;
    .main{
      @include main
    }
  }
</style>
