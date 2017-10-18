<template>
  <section class="lp_center">
    <h2>LP中心<button @click="open">添加基金</button></h2>
    <template v-if="data.fund_invest_id">
      <h3>{{data.fund_invest_id===1?'电厂基金':'矿场基金'}}</h3>
      <div class="detail_table">
        <div class="item" v-for="d,k in nav">
          <div class="item_title">{{d}}</div>
          <div class="item_value">
            <template v-if="k==='start_end_time'">{{data.fund_start_time}}-{{data.fund_end_time}}</template>
            <!-- <template v-else-if="data.fund_invest_id===1&&d==='累积电费'">{{data[k]}}<span>查看明细</span></template>
            <template v-else-if="data.fund_invest_id===2&&d==='累计获得收益'">{{data[k]}}<span>查看明细</span></template> -->
            <template v-else>{{data[k]}}</template>
          </div>
        </div>
        <div class="item" v-if="Object.keys(nav).length%2">
          <div class="item_title"></div>
          <div class="item_value"></div>
        </div>
      </div>
    </template>
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
        electric: {fund_name: '基金名称', fund_manager: '基金管理人', invest_money: '投资金额', start_end_time: '投资时间', fund_time: '投资期限', electric_amount: '累计用电力量', electric_total_price: '累积电费'},
        miner: {fund_name: '基金名称', fund_manager: '基金管理人', invest_money: '投资金额', start_end_time: '投资时间', fund_time: '投资期限', miner_num: '云矿机', miner_hash: '运算力', hash_income: '累计获得收益'},
        data: {},
        nav: {},
        edit: false
      }
    },
    methods: {
      submit () {
        var form = document.querySelector('.form_content')
        var data = api.checkFrom(form)
        var self = this
        if (!data) return false
        util.post('ScodeVerify', {sign: api.serialize({token: this.token, user_id: this.user_id, scode: form.scode.value})}).then(function (data) {
          if (!data.code) {
            self.edit = false
            document.body.style.overflow = 'auto'
            util.post('scode_info', {sign: 'token=' + self.token}).then(function (res) {
              console.log(res)
              self.nav = res.fund_invest_id === 1 ? self.electric : self.miner
              self.data = res
            })
          } else {
            api.tips(this.$refs.tips, data.msg)
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
        api.checkFiled(e.target)
      }
    },
    computed: {
      ...mapState({
        token: state => state.info.token,
        user_id: state => state.info.user_id,
        true_name: state => state.info.true_name,
        risk: state => state.info.risk
      })
    },
    mounted () {
      setTimeout(() => {
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
        util.post('scode_info', {sign: 'token=' + this.token}).then(function (data) {
          if (data.code) {
            self.edit = true
            document.body.style.overflow = 'hidden'
          } else {
            self.nav = data.fund_invest_id === 1 ? self.electric : self.miner
            self.data = data
          }
        })
      }, 500)
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
  }
</style>
