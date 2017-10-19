<template>
  <section class="issues">
    <h3>算力宝的模式是什么？</h3>
    <p>浙江算力网络科技有限公司（算力宝）是国内首家区块链云算力服务平台，于2016年5月底正式上线。</p>
    <p>算力宝以区块链云算力租赁为主要业务。算力宝将IDC服务提供商主板上市企业高升控股（000971）、区块链顶尖芯片研发及计算设备提供商嘉楠耘智、全球最大的比特币交易所及钱包服务商OKCoin、矿池等资源进行打通和整合，让用户通过网络即可实现远程挖矿，体验科技的同时享受算力产生的比特币收益。</p>
  </section>
</template>

<script>
  export default {
    name: 'Issues',
    data () {
      return {
        nav: ''
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
  .issues{
    h3{
      margin-bottom:30px
    }
    p{
      text-indent: 2em;
    }
  }
</style>
