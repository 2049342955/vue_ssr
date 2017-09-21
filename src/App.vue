<template>
  <article id="app">
    <MyHead v-if="!$route.path.includes('auth')"></MyHead>
    <router-view class="body"></router-view>
    <MyFoot v-if="!$route.path.includes('auth')"></MyFoot>
  </article>
</template>

<script>
  import MyHead from './components/common/Header'
  import MyFoot from './components/common/Footer'
  export default {
    components: {
      MyHead,
      MyFoot
    }
  }
</script>

<style type="text/css" lang="scss">
  @import './assets/css/public.scss';
</style>