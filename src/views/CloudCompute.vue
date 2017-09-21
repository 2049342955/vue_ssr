<template>
  <article class="home">
  	<MyNav></MyNav>
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
