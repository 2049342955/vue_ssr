<template>
  <article id="app">
    <MyHead></MyHead>
    <router-view class="body"></router-view>
    <MyFoot></MyFoot>
    <div class="web_tips"></div>
  </article>
</template>

<script>
  import api from '@/util/function'
  import MyHead from './components/common/Header'
  import MyFoot from './components/common/Footer'
  export default {
    components: {
      MyHead,
      MyFoot
    },
    mounted () {
      if (api.checkEquipment()) {
        this.$store.commit('SET_EQUIPMENT', true)
      }
    }
  }
</script>

<style type="text/css" lang="scss">
  @import './assets/css/public.scss';
</style>