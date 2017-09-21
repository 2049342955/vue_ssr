<template>
  <article class="home">
    <MyNav></MyNav>
    <Swiper :pagination-visible="true" :loop="true">
      <img class="swiper_one" :src="n" v-for="n in banners">
    </Swiper>
  </article>
</template>

<script>
  import MyNav from '@/components/common/nav'
  import Swiper from '../components/common/Swipe'
  export default {
    components: {
      MyNav, Swiper
    },
    data () {
      return {
        banners: [require('@/assets/images/banner.png'), require('@/assets/images/banner2.png'), require('@/assets/images/banner3.png'), require('@/assets/images/banner4.png')]
      }
    }
  }
</script>

<style type="text/css" lang="scss">
  @import '../assets/css/style.scss';
</style>
