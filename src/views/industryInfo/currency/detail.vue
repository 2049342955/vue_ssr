<template>
  <div class="currency_detail" v-if="isMobile===0">
    <WebInfoDetail></WebInfoDetail>
  </div>
  <pageFrame v-else-if="isMobile===1">
    <WebInfoDetail></WebInfoDetail>
  </pageFrame>
</template>

<script>
  import { mapState } from 'vuex'
  import WebInfoDetail from '@/components/common/Detail'
  import pageFrame from '@/components/common/PageFrame'
  export default {
    components: {
      WebInfoDetail, pageFrame
    },
    computed: {
      ...mapState({
        isMobile: state => state.isMobile
      })
    }
  }
</script>

<style type="text/css" lang="scss">
  .currency_detail{
    background:#f7f8fa;
    overflow: hidden;
    width:100%;
    padding:20px 0;
    .web_info_detail{
      width:1160px;
      min-height:700px;
      margin:0 auto;
    }
  }
</style>
