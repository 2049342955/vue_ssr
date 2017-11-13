<template>
  <section class="helplist">
    <div class="header">
      <span class="left">< <em>返回</em></span>
      <span>帮助中心</span>
    </div>
    <mt-navbar v-model="selected">
      <mt-tab-item id="1">选项一</mt-tab-item>
      <mt-tab-item id="2">选项二</mt-tab-item>
      <mt-tab-item id="3">选项三</mt-tab-item>
    </mt-navbar>

    <!-- tab-container -->
    <mt-tab-container v-model="selected">
      <mt-tab-container-item id="1">
        <mt-cell v-for="n in 10" :title="'内容 ' + n" />
      </mt-tab-container-item>
      <mt-tab-container-item id="2">
        <mt-cell v-for="n in 4" :title="'测试 ' + n" />
      </mt-tab-container-item>
      <mt-tab-container-item id="3">
        <mt-cell v-for="n in 6" :title="'选项 ' + n" />
      </mt-tab-container-item>
    </mt-tab-container>
  </section>
</template>

<script>
  export default {
    data () {
      return {
        selected: 1
      }
    }
  }
</script>

<style type="text/css" lang="scss">
  .helplist{
    width: 100%;
    height: 100vh;
    background: #f5f5f9;
    .header{
      width: 100%;
      height: 1.5rem;
      background: #327fff;
      text-align: center;
      color: white;
      font-size: 0.6rem;
      line-height: 1.5rem;
      position: relative;
      margin-bottom:.5rem;
      .left{
        position: absolute;
        left: .5rem;
        font-family: "宋体";
        font-size: 0.7rem;
        em{
          font-size: 0.5rem;
          font-style: normal;
          position: relative;
          top:-.08rem;
        }
      }
    }
  }
</style>
