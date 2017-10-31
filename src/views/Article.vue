<template>
  <article class="article">
    <router-view class="box"></router-view>
  </article>
</template>

<script>
export default {
  data () {
    return {
      nav: []
    }
  }
}
</script>

<style type="text/css" lang="scss">
  @import '../assets/css/style.scss';
  .article{
    background: #f7f8fa;
    padding:40px 0;
    .box{
      @include article
    }
  }
</style>
