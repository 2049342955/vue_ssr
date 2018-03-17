<template>
  <div :class="['nodata', {pro: product}]">
    <div class="nodata_img"></div>
    <p>{{product?'即将上线，敬请期待':'暂无列表信息'}}</p>
  </div>
</template>

<script>
  export default {
    props: {
      product: {
        type: Boolean,
        default: false
      }
    }
  }
</script>

<style type="text/css" lang="scss">
  .nodata {
    width: 100%
  }
  @include nodata
  .nodata.pro{
    background: #fff;
    min-height:500px;
    padding-top:100px;
    .nodata_img{
      width: 305px;
      height: 234px;
      background: url('~@/assets/images/css_sprites.png') -10px -10px;
    }
  }
</style>
