<template>
  <section class="mask">
    <button>NEIVNEI</button>
  </section>
</template>

<script>
  import api from '@/util/function'
  export default {
    props: {
      form: {
        type: Array
      },
      title: {
        type: String
      },
      contract: {
        type: String
      }
    },
    filters: {
      format: api.decimal
    }
  }
</script>

<style type="text/css" lang="scss">
  @import '../../assets/css/style.scss';
  .mask{
    
  }
</style>
