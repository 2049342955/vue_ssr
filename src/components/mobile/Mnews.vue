<template>
  <section class="mask">
    <div class="mobile_header">
      <span class="left">< <em>我的</em></span>
      <span>我的消息</span>
    </div>
    <ul>
      <li>
        <span>下数据悬壶济世先后顺序喜上加喜函数解析式喜上加喜皇上吉祥</span>
        <i>2015-09-30</i>
      </li>
    </ul>
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
  background: #f5f5f9;
}
 ul{
   width: 100%;
   overflow: hidden;
   li{
     width: 100%;
     border-bottom:1px solid #dddddd;
     display: flex;
     justify-content: space-between;
     height: 3rem;
     line-height: 3rem;
     background:white;
     padding:0 .5rem;
     span{
       width: 70%;
       columns: #121212;
     }
     i{
       color: #a9a9a9;
       font-size: 0.45rem;
     }
   }
 }
</style>
