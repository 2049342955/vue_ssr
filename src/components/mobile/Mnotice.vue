<template>
  <section class="mask">
    <div class="mobile_header">
      <span class="left">< <em>返回</em></span>
      <span>新闻公告</span>
    </div>
    <div class="list">
      <router-link to="#" class="route">
        <span class="left">
          <i>算力网正式上线</i>
          <em>2015.10.22 17:14:25</em>
        </span>
        <span class="right">加上你看下三星陕西安康三姓家奴刷卡机想那些实习就阿克苏新年开始向纳税是希纳斯希纳斯</span>
      </router-link>
      <router-link to="#" class="route">
        <span class="left">
          <i>算力网正式上线</i>
          <em>2015.10.22 17:14:25</em>
        </span>
        <span class="right">加上你看下三星陕西安康三姓家奴刷卡机想那些实习就阿克苏新年开始向纳税是希纳斯希纳斯</span>
      </router-link>
    </div>
  </section>
</template>

<script>
  export default {
  }
</script>

<style type="text/css" lang="scss">
  .mask{
    width: 100%;
    height: 100vh;
    background: #f5f5f9 !important;
  }
  .list{
    width: 100%;
    overflow: hidden;
    .route{
      width: 100%;
      height: 3rem;
      display: block;
      background: white;
      border-top:1px solid #dddddd;
      padding:0 .5rem;
      border-bottom:1px solid #dddddd;
      box-sizing: border-box;
      margin-top: 0.5rem;
      .left{
        width: 100%;
        display: flex;
        justify-content:space-between;
        padding-top: 0.5rem;
        i{
          font-size: 0.6rem;
          color: black;
        }
        em{
          font-style: normal;
          color: #b8b8b8;
          font-size: 0.4rem;
        }
      }
      .right{
        display: inline-block;
        width: 100%;
        white-space: nowrap;  
        text-overflow:ellipsis; 
        overflow:hidden;
        color: #666666;
        font-size: 0.5rem;
        padding-top: .35rem;
      }
    }
  }
</style>
