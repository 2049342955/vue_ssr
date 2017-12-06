<template>
  <pcompute-home v-if="!isMobile"></pcompute-home>
  <mcompute-home v-else></mcompute-home>
</template>

<script>
  import util from '@/util/index'
  import api from '@/util/function'
  import { mapState } from 'vuex'
  import PcomputeHome from './pc'
  import McomputeHome from './mobile'
  export default {
    components: {
      PcomputeHome, McomputeHome
    },
    data () {
      return {
        scroll: [],
        autool: [{title: '蒙古矿场', text: '国家电网合规用电', button: '即将开放'}, {title: '山西矿场', text: '国家电网合规用电', button: '即将开放'}, {title: '辽宁矿场', text: '国家电网合规用电', button: '即将开放'}],
        tr: [{title: '币种'}, {title: '价格(元)'}, {title: '流通市值（亿/美元）'}, {title: '全网算力'}, {title: '单位挖矿产出'}],
        td: [],
        sheol1: [],
        sheol2: [],
        sheol3: [],
        headerlist: [{
          title: '设备之家',
          link: '/equipments/list',
          route: [{
            name: '矿机测评 >',
            path: '/equipmentEvaluate/list'
          }, {
            name: '矿机博物馆 >',
            path: '/equipments/list'
          }]
        }, {
          title: '数字货币',
          link: '/digitalCurrency/list',
          route: [{
            name: '主流币种 >',
            path: '/currency'
          }, {
            name: '数字货币 >',
            path: '/currency'
          }]
        }, {
          title: '二手资讯',
          link: '/transaction'
        }],
        bigimglist: '',
        show: 0,
        computationallist: [{title: '算力资讯', path: '/computeNews/list'}, {title: '设备之家', path: '/equipments/list'}, {title: '交易信息', path: '/transaction'}, {title: '挖矿币种', path: '/currency'}],
        // , {title: '电场矿场', path: '/computational/electric'}
        infoleft: [],
        inforight: [],
        active: 0,
        qwsl: '',
        miners: [{big: require('@/assets/images/information5.png'), title: '资深矿工-设备之家', route: '前往了解 >', path: '/equipments/list'}, {big: require('@/assets/images/information2.png'), title: '新手矿工-数字货币', route: '前往了解 >', path: '/digitalCurrency/list'}, {big: require('@/assets/images/information3.png'), title: '平台交易最新资讯', route: '前往了解 >', path: '/transaction'}]
      }
    },
    methods: {
      hoverwhite (k) {
        this.show = k
        var bigimg = document.getElementsByClassName('teimg')
        for (var a = 0; a < bigimg.length; a++) {
          if (a === k) {
            bigimg[a].style.opacity = '1'
          } else {
            bigimg[a].style.opacity = '0'
          }
        }
      }
    },
    mounted () {
      this.hoverwhite(0)
      var self = this
      util.post('showDifficulty', {sign: api.serialize({token: 0})}).then(function (res) {
        api.checkAjax(self, res, () => {
          self.qwsl = res
        })
      }).catch(res => {
        console.log(res)
      })
      util.post('showCoinData', {sign: api.serialize({token: 0})}).then(function (res) {
        api.checkAjax(self, res, () => {
          self.td = res
        })
      }).catch(res => {
        console.log(res)
      })
      util.post('NewsManfacturer', {sign: api.serialize({token: 0})}).then(function (res) {
        api.checkAjax(self, res, () => {
          self.sheol1 = res
        })
      }).catch(res => {
        console.log(res)
      })
      util.post('NewsReview', {sign: api.serialize({token: 0})}).then(function (res) {
        api.checkAjax(self, res, () => {
          self.sheol2 = res
        })
      }).catch(res => {
        console.log(res)
      })
      util.post('NewsMuseum', {sign: api.serialize({token: 0})}).then(function (res) {
        api.checkAjax(self, res, () => {
          self.sheol3 = res
        })
      }).catch(res => {
        console.log(res)
      })
      util.post('NewsBrief', {sign: api.serialize({token: 0})}).then(function (res) {
        api.checkAjax(self, res, () => {
          self.scroll = res
        })
      }).catch(res => {
        console.log(res)
      })
      util.post('showSecondHandTradeTopList', {sign: api.serialize({token: 0})}).then(function (res) {
        api.checkAjax(self, res, () => {
          self.inforight = res.buy_info
          self.infoleft = res.transfer_info
        })
      }).catch(res => {
        console.log(res)
      })
      util.post('showBannerNews', {sign: api.serialize({token: 0})}).then(function (res) {
        api.checkAjax(self, res, () => {
          self.bigimglist = res
        })
      }).catch(res => {
        console.log(res)
      })
    },
    computed: {
      ...mapState({
        token: state => state.info.token,
        isMobile: state => state.isMobile
      })
    }
  }
</script>
