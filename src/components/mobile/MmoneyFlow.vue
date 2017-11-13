<template>
  <section class="bdcform" to="#">
    <div class="mobile_header">
      <span class="left">< <em>我的</em></span>
      <span>资金流水</span>
    </div>
    <p>
      <span>资金用途</span>
      <span>金额（元）</span>
    </p>
    <ul>
      <li>
        <span class="left">
          <i>算力租钱投资</i>
          <em>2015-09-30</em>
        </span>
        <span class="right">+30</span>
      </li>
    </ul>
  </section>
</template>
<script>
export default {
  data () {
    return {
      option: {'title': '请选择BDC'}
    }
  }
}
</script>
<style scoped lang="scss">
  .bdcform{
    width: 100%;
    height: 100vh;
    background: #f5f5f9;
    p{
      width: 100%;
      display: flex;
      justify-content: space-between;
      padding:0 .5rem;
      color: #999999;
      font-size: 0.6rem;
      border-bottom:1px solid #ddd;
      padding-bottom:.4rem;
    }
    ul{
      width: 100%;
      height: 3rem;
      background: white;
      padding:0 .5rem;
      border-bottom:1px solid #ddd;
      box-sizing: border-box;
      li{
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: space-between;
        .left i{
          display: block;
          font-size: .6rem;
          padding-top: .5rem;
        }
        .left em{
          display: block;
          font-size: .45rem;
          padding-top: .3rem;
          color: #a9a9a9;
          font-style: normal;
        }
        .right{
          line-height: 3rem;
          color: #01beb5;
          font-weight: 800;
          font-size: 0.6rem;
        }
      }
    }
  }
</style>