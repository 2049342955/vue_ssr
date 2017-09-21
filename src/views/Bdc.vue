<template>
  <article class="bdc">
    <MyNav></MyNav>
    <router-view></router-view>
  </article>
</template>

<script>
import MyNav from '@/components/common/nav'
export default {
  components: {
    MyNav
  },
  data () {
    return {
      banner: ''
    }
  }
}
</script>
