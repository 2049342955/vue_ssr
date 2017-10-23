<template>
  <section class="lp_center">
    <template v-if="scode&&!showAgreement">
      <h2>LP中心<button @click="open">添加基金</button></h2>
      <template v-if="scode.fund_invest_id">
        <h3>{{scode.fund_invest_id===1?'电厂基金':'矿场基金'}}</h3>
        <div class="detail_table">
          <div class="item" v-for="d,k in nav[scode.fund_invest_id-1]">
            <div class="item_title">{{d}}</div>
            <div class="item_value">
              <template v-if="k==='start_end_time'">{{scode.fund_start_time}}-{{scode.fund_end_time}}</template>
              <!-- <template v-else-if="scode.fund_invest_id===1&&d==='累积电费'">{{scode[k]}}<span>查看明细</span></template>
              <template v-else-if="scode.fund_invest_id===2&&d==='累计获得收益'">{{scode[k]}}<span>查看明细</span></template> -->
              <template v-else>{{scode[k]}}</template>
            </div>
          </div>
          <div class="item" v-if="Object.keys(nav[scode.fund_invest_id-1]).length%2">
            <div class="item_title"></div>
            <div class="item_value"></div>
          </div>
        </div>
      </template>
    </template>
    <div v-else-if="showAgreement" class="agreement_text">
      <div class="" v-html="content"></div>
      <div class="btn_box">
        <button @click="agree">我同意</button>
      </div>
    </div>
    <div class="no_scode" v-else>
      <div class="no_scode_box">
        <div class="input">
          <span>验证s码</span>
          <span>*</span>
          <input ref="scode" type="text" name="scode" autocomplete="off" placeholder="请输入S码" @blur="test" pattern="^[0-9a-zA-Z]{6}$" data-status="" maxlength="6">
          <span title="请输入6位字符串" tips="请输入S码"></span>
        </div>
        <button @click="check">提交</button>
      </div>
    </div>
    <div class="mask" v-if="edit">
      <div class="form_box">
        <div class="close" @click="closeEdit()">
          <span class="icon"></span>
          <span>关闭</span>
        </div>
        <h2>验证S码</h2>
        <form class="form_content" @submit.prevent="submit" novalidate>
          <p>请输入S码绑定算力产业基金</p>
          <!-- <p>算力基金已经结束，请重新输入S码绑定其他基金</p> -->
          <div class="input">
            <span>S码</span>
            <span>*</span>
            <input type="text" name="scode" autocomplete="off" placeholder="请输入S码" @blur="test" pattern="^[0-9a-zA-Z]{6}$" data-status="" maxlength="6">
            <span title="请输入6位字符串" tips="请输入S码"></span>
          </div>
          <button>确认提交</button>
        </form>
      </div>
    </div>
    <div class="web_tips" ref="tips"></div>
  </section>
</template>

<script>
  import api from '@/util/function'
  import util from '@/util'
  import { mapState } from 'vuex'
  export default {
    data () {
      return {
        data: {},
        nav: [{fund_name: '基金名称', fund_manager: '基金管理人', invest_money: '投资金额', start_end_time: '投资时间', fund_time: '投资期限', electric_amount: '累计用电力量', electric_total_price: '累积电费'}, {fund_name: '基金名称', fund_manager: '基金管理人', invest_money: '投资金额', start_end_time: '投资时间', fund_time: '投资期限', miner_num: '云矿机', miner_hash: '运算力', hash_income: '累计获得收益'}],
        edit: false,
        showAgreement: false,
        content: '',
        contract: {}
      }
    },
    methods: {
      submit () {
        var form = document.querySelector('.form_content')
        var data = api.checkFrom(form)
        var self = this
        if (!data) return false
        util.post('ScodeVerify', {sign: api.serialize({token: this.token, user_id: this.user_id, s_code: form.scode.value})}).then(function (data) {
          if (!data.code) {
            self.edit = false
            document.body.style.overflow = 'auto'
            util.post('scode_info', {sign: 'token=' + self.token}).then(function (res) {
              console.log(res)
              self.$store.commit('SET_INFO', {scode: res})
            })
          } else {
            api.tips(self.$refs.tips, data.msg)
          }
        })
      },
      open () {
        this.edit = true
        window.scroll(0, 0)
        document.body.style.overflow = 'hidden'
      },
      closeEdit () {
        this.edit = false
        document.body.style.overflow = 'auto'
      },
      test (e) {
        var ele = e.target
        if (!ele.checkValidity()) {
          api.setTips(ele, 'invalid')
        } else {
          api.setTips(ele, 'valid')
          return true
        }
      },
      check (e) {
        var ele = this.$refs.scode
        if (!ele.value) {
          api.setTips(ele, 'null')
          return false
        }
        if (!(this.true_name && this.true_name.status === 1)) {
          api.tips(this.$refs.tips, '请先实名认证', () => {
            this.$router.push({name: 'account'})
          })
          return false
        }
        if (this.risk.user_risk_score < 0) {
          api.tips(this.$refs.tips, '请先进行风险测评', () => {
            this.$router.push({name: 'account'})
          })
          return false
        }
        var self = this
        var sCodeData = {token: this.token, user_id: this.user_id, s_code: ele.value}
        console.log(sCodeData)
        util.post('ScodeVerify', {sign: api.serialize(sCodeData)}).then(function (data) {
          if (!data.code) {
            console.log(data)
            self.$store.commit('SET_INFO', {scode: true})
            self.showAgreement = true
            self.content = data.content
            self.contract = {contract_id: data.id, funds_id: data.funds_id, s_code: data.s_code}
          } else {
            api.tips(self.$refs.tips, data.msg)
          }
        })
      },
      agree () {
        var self = this
        util.post('sign_contract', {sign: api.serialize(Object.assign({token: this.token, user_id: this.user_id}, self.contract))}).then(function (res) {
          console.log(res)
          self.showAgreement = false
          self.nav = res.fund_invest_id === 1 ? self.electric : self.miner
          self.$store.commit('SET_INFO', {scode: res})
        })
      }
    },
    computed: {
      ...mapState({
        token: state => state.info.token,
        user_id: state => state.info.user_id,
        true_name: state => state.info.true_name,
        risk: state => state.info.risk,
        scode: state => state.info.scode
      })
    }
  }
</script>

<style type="text/css" lang="scss">
  @import '../../assets/css/style.scss';
  .lp_center{
    padding:0 15px;
    h2{
      padding:0 15px !important;
      button{
        float: right;
        @include button($blue)
        padding:5px 15px;
        margin-top:10px;
      }
    }
    .detail_table{
      @include detail
    }
    .mask{
      @include mask
      .form_box{
        h2{
          padding: 10px 25px;
          border-bottom: 1px solid #e8e8e8;
          margin-bottom:0
        }
        .form_content{
          padding:20px 100px;
          @include form(v)
          p{
            margin-bottom:15px
          }
        }
      }
    }
    .no_scode{
      @include flex(center)
      height:100%;
      .no_scode_box{
        width:300px;
        .input{
          @include input
        }
        button{
          width:100%;
          line-height: 3;
          @include button($blue)
        }
      }
    }
    .agreement_text{
      padding:15px;
      .btn_box{
        text-align: center;
        button{
          line-height: 2;
          width:100px;
          margin:30px auto;
          @include button($blue)
        }
      }
    }
  }
</style>
