<template>
  <section class="notice">
    <template v-if="$route.params.type">
      <h3 v-if="">{{str[$route.params.type]}}</h3>
      <div class="display">
        <router-link :class="['item',{active: true}]" :to="'/webInfo/detail/'+list.id" v-for="list in lists" :key="lists.id">
          <span class="title">{{list.title}}</span>
          <span class="time">{{list.dateline}}</span>
        </router-link>
      </div>
    </template>
    <template v-else>
      <router-link :class="['item', 'img_text', {active: true}]" :to="'/computeNews/detail/'+list.id" v-for="list in lists" :key="lists.id">
        <template v-if="list.image">
          <img :src="list.image"/>
        </template>
        <template v-else>
          <img :src="img1"/>
        </template>
        <div class="right">
          <p class="title">{{list.title}}</p>
          <template v-if="list.source">
            <p class="time"><span style="margin-right:10px;">{{list.source}}</span>|<span style="margin-left:10px;">{{list.dateline}}</span></p>
          </template>
          <template v-else>
            <p class="time"><span style="margin-right:10px;">《算力网》</span>|<span style="margin-left:10px;">{{list.dateline}}</span></p>
          </template>
          <template v-if="list.resume">
            <p class="notice_content">{{list.resume}}......</p>
          </template>
          <template v-else>
            <p class="notice_content">暂无简介</p>
          </template>
        </div>
      </router-link>
    </template>
  </section>
</template>

<script>
  import util from '@/util'
  import api from '@/util/function'
  export default {
    data () {
      return {
        lists: [],
        str: {website: '网站动态', product: '产品公告'},
        requestUrl: {website: 'webDynamic', product: 'webAnnouncoment'},
        img1: require('@/assets/images/zx.jpg')
      }
    },
    methods: {
      judge () {
        var n = this.$route.params.type
        var url = this.requestUrl[n] || 'suanliMessage'
        document.querySelector('title').innerHTML = '算力新闻_比特币资讯－算力网'
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
  .img_text{
    width: 100%;
    padding-bottom: 27px;
    display: block;
    border-bottom:1px dashed #e5e5e5;
    overflow: hidden;
    margin-bottom: 28px;
    img{
      width: 200px;
      height: 120px;
      float: left;
      margin-right: 30px;
    }
    .title{
      color: black;
      font-size: 15px;
      padding-top: 5px;
      padding-bottom: 5px;
    }
    .time{
      font-size: 12px;
    }
    .notice_content{
      margin-top: 10px;
      font-size: 12px;
      line-height: 20px;
      height: 57px;
      overflow: hidden;
    }
  }
</style>
