<template>
  <article class="web_info">
    <div class="box">
      <div class="swip">
        <router-link class="tab" :to="n.path" v-for="n in nav[no]" :key="n.id">{{n.title}}</router-link>
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
        nav: [[{name: 'aboutUs', title: '关于我们', path: '/webInfo/aboutUs'}, {name: 'Issues', title: '常见问题', path: '/webInfo/issues'}], [{name: 'product', title: '产品公告', path: '/webInfo/list/product'}, {name: 'website', title: '网站动态', path: '/webInfo/list/website'}, {name: 'news', title: '算力资讯', path: '/webInfo/list/news'}]],
        no: 0
      }
    },
    created () {
      this.judge()
    },
    watch: {
      $route () {
        this.judge()
      }
    },
    methods: {
      judge () {
        this.no = ((this.$route.name === 'list' || this.$route.name === 'webInfoDetail') && '1') || ((this.$route.name === 'issues' || this.$route.name === 'aboutUs') && '0')
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
        color: #666;
        margin-right: 36px;
        font-weight: 100;
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
