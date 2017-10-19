<template>
  <div class="issues_list">
    <router-link v-for="l,k in list" :to="'/webInfo/issues/item/'+k" :key="k">{{l}}</router-link>
  </div>
</template>

<script>
  export default {
    name: 'Issues',
    data () {
      return {
        list: ['1: 算力宝的模式是什么？', '2: 算力宝有哪些产品？', '3: 算力宝产品保本保息吗？', '4: 算力宝的优势是什么？']
      }
    },
    methods: {
      test (e) {
        console.log(11)
      }
    }
  }
</script>
<style type="text/css" lang="scss">
  @import '../../assets/css/style.scss';
  .issues_list{
    a{
      display: block;
    }
  }
</style>
