<template>
  <div class="mobile_product_desc">
    <template v-if="$parent.$route.params.type!=='1'">
      <template v-for="n,k in $parent.infolists">
        <p class="title">{{n.title}}</p>
        <div class="product_content" v-html="$parent.$parent.detail[n.name]"></div>
      </template>
    </template>
    <template v-else>
      <template v-for="n,k in $parent.infolist">
        <p class="title">{{n.title}}</p>
        <div class="product_content" v-html="$parent.$parent.detail[n.name]"></div>
      </template>
    </template>
  </div>
</template>

<style type="text/css" lang="scss">
  @import '../../../assets/css/style.scss';
  .mobile_product_desc{
    margin-top:15px;
    p.title{
      color:$text;
      font-size: 16px;
      margin-bottom:5px;
    }
    .product_content{
      color:$light_black
    }
  }
</style>
