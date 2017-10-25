<template>
  <article id="app">
    <MyHead></MyHead>
    <router-view class="body"></router-view>
    <MyFoot></MyFoot>
    <div class="web_tips" ref="tips"></div>
  </article>
</template>

<script>
  import MyHead from './components/common/Header'
  import MyFoot from './components/common/Footer'
  export default {
    components: {
      MyHead,
      MyFoot
    },
    mounted () {
      var self = this
      window.onunload = function () {
        self.$store.commit('LOGOUT')
      }
    }
  }
</script>

<style type="text/css" lang="scss">
  @import './assets/css/public.scss';
</style>