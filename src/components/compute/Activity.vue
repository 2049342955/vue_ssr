<template>
  <div class="content">
    <div class="top">
    </div>
    <List></List>
  </div>
</template>

<script>
  import List from './List'
  export default {
    components: {
      List
    },
    data () {
      return {
        item: ''
      }
    }
  }
</script>

<style lang="scss">
  .content{
    width: 100%;
    min-height:700px;
    overflow: hidden;
    background: #151136;
    .top{
      width: 100%;
      height: 300px;
      background: red;
    }
  }
</style>
