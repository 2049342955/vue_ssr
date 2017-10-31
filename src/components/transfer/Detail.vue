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
        detail: {product_img: '', buyType: '转让', total_price: 0, transfer_amount: 0, incomeType: '每日结算，次日发放', machine_advantage: '', machine_agreement: '', machine_intro: '', product_photos: [], status: 0},
        proData: {product_name: {title: '矿机名称', unit: ''}, transfer_price: {title: '每T算力价格', unit: '元'}, transfer_amount: {title: '算力总量', unit: 'T'}, transfer_time: {title: '转让时长', unit: '天'}},
        proText: {hashType: '算力类型', buyType: '购买类型', incomeType: '结算方式'},
        balance: 0,
        content: ''
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
          api.checkAjax(self, res, () => {
            self.next = true
            self.balance = res.balance_account
            self.content = res.has_contract_tpl.content
          })
        })
      }
    },
    mounted () {
      var self = this
      util.post('getHashrate_details', {sign: api.serialize({token: this.token, transfer_order_id: this.$route.params.id})}).then(function (res) {
        api.checkAjax(self, res, () => {
          self.detail = Object.assign(self.detail, res)
          self.detail = Object.assign(self.detail, res.has_product_hash.has_product_miner_base)
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
  .transfer_detail{
    padding-top: 30px;
    padding-bottom: 110px;
    background: #f7f8fa;
    .main{
      @include main
    }
  }
</style>
