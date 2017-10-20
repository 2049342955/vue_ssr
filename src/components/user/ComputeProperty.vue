<template>
  <section class="compute_property">
    <h2>个人中心</h2>
    <h3>资金账户</h3>
    <div class="compute_box money_box">
      <div class="data">
        <div class="item">
          <p>总资金</p>
          <span class="currency">{{(+moneyData.freeze_account+moneyData.balance_account)|currency}}</span>
          <span class="">元</span>
        </div>
        <div class="line"></div>
        <template v-for="d,k in moneyNav">
          <div class="item">
            <p>{{d}}</p>
            <span class="currency">{{moneyData[k]|currency}}</span>
            <span class="">元</span>
          </div>
          <div class="line"></div>
        </template>
      </div>
      <div class="btn">
        <button @click="openMask('recharge')">充值</button>
        <button @click="openMask('Withdrawals', '资金提现')">提现</button>
      </div>
    </div>
    <div class="compute_title">
      <span class="text_title">算力账户</span>
      <div class="title_content">
        <span class="title_now" @click="openList">{{hashType[nowEdit]&&hashType[nowEdit].name}}</span>
        <div class="title_list" v-if="show">
          <a href="javascript:;" @click="setList(n.id)" v-for="n,k in hashType">{{n.name}}</a>
        </div>
      </div>
    </div>
    <div class="compute_box compute_account">
      <div class="data">
        <template v-for="d,k in computeNav">
          <div class="item">
            <p>{{d}}</p>
            <span class="currency">{{computeData[k]|format(8)}}</span>
            <span class="">{{hashType[nowEdit]&&hashType[nowEdit].name.toLowerCase()}}</span>
          </div>
          <div class="line"></div>
        </template>
      </div>
      <div class="btn">
        <router-link to="/user/incomeChart">收益图表</router-link>
        <button @click="openMask('GetIncome', '提取收益')">提取收益</button>
      </div>
    </div>
    <h3>算力资产</h3>
    <div class="detail_table">
      <div class="item" v-for="d,k in computeProperty">
        <div class="item_title">{{d[0]}}</div>
        <div class="item_value" v-if="k==='total_hash'">{{dataProperty[k]|format}}{{d[1]}}</div>
        <div class="item_value" v-else>{{dataProperty[k]}}{{d[1]}}</div>
      </div>
      <div class="item" v-if="7%2">
        <div class="item_title"></div>
        <div class="item_value"></div>
      </div>
    </div>
    <template v-if="scode">
      <h4>算力产业基金</h4>
      <div class="detail_table fund_table">
        <div class="item" v-for="d,k in computeFund">
          <div class="item_title">{{d[0]}}</div>
          <div class="item_value">{{dataFund[k]}}{{d[1]}}</div>
        </div>
        <div class="item" v-if="4%2">
          <div class="item_title"></div>
          <div class="item_value"></div>
        </div>
      </div>
    </template>
    <div class="fund_btn">
      <router-link to="/user/order/0/1">出售云矿机</router-link>
      <router-link to="/user/order/1/1">出租算力</router-link>
      <router-link to="/user/order/0/1">查看订单</router-link>
    </div>
    <MyMask :form="form[edit]" :title="editText" v-if="edit"></MyMask>
    <div class="web_tips" ref="tips"></div>
  </section>
</template>

<script>
  import util from '@/util'
  import api from '@/util/function'
  import { mapState } from 'vuex'
  import MyMask from '@/components/common/Mask'
  import md5 from 'js-md5'
  export default {
    components: {
      MyMask
    },
    data () {
      return {
        title: ['BTC', 'ETH', 'LTC'],
        nowEdit: 0,
        moneyNav: {freeze_account: '冻结资金', balance_account: '账户余额'},
        moneyData: {freeze_account: 0, balance_account: 0},
        computeNav: {today_hash: '今日收益', balance_account: '账户余额', total_hash: '累积已获得收益'},
        computeData: {today_hash: 0, balance_account: 0, total_hash: 0},
        computeProperty: {total_miner: ['已购入矿机', '台'], total_hash: ['算力总和', 'T'], buy_transfer_hash: ['已租赁算力', 'T'], selled_miner: ['已出售矿机', '台'], selling_miner: ['出售中云矿机', '台'], selled_hash: ['已出租云矿机', '台'], selling_hash: ['出租中云矿机', '台']},
        dataProperty: {total_miner: 0, total_hash: 0, buy_transfer_hash: 0, selled_miner: 0, selling_miner: 0, selled_hash: 0, selling_hash: 0},
        computeFund: {total_miner: ['云矿机', '台'], total_hash: ['云算力总和', 'T'], selled_miner: ['已出租云矿机', '台'], selling_miner: ['出租中云矿机', '台']},
        dataFund: {total_miner: 0, total_hash: 0, selled_miner: 0, selling_miner: 0},
        edit: '',
        form: {
          Withdrawals: [{name: 'amount', type: 'text', title: '提现金额', placeholder: '请输入提现金额', changeEvent: true}, {name: 'trade_password', type: 'password', title: '交易密码', placeholder: '请输入交易密码'}],
          GetIncome: [{name: 'product_hash_type', type: 'select', title: '算力类型', option: ['BTC', 'BCC', 'ETC']}, {name: 'amount', type: 'text', title: '提取额度', placeholder: '请输入提取额度', changeEvent: true}, {name: 'trade_password', type: 'password', title: '交易密码', placeholder: '请输入交易密码'}]
        },
        editText: '',
        show: false,
        fee: 0,
        total_price: 0
      }
    },
    methods: {
      openMask (str, title) {
        if ((str === 'Withdrawals' || str === 'recharge') && !this.bank_card) {
          api.tips(this.$refs.tips, '请先绑定银行卡', () => {
            this.$router.push({name: 'account'})
          })
          return false
        }
        if (str === 'recharge') {
          this.$router.push({name: 'recharge'})
        }
        if (str === 'GetIncome' && !this.address.length) {
          api.tips(this.$refs.tips, '请先绑定算力地址', () => {
            this.$router.push({name: 'account'})
          })
          return false
        }
        window.scroll(0, 0)
        document.body.style.overflow = 'hidden'
        this.editText = title
        this.edit = str
        var requestUrl = ''
        if (str === 'Withdrawals') {
          requestUrl = 'showWithdraw'
        } else if (str === 'GetIncome') {
          requestUrl = 'showWithdrawCoin'
        }
        var self = this
        util.post(requestUrl, {sign: api.serialize({token: this.token, user_id: this.user_id})}).then(function (res) {
          console.log(res)
          if (str === 'Withdrawals') {
            self.fee = res.withdraw_fee
          } else if (str === 'GetIncome') {
            self.fee = res.withdraw_coin_fee
          }
        })
      },
      closeEdit () {
        this.edit = ''
        document.body.style.overflow = 'auto'
      },
      openList () {
        this.show = !this.show
      },
      setList (n) {
        this.show = !this.show
        this.nowEdit = n
        this.getList()
      },
      getList () {
        var self = this
        var sendData = {token: this.token, user_id: this.user_id, product_hash_type: this.nowEdit + 1}
        util.post('myHashAccount', {sign: api.serialize(sendData)}).then(function (res) {
          console.log(res)
          self.computeData = res
        })
        util.post('hashAsset', {sign: api.serialize(sendData)}).then(function (res) {
          console.log(res)
          self.dataProperty = res
        })
        util.post('hashFund', {sign: api.serialize(sendData)}).then(function (res) {
          console.log(res)
          self.dataFund = res
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
        util.post(url, {sign: api.serialize(Object.assign(data, sendData))}).then(function (back) {
          console.log(back)
          if (back.code) {
            api.tips(self.$refs.tips, back.msg, () => {
              form.btn.removeAttribute('disabled')
            })
          } else {
            self.closeEdit()
            api.tips(self.$refs.tips, tipsStr, () => {
              self.$router.push({path: '/user/order/1/1'})
            })
          }
        })
      },
      onChange (e) {
        this.total_price = e.target.value
      }
    },
    mounted () {
      var self = this
      util.post('myAccount', {sign: api.serialize({token: this.token, user_id: this.user_id})}).then(function (res) {
        console.log(res)
        self.moneyData = res
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
        bank_card: state => state.info.bank_card,
        address: state => state.info.address,
        hashType: state => state.hashType,
        scode: state => state.info.scode
      })
    }
  }
</script>

<style type="text/css" lang="scss">
  @import '../../assets/css/style.scss';
  .compute_property{
    padding:0 15px;
    h2{
      padding:0 15px !important;
    }
    .compute_box{
      @include gap(25,v)
      @include flex
      margin-bottom:10px;
      .data{
        flex:1;
        @include detail_data
      }
      .btn{
        @include detail_btn
        @include gap(25,h)
        a{
          @include button($orange)
        }
      }
      &.money_box{
        .data{
          .item:nth-child(5){
            span.currency{
              color:$orange
            }
          }
          .item:nth-child(3){
            span.currency{
              color:$light_black
            }
          }
        }
        .btn{
          button{
            &:first-child{
              @include button($orange)
            }
            &:not(:first-child){
              @include button($blue)
            }
          }
        }
      }
      &.compute_account{
        .btn{
          button,a{
            @include button(#c2d9ff,bg,$blue)
          }
        }
      }
    }
    .compute_title{
      background: #f7f8fa;
      padding:15px;
      @include select_list
      .text_title{
        font-size: 16px;
        &:before{
          content: '|';
          padding-right: 10px;
          color: #000;
          font-weight: bold;
        }
      }
    }
    h4{
      margin:0 15px;
      text-align: center;
      font-size: 16px;
      @include button($blue)
      line-height: 2.1;
    }
    .detail_table{
      @include detail
      &.fund_table{
        margin-top:3px
      }
    }
    .fund_btn{
      text-align: right;
      padding:0 15px 30px 15px;
      a{
        display: inline-block;
        text-align: center;
        width:85px;
        border-radius:5px;
        line-height: 2;
        &:not(:last-child){
          @include button($blue)
        }
        &:last-child{
          @include button($blue,border)
        }
        & + a{
          margin-left:13px
        }
      }
    }
  }
</style>
