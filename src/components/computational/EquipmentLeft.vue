<template>
  <div class="leftnav">
    <div class="leftnav_ol" v-for="n, k in leftnav">
      <router-link :to="n.path">
        <span :class="n.big"></span>
        <i>{{n.title}}</i>
      </router-link>
    </div>
  </div>
</template>

<script>
  export default {
    data () {
      return {
        leftnav: [{big: 'icon-zixun1', title: '快讯', path: ''}, {big: 'icon-kuangji', title: '测评', path: ''}, {big: 'icon-zixun', title: '行业', path: ''}, {big: 'icon-bitebi', title: '币种', path: ''}, {big: 'icon-bowuguan', title: '博物馆', path: ''}, {big: 'icon-zhizaohangye', title: '厂商', path: ''}, {big: 'icon-dianlishebei', title: '电厂', path: ''}]
      }
    }
  }
</script>

<style lang="scss" scoped>

</style>
