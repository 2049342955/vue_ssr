<template>
  <section class="notice">
    <h3>{{str[$route.params.type]}}</h3>
    <div class="display">
      <router-link :class="['item',{active: true}]" :to="'/webInfo/detail/'+$route.params.type+'/'+list.id" v-for="list in lists" :key="lists.id">
        <span class="title">{{list.title}}</span>
        <span class="time">{{list.dateline}}</span>
      </router-link>
      <router-view class="content"></router-view>
    </div>
    <div class="web_tips" ref="tips"></div>
  </section>
</template>

<script>
  import util from '../../util'
  import api from '../../util/function'
  export default {
    data () {
      return {
        lists: [],
        str: {website: '网站动态', product: '产品公告', news: '算力资讯'},
        requestUrl: {website: 'webDynamic', product: 'webAnnouncoment', news: 'suanliMessage'}
      }
    },
    methods: {
      judge () {
        var n = this.$route.params.type
        var url = this.requestUrl[n]
        document.querySelector('title').innerHTML = this.str[n]
        var self = this
        util.post(url, {sign: 'token=0'}).then(function (res) {
          api.checkAjax(self, res, () => {
            self.lists = res
          })
        })
      }
    },
    created () {
      this.judge()
    },
    watch: {
      $route () {
        this.judge()
      }
    }
  }
</script>
<style type="text/css" lang="scss">
  @import '../../assets/css/style.scss';
  .notice{
    background: #fff;
    padding: 20px 40px;
    min-height:500px;
    h3{
      font-size: 24px;
      font-weight: 400;
      padding-bottom: 10px;
      border-bottom: 1px solid #e5e5e5;
      margin-bottom: 20px;
      color: #333333;
    }
    .display{
      .item{
        @include flex(space-between);
        margin: 5px 0;
        height: 80px;
        line-height: 80px;
        background: #f6f7fb;
        padding: 0 25px;
        .title{
          font-size: 18px;
        }
        .time{
          font-size: 14px;
        }
      }
      .item:hover{
        color:#327fff;
        background: #f0f7ff ;
      }
      .page{
        display: block;
      }
    }
  }
</style>
