<template>
  <article class="web_info">
    <div class="box">
      <div class="swip">
        <router-link class="tab" :to="navi.path" v-for="navi in navis" :key="navi.id">{{navi.title}}</router-link>
      </div>
    </div>
    <div class="swip">
      <router-view class="content"></router-view>
    </div>
  </article>
</template>

<script>
  export default {
    data () {
      return {
        navis:
        [
          {name: 'aboutUs', title: '关于我们', path: '/webInfo/aboutUs'},
          {name: 'product', title: '产品公告', path: '/webInfo/list/product'},
          {name: 'website', title: '网站动态', path: '/webInfo/list/website'},
          {name: 'safeGuarantee', title: '安全保障', path: '/webInfo/safeGuarantee'},
          {name: 'Issues', title: '常见问题', path: '/webInfo/issues'},
          {name: 'lawyer', title: '政策法规', path: '/webInfo/lawyer'}
        ]
      }
    }
  }
</script>
<style type="text/css" lang="scss">
  @import '../assets/css/style.scss';
  @import '../assets/fonts/iconfont.css';
  .swip{
    width:1180px;
    margin: 0 auto;
  }
  .web_info{
    width: 100%;
    background: #f7f8fa;
    padding-bottom: 60px;
    .box{
      margin: 0 auto;
      height: 60px;
      line-height: 60px;
      background: #fff;
      .tab{
        font-size: 16px;
        color: #333;
        margin-right: 36px;
        font-weight: bold;
      }
      .router-link-active{
        color:#327fff;
      }
    }
    .content{
      margin-top: 30px;
    }
  }
</style>
