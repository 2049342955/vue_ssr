<template>
  <div class="setting">
    <div :class="['item', {fail: !n.status}, {success: n.status}]" v-for="n,k in nav">
      <div class="icon"></div>
      <div class="con_title">{{n.title}}</div>
      <div class="desc">{{n.desc}}</div>
      <div class="val">
        <template v-if="n.status&&n.name==='tel'">{{n.text}}：<span>{{mobile|format}}</span></template>
        <template v-if="n.status&&n.name==='auth'">{{true_name.truename}}：<span>{{true_name.idcard|cardformat}}</span></template>
        <template v-if="n.status&&n.name==='test'">风险分数：<span>{{testResult}}</span></template>
        <template v-if="n.status&&n.name==='card'">{{bankCard.open_bank}}：<span>{{bankCard.card_no|cardformat}}</span></template>
        <template v-if="n.status&&n.name==='address'">{{n.text}}：<span>{{mobile|format}}</span></template>
      </div>
      <div class="opr" @click="setEdit(n.name,n.title,n.setting)" v-if="n.name!=='test'">{{n.opr}}</div>
      <router-link class="opr" to="/accountEvaluate" v-else>{{n.opr}}</router-link>
    </div>
  </div>
</template>

<script>
  import api from '@/util/function'
  import util from '@/util'
  import { mapState } from 'vuex'
  export default {
    props: {
      nav: {
        type: Array
      },
      type: {
        type: String,
        default: 'account'
      }
    },
    data () {
      return {
        true_name: {idcard: '', truename: ''},
        bankCard: {open_bank: '', card_no: ''},
        testResult: 0,
        tipInfo: ['正在审核', '认证成功', '认证不一致']
      }
    },
    methods: {
      setEdit (str, title, setting) {
        if (!setting) return false
        this.$parent.edit = str
        this.$parent.title = title
        window.scroll(0, 0)
        document.body.style.overflow = 'hidden'
      }
    },
    computed: {
      ...mapState({
        token: state => state.info.token,
        user_id: state => state.info.user_id,
        mobile: state => state.info.mobile
      })
    },
    mounted () {
      var self = this
      if (this.type !== 'account') return false
      util.post('getAll', {sign: api.serialize({token: this.token, user_id: this.user_id})}).then(function (data) {
        if (data.true_name) {
          self.$parent.nav[1].status = 1
          self.$parent.nav[1].opr = self.tipInfo[data.true_name.status]
          self.$parent.nav[1].setting = data.true_name.status === 1
          self.true_name = data.true_name
        }
        if (data.bank_card) {
          self.$parent.nav[3].status = 1
          self.bankCard = data.bank_card
        }
        if (data.risk.user_risk_score > 0) {
          self.$parent.nav[2].status = 1
          self.testResult = data.risk.user_risk_score
        }
      })
    },
    filters: {
      format: api.telReadable,
      cardformat: api.cardReadable
    }
  }
</script>

<style type="text/css" lang="scss">
  @import '../../assets/css/style.scss';
  .setting{
    padding:25px 30px;
    .item{
      @include menu
    }
  }
</style>
