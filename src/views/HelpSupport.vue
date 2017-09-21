<template>
  <article class="home">
    <img :src="banner" alt="">
  </article>
</template>

<script>
export default {
  data () {
    return {
      banner: require('@/assets/images/banner.png')
    }
  }
}
</script>
