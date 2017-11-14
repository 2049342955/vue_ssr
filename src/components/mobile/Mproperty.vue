<template>
  <section class="bdcform">
    <div class="property">
      <img src="../../assets/images/beaut.png" style="width:100%;position:absolute;"/>
      <div class="property_top">
        <div class="left">
          <h1>今日获得收益</h1>
           <p>{{computeData[computeNav.today_hash]|format(8)}} <i>{{hashType[nowEdit]&&hashType[nowEdit].name&&hashType[nowEdit].name.toLowerCase()}}</i></p> 
        </div>
        <select style="z-index:99;" :value="hashType[nowEdit]&&hashType[nowEdit].name">
          <option @click="setList(k)" v-for="n,k in hashType" style="color:black;">{{n.name}}资产</option>
        </select>
      </div>
      <div class="property_bottom">
        <div class="left" style="border-right:1px solid white;">
          <h1>累积获得收益</h1>
           <p>{{computeData[computeNav.balance_account]|format(8)}} <i>{{hashType[nowEdit]&&hashType[nowEdit].name&&hashType[nowEdit].name.toLowerCase()}}</i></p> 
        </div>
        <div class="left" style="padding-left:1rem;">
          <h1>账户余额</h1>
           <p>{{computeData[computeNav.total_hash]|format(8)}} <i>{{hashType[nowEdit]&&hashType[nowEdit].name&&hashType[nowEdit].name.toLowerCase()}}</i></p> 
        </div>
      </div>
    </div>
    <ul>
      <li>
        <span>购入云矿机</span>
        <i>10.000.00元</i>
      </li>
      <li>
        <span>出售中云矿机</span>
        <i>10.000.00元</i>
      </li>
      <li>
        <span>已出售云矿机</span>
        <i>80.00元</i>
      </li>
      <li>
        <span>算力总和</span>
        <i>10%</i>
      </li>
      <li>
        <span>提取收益</span>
      </li>
      <li style="border:0;">
        <span>算力收益图表</span>
      </li>
    </ul>
  </section>
</template>

<script>
  import util from '@/util'
  import api from '@/util/function'
  import { mapState } from 'vuex'
  import md5 from 'js-md5'
  export default {
    data () {
      return {
        nowEdit: 0,
        priceall: '',
        moneyNav: {freeze_account: '冻结资金', balance_account: '账户余额'},
        moneyData: {freeze_account: 0, balance_account: 0},
        computeNav: {today_hash: '今日收益', balance_account: '账户余额', total_hash: '累积已获得收益'},
        computeData: {today_hash: 0, balance_account: 0, total_hash: 0},
        computeProperty: {total_miner: ['已购入云矿机', '台'], total_hash: ['算力总和', 'T'], buy_transfer_hash: ['已租赁算力', 'T'], selled_miner: ['已出售云矿机', '台'], selling_miner: ['出售中云矿机', '台']},
        // , selled_hash: ['已出租云矿机', '台'], selling_hash: ['出租中云矿机', '台']
        dataProperty: {total_miner: 0, total_hash: 0, buy_transfer_hash: 0, selled_miner: 0, selling_miner: 0, selled_hash: 0, selling_hash: 0},
        computeFund: {total_miner: ['云矿机', '台'], total_hash: ['云算力总和', 'T'], selled_miner: ['已出租云算力', 'T'], selling_miner: ['出租中云算力', 'T']},
        dataFund: {total_miner: 0, total_hash: 0, selled_miner: 0, selling_miner: 0},
        edit: '',
        form: {
          Withdrawals: [{name: 'amount', type: 'text', title: '提现金额', placeholder: '请输入提现金额', changeEvent: true, pattern: 'money', len: 7, tipsInfo: '余额', tipsUnit: '元'}, {name: 'trade_password', type: 'password', title: '交易密码', placeholder: '请输入交易密码', pattern: 'telCode'}],
          GetIncome: [{name: 'product_hash_type', type: 'text', title: '算力类型', edit: 'hashType'}, {name: 'amount', type: 'text', title: '提取额度', placeholder: '请输入提取额度', changeEvent: true, pattern: 'coin', tipsInfo: '余额', tipsUnit: 'hash'}, {name: 'trade_password', type: 'password', title: '交易密码', placeholder: '请输入交易密码', pattern: 'telCode'}]
        },
        editText: '',
        fee: 0,
        total_price: 0,
        amount: 0,
        product_hash_type: ''
      }
    },
    methods: {
      openMask (str, title) {
        this.total_price = 0
        // if (!(this.true_name && this.true_name.status === 1)) {
        //   api.tips('请先实名认证', () => {
        //     this.$router.push({name: 'account'})
        //   })
        //   return false
        // }
        // if (!(this.bank_card && this.bank_card.status === 1)) {
        //   api.tips('请先绑定银行卡', () => {
        //     this.$router.push({name: 'account'})
        //   })
        //   return false
        // }
        // if (str === 'recharge') {
        //   this.$router.push({name: 'recharge'})
        // }
        // if (str === 'GetIncome' && !this.address.length) {
        //   api.tips('请先绑定算力地址', () => {
        //     this.$router.push({name: 'account'})
        //   })
        //   return false
        // }
        if (str === 'Withdrawals' && +this.moneyData.balance_account <= 0) {
          api.tips('您的账户余额不足，不能提现')
          return false
        } else if (str === 'GetIncome' && +this.computeData.balance_account <= 0) {
          api.tips('您的账户余额不足，不能提取收益')
          return false
        }
        var requestUrl = ''
        var data = {}
        if (str === 'Withdrawals') {
          requestUrl = 'showWithdraw'
          data = {token: this.token, user_id: this.user_id}
        } else if (str === 'GetIncome') {
          requestUrl = 'showWithdrawCoin'
          data = {token: this.token, user_id: this.user_id, product_hash_type: this.hashType[this.nowEdit] && this.hashType[this.nowEdit].id}
          this.product_hash_type = this.hashType[this.nowEdit].name.toUpperCase()
        }
        var self = this
        util.post(requestUrl, {sign: api.serialize(data)}).then(function (res) {
          api.checkAjax(self, res, () => {
            window.scroll(0, 0)
            document.body.style.overflow = 'hidden'
            self.editText = title
            self.edit = str
            if (str === 'Withdrawals') {
              self.fee = res.withdraw_fee
              self.amount = parseInt(res.balance_account)
            } else if (str === 'GetIncome') {
              self.fee = res.withdraw_coin_fee
              self.amount = res.coin_account
            }
          })
        })
      },
      closeEdit () {
        this.edit = ''
        document.body.style.overflow = 'auto'
      },
      setList (n) {
        alert(1)
        this.nowEdit = n
        this.getList()
      },
      getList () {
        var self = this
        console.log(this.user_id)
        var sendData = {token: this.token, user_id: this.user_id, product_hash_type: (this.hashType[this.nowEdit] && this.hashType[this.nowEdit].id) || '1'}
        util.post('myHashAccount', {sign: api.serialize(sendData)}).then(function (res) {
          api.checkAjax(self, res, () => {
            self.computeData = res
          })
        })
        util.post('hashAsset', {sign: api.serialize(sendData)}).then(function (res) {
          api.checkAjax(self, res, () => {
            self.dataProperty = res
          })
        })
        util.post('hashFund', {sign: api.serialize(sendData)}).then(function (res) {
          api.checkAjax(self, res, () => {
            self.dataFund = res
          })
        })
      },
      submit () {
        var form = document.querySelector('.form_content')
        var data = api.checkFrom(form)
        var url = ''
        var sendData = {token: this.token, user_id: this.user_id}
        var tipsStr = ''
        data.trade_password = md5(data.trade_password)
        switch (this.edit) {
          case 'Withdrawals':
            url = 'withdraw'
            tipsStr = '提现成功'
            break
          case 'GetIncome':
            url = 'withdrawCoin'
            tipsStr = '提币成功'
            break
        }
        if (!data) return false
        form.btn.setAttribute('disabled', true)
        var self = this
        util.post(url, {sign: api.serialize(Object.assign(data, sendData))}).then(function (res) {
          api.checkAjax(self, res, () => {
            self.closeEdit()
            api.tips(tipsStr)
          }, form.btn)
        })
      },
      onChange (e) {
        console.log(this.amount)
        if (parseFloat(e.target.value) > parseFloat(this.amount)) {
          e.target.value = this.amount
        }
        this.total_price = e.target.value
      }
    },
    mounted () {
      var self = this
      util.post('myAccount', {sign: api.serialize({token: this.token, user_id: this.user_id})}).then(function (res) {
        api.checkAjax(self, res, () => {
          self.moneyData = res
          self.priceall = (parseInt(self.moneyData.freeze_account) + parseInt(self.moneyData.balance_account))
        })
      })
      this.getList()
    },
    filters: {
      currency: api.currency,
      format: api.decimal
    },
    computed: {
      ...mapState({
        token: state => state.info.token,
        user_id: state => state.info.user_id,
        true_name: state => state.info.true_name,
        bank_card: state => state.info.bank_card,
        address: state => state.info.address,
        hashType: state => state.hashType,
        scode: state => state.info.scode
      })
    }
  }
</script>

<style scoped lang="scss">
.bdcform{
  background:#f5f5f9;
}
.mobile_header{
  margin-bottom: 0;
}
  select{
    color: white;
    width: 4rem;
    font-size: 0.7rem;
  }
  .property{
    width: 100%;
    overflow: hidden;
    background:white;
    background: #327fff;
    padding-bottom: 0.8rem;
    .property_top{
      width: 100%;
      display: flex;
      padding:0 .5rem;
      box-sizing: border-box;
      justify-content: space-between;
      padding-top: 0.5rem;
      color: white;
      .left p{
         margin-top: 0.15rem;
         font-size: 0.7rem;
      }
      .left i{
        font-weight: 100;
        font-size: 0.5rem;
      }
      .right{
        width: 3.3rem;
        height: 1rem;
        line-height: 0.9rem;
        text-align: center;
        border-radius: 1rem;
        border:1px solid white;
        margin-top: 0.6rem;
      }
    }
    .property_bottom{
      width: 100%;
      display: flex;
      padding:0 .5rem;
      box-sizing: border-box;
      justify-content: space-between;
      padding-top: 0.5rem;
      color: white;
      margin-top: 0.8rem;
      .left{
        width: 50%;
      }
      .left p{
         margin-top: 0.15rem;
         font-size: 0.7rem;
      }
      .left i{
        font-weight: 100;
        font-size: 0.5rem;
      }
    }
  }
  ul{
      width: 100%;
      margin-top: 0.5rem;
      overflow: hidden;
      background:white;
      padding:0 .5rem;
      box-sizing: border-box;
      li{
        width: 100%;
        display: flex;
        justify-content: space-between;
        height:2rem;
        border-bottom:1px solid #ddd;
        line-height: 2rem;
        span{
          color: #121212;
          font-size: 0.6rem;
        }
        i{
          color: #999999;
        }
      }
  }
</style>