<template>
  <div class="setting">
    <div :class="['item', {fail: !menu[type==='password'?k+5:k].status}, {success: menu[type==='password'?k+5:k].status}]" v-for="n,k in nav">
      <div class="icon"></div>
      <div class="con_title">{{n.title}}</div>
      <div class="desc">{{n.desc}}</div>
      <div class="val">
        <template v-if="menu[k].status&&n.name==='tel'">{{n.text}}：<span>{{mobile|format}}</span></template>
        <template v-if="menu[k].status&&n.name==='auth'">{{true_name.truename}}：<span>{{true_name.idcard|cardformat}}</span></template>
        <template v-if="menu[k].status&&n.name==='test'">风险分数：<span>{{risk.user_risk_score}}</span></template>
        <template v-if="menu[k].status&&n.name==='card'">{{bank_card.open_bank}}：<span>{{bank_card.card_no|cardformat}}</span></template>
        <template v-if="menu[k].status&&n.name==='address'">{{n.text}}：<span>{{bindAddress.product_hash_type}}</span></template>
      </div>
      <div class="opr" @click="setEdit(n.name,n.title,menu[type==='password'?k+5:k].setting)" v-if="n.name!=='test'">{{menu[type==='password'?k+5:k].opr}}</div>
      <div class="opr" @click="test(menu[k].setting)" v-else>{{menu[k].opr}}</div>
    </div>
    <div class="web_tips" ref="tips"></div>
  </div>
</template>

<script>
  import api from '@/util/function'
  import { mapState, mapGetters } from 'vuex'
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
    methods: {
      setEdit (str, title, setting) {
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
      }),
      ...mapGetters([
        'menu'
      ])
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
