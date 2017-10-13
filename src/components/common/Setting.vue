<template>
  <div class="setting">
    <div :class="['item', {fail: !n.status}, {success: n.status}]" v-for="n,k in nav">
      <div class="icon"></div>
      <div class="con_title">{{n.title}}</div>
      <div class="desc">{{n.desc}}</div>
      <div class="val">
        <template v-if="n.status&&n.name==='tel'">{{n.text}}：<span>{{mobile|format}}</span></template>
        <template v-if="n.status&&n.name==='auth'">{{true_name.truename}}：<span>{{true_name.idcard|cardformat}}</span></template>
        <template v-if="n.status&&n.name==='test'">风险分数：<span>{{risk.user_risk_score}}</span></template>
        <template v-if="n.status&&n.name==='card'">{{bank_card.open_bank}}：<span>{{bank_card.card_no|cardformat}}</span></template>
        <template v-if="n.status&&n.name==='address'">{{n.text}}：<span>{{bindAddress.product_hash_type}}</span></template>
      </div>
      <div class="opr" @click="setEdit(n.name,n.title,n.setting)" v-if="n.name!=='test'">{{n.opr}}</div>
      <div class="opr" @click="test(n.setting)" v-else>{{n.opr}}</div>
    </div>
    <div class="web_tips" ref="tips"></div>
  </div>
</template>

<script>
  import api from '@/util/function'
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
        tipInfo: ['正在审核', '认证成功', '认证不一致']
      }
    },
    methods: {
      setEdit (str, title, setting) {
        console.log(str)
        if (str === 'card' || str === 'address' || str === 'trade') {
          if (!this.true_name) {
            api.tips(this.$refs.tips, '请先实名认证')
            return false
          }
          if (this.risk.user_risk_score < 0) {
            api.tips(this.$refs.tips, '请先进行风险测评')
            return false
          }
        }
        if (!setting) return false
        this.$parent.edit = str
        this.$parent.title = title
        window.scroll(0, 0)
        document.body.style.overflow = 'hidden'
      },
      test (n) {
        if (!this.true_name) {
          api.tips(this.$refs.tips, '请先实名认证')
          return false
        }
        if (!n) return false
        this.$router.push({name: 'accountEvaluate'})
      }
    },
    computed: {
      ...mapState({
        token: state => state.info.token,
        user_id: state => state.info.user_id,
        mobile: state => state.info.mobile,
        true_name: state => state.info.true_name,
        bank_card: state => state.info.bank_card,
        risk: state => state.info.risk,
        bindAddress: state => state.info.bindAddress
      })
    },
    mounted () {
      if (this.type !== 'account') return false
      if (this.true_name) {
        this.$parent.nav[1].status = 1
        this.$parent.nav[1].opr = this.true_name.status > 1 ? '重新认证' : this.tipInfo[this.true_name.status]
        this.$parent.nav[1].setting = this.true_name.status > 1
      }
      if (this.bank_card) {
        this.$parent.nav[3].status = 1
        this.$parent.nav[3].opr = '重新绑定'
      }
      if (this.risk.user_risk_score > 0) {
        this.$parent.nav[2].status = 1
        this.$parent.nav[2].opr = '已测评'
        this.$parent.nav[2].setting = false
      }
      if (this.bindAddress) {
        this.$parent.nav[4].status = 1
        this.$parent.nav[4].opr = '重新设置'
      }
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
