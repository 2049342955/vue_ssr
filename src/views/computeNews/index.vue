<template>
  <pcpmpute-news v-if="!isMobile"></pcpmpute-news>
  <mcpmpute-news v-else></mcpmpute-news>
</template>
<script>
  import { mapState } from 'vuex'
  import PcpmputeNews from './pc'
  import McpmputeNews from './mobile'
  export default {
    components: {
      PcpmputeNews, McpmputeNews
    },
    data () {
      return {
        active: '',
        computationallist: [{title: '算力资讯', path: '/industryInformation'}, {title: '设备之家', path: '/equipments/list'}, {title: '交易信息', path: '/transaction'}, {title: '挖矿币种', path: '/currency'}],
        leftnav: [{big: 'icon-zixun', title: '资讯', path: '/computeNews/list'}, {big: 'icon-zixun1', title: '快报', path: '/quickNews/list'}, {big: 'icon-zhizaohangye', title: '厂商', path: '/manufacturer/list'}, {big: 'icon-kuangji', title: '测评', path: '/equipmentEvaluate/list'}, {big: 'icon-bowuguan', title: '博物馆', path: '/equipments/list'}, {big: 'icon-bitebi', title: '历史曲线', path: '/computeChart/list'}]
      }
    },
    computed: {
      ...mapState({
        isMobile: state => state.isMobile
      })
    }
  }
</script>
