<template>
  <article class="article">
    <router-view class="box"></router-view>
  </article>
</template>

<script>
export default {
  data () {
    return {
      nav: []
    }
  }
}
</script>

<style type="text/css" lang="scss">
  @import '../assets/css/style.scss';
  .article{
    background: #f7f8fa;
    padding:40px 0;
    .box{
      @include main
      background: $white;
      border-radius:5px;
      min-height:800px;
      h2{
        font-size: 18px;
        font-weight: bold;
        text-align: center;
        padding:18px 0;
        border-bottom:1px solid $border
      }
      .box_content{
        padding:40px 90px;
        font-size: 16px;
        h3{
          font-weight: bold;
          margin-bottom:20px;
        }
        h4{
          margin-bottom:30px;
        }
        p{
          margin-bottom:20px;
          line-height: 2;
          text-indent: 2em;
          &.b{
            font-weight: bold;
          }
        }
        .btn{
          text-align: center;
          button,a{
            padding:10px 50px;
            @include button($blue)
            font-size: 16px;
            border-radius:5px
          }
        }
      }
    }
  }
</style>
