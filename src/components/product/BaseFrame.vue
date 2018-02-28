<template>
  <div class="base_frame">
    <div class="top_nav_box">
      <router-link to="/minerShop/list">算力服务器商城</router-link>
      <span>></span>
      <router-link to="/minerShop/cloudCompute">{{type}}</router-link>
      <span>></span>
      <em>{{name}}</em>
    </div>
    <slot></slot>
  </div>
</template>

<script>
  export default {
    props: {
      type: {
        type: String
      },
      name: {
        type: String
      }
    }
  }
</script>

<style type="text/css" lang="scss">
  .base_frame{
    background-image: url('~@/assets/images/miner_shop/miner_bg.jpg');
    width: 100%;
    height: 352px;
    background-size: 100% 100%;
    .top_nav_box {
      @include main
      padding-top: 12px;
      color: white;
      font-size: 12px;
      a{
        color: white;
      }
      span{
        padding:0 24px;
      }
      em{
        font-style: normal;
        color: #bfbfbf;
      }
    }
    .cloud_base_info, .miner_base_info {
      @include main
      margin-bottom:30px;
      background: white;
      height: 370px;
      box-shadow: #dfe0e1 0 5px 5px -3px;
      position: relative;
      margin-top:10px;
      .base_info_type{
        position: absolute;
        left: -10px;
        top:11px;
        width: 82px;
        height: 78px;
        text-align: center;
        color:white;
        .iconfont{
          font-size: 24px;
          padding-top:10px
        }
      }
    }
  }
</style>
