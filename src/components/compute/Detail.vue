<template>
  <section class="compute_detail">
    <Pay></Pay>
  </section>
</template>

<script>
import Pay from '../common/Pay'
export default {
  components: {
    Pay
  },
  data () {
    return {
      account:
      {
        balance: 80000.00
      }
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
  .compute_detail{
    margin-top: 80px;
    padding-top: 10px;
    background: #f7f8fa;
  }
</style>
