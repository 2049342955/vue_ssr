<template>
  <section class="notice">
    <h3>{{navi}}</h3>
    <div class="display">
      <router-link :class="['item',{active: true}]" :to="list.path" v-for="list in lists" :key="lists.id">
        <span class="title">{{list.title}}</span>
        <span class="time">{{list.time}}</span>
      </router-link>
      <router-view class="content"></router-view>
      <Pager class="page" v-show="lists.length>4"></Pager>
    </div>
  </section>
</template>

<script>
  import Pager from '../common/Pager'
  export default {
    components: {
      Pager
    },
    name: 'notice',
    data () {
      return {
        lists: '',
        navi: '',
        dataLists: '',
        len: 5
      }
    },
    methods: {
      judge () {
        if (this.$route.path.includes('product')) {
          this.lists = this.dataLists.product
          this.navi = '产品公告'
        } else if (this.$route.path.includes('website')) {
          this.lists = this.dataLists.website
          this.navi = '网站动态'
        }
      }
    },
    created () {
      console.log(this.$route.path)
      // 列表数据
      this.dataLists =
      {
        product:
        [
          {
            title: '保全网获数千万融资 欲借助区块链技术打造连接现实与虚拟的平台',
            path: '/other/noticeDetail/1',
            time: '2017-05-11    08:12:59'
          },
          {
            title: '保全网获数千万融资 欲借助区块链技术打造连接现实与虚拟的平台',
            path: '/other/noticeDetail/3',
            time: '2017-05-11    08:12:59'
          },
          {
            title: '保全网获数千万融资 欲借助区块链技术打造连接现实与虚拟的平台',
            path: '/other/noticeDetail/4',
            time: '2017-05-11    08:12:59'
          },
          {
            title: '保全网获数千万融资 欲借助区块链技术打造连接现实与虚拟的平台',
            path: '/other/noticeDetail/5',
            time: '2017-05-11    08:12:59'
          },
          {
            title: '保全网获数千万融资 欲借助区块链技术打造连接现实与虚拟的平台',
            path: '/other/noticeDetail/6',
            time: '2017-05-11    08:12:59'
          }
        ],
        website:
        [
          {
            title: '保全网获数千万融资 网站动态',
            path: '/other/noticeDetail/05',
            time: '2017-05-11    08:12:59'
          },
          {
            title: '保全网获数千万融资 网站动态',
            path: '/other/noticeDetail/04',
            time: '2017-05-11    08:12:59'
          },
          {
            title: '保全网获数千万融资 网站动态',
            path: '/other/noticeDetail/03',
            time: '2017-05-11    08:12:59'
          },
          {
            title: '保全网获数千万融资 网站动态',
            path: '/other/noticeDetail/02',
            time: '2017-05-11    08:12:59'
          },
          {
            title: '保全网获数千万融资 网站动态',
            path: '/other/noticeDetail/01',
            time: '2017-05-11    08:12:59'
          }
        ]
      }
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
      .page{
        display: block;
      }
    }
  }
</style>
