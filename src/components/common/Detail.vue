<template>
  <section class="web_info_detail">
    <div class="info_detail_title">
      <span>{{content.title}}</span>
      <span class="button" @click="back">< 返回</span>
    </div>
    <div class="info_detail_content" v-html="content.content" style="padding:0 50px;"></div>
    <div class="next_prev" v-if="$route.name !== 'currencyDetail'">
      <div class="btn" @click="getContent(prev.id)">上一篇：<span>{{prev.title}}</span></div>
      <div class="btn" @click="getContent(next.id)"> 下一篇：<span>{{next.title}}</span></div>
    </div>
  </section>
</template>

<script>
  import { fetchApiData } from '@/util'
  export default {
    data () {
      return {
        content: {},
        next: {},
        prev: {}
      }
    },
    methods: {
      getDetail () {
        let url = ''
        let data = ''
        if (this.$route.name === 'currencyDetail') {
          url = 'showCoinInfoDetail'
          data = {token: 0, coin_id: this.$route.params.id}
        } else {
          url = 'content'
          data = {token: 0, news_id: this.$route.params.id}
        }
        fetchApiData(this, url, data, (res) => {
          this.content = res
        })
        if (this.$route.name !== 'currencyDetail') {
          this.pageInit()
        }
      },
      getContent (id) {
        if (id === -1) return false
        let str = this.$route.path.split('/')[1]
        this.$router.replace({path: '/' + str + '/detail/' + id})
        this.getDetail()
      },
      back () {
        window.history.back()
      },
      pageInit () {
        let idLists = JSON.parse(localStorage.getItem('all_id'))
        idLists.forEach((v, i) => {
          if (+this.$route.params.id === v.id) {
            this.next = idLists[i + 1] ? idLists[i + 1] : {id: -1, title: '没有下一篇了'}
            this.prev = idLists[i - 1] ? idLists[i - 1] : {id: -1, title: '没有上一篇了'}
          }
        })
      }
    },
    mounted () {
      this.getDetail()
    }
  }
</script>

<style type="text/css" lang="scss">
  .web_info_detail {
    min-height:500px;
    background: #fff;
    padding:15px 15px 45px 15px;
    line-height: 2;
    .info_detail_title {
      text-align:left;
      font-size: 20px;
      line-height: 2;
      font-weight: bold;
      border-bottom: 1px solid #e5e5e5;
      margin-bottom: 20px;
      .button {
        text-align: center;
        float: right;
        display:inline-block;
        border: 0;
        font-size: 14px;
        font-weight: 100;
        line-height: 38px;
        color:#327fff;
        cursor: pointer;
      }
    }
    .info_detail_content {
      img {
        width:auto;
        max-width:100%
      }
    }
    .next_prev {
      width: 100%;
      height: 30px;
      margin-bottom: 30px;
      margin-top: 30px;
      .btn {
        width: 40%;
        float: left;
        border:0;
        background: white;
        text-align: left;
        color: #327fff;
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
        cursor: pointer;
      }
      :nth-child(2) {
        float: right;
        text-align: right;
      }
    }
  }
</style>
