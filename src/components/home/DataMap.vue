<template>
  <div class="data_map"></div>
</template>

<script>
  export default {
    name: 'chart',
    data () {
      return {
        img: require('@/assets/images/world.png')
      }
    },
    methods: {
      test () {
        console.log(11)
      }
    }
  }
</script>

<style type="text/css" lang="scss">
  @import '../../assets/css/style.scss';
  .data_map{
    
  }
</style>