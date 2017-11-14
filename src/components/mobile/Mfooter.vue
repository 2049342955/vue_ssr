<template>
  <section class="mfooter">
    <mt-tabbar>
        <mt-tab-item id="外卖">
            <i class="ivu-icon ivu-icon-heart"></i>
            <p>精品</p>
        </mt-tab-item>
        <mt-tab-item id="订单">
            <i class="ivu-icon ivu-icon-social-yen-outline"></i>
            <p>赚钱</p>
        </mt-tab-item>
        <mt-tab-item id="发现">
            <i class="ivu-icon ivu-icon-person"></i>
            <p>我的</p>
        </mt-tab-item>
        <mt-tab-item id="我的">
            <i class="ivu-icon ivu-icon-chatbubble-working"></i>
            <p>更多</p>
        </mt-tab-item>
        </mt-tabbar>
  </section>
</template>

<script>
export default {
}
</script>

<style type="text/css" lang="scss">
  .mfooter {
      width: 100%;
      height: 100%;
      background: #f5f5f9;
  }
  i{
      display: block;
      font-size: 0.8rem;
      padding-bottom: .1rem;
  }
</style>

