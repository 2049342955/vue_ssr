<template>
  <div class="mobile_computehome">
    <div class="mobile_navcompute">
      <router-link :to="n.path" v-for="n, k in navcompute" :key="k" :class="{'active': k === 0}">
        <em>{{n.title}}</em>
        <span>|</span>
      </router-link>
    </div>
    <div class="mobile_listscompute">
      <!-- <router-link to="#" v-for="n, k in newslists">
        <h2>{{n.title}}</h2>
        <p v-html="n.content"></p>
      </router-link> -->
      <ul
  v-infinite-scroll="loadMore"
  infinite-scroll-disabled="loading"
  infinite-scroll-distance="len">
  <li v-for="item in newslists" style="height:200px;">{{ item.title}}</li>
</ul>
<p class="page-infinite-loading" v-if="!loading"><span><div class="mint-spinner-fading-circle circle-color-41" style="width: 28px; height: 28px;"><div class="mint-spinner-fading-circle-circle is-circle2"></div><div class="mint-spinner-fading-circle-circle is-circle3"></div><div class="mint-spinner-fading-circle-circle is-circle4"></div><div class="mint-spinner-fading-circle-circle is-circle5"></div><div class="mint-spinner-fading-circle-circle is-circle6"></div><div class="mint-spinner-fading-circle-circle is-circle7"></div><div class="mint-spinner-fading-circle-circle is-circle8"></div><div class="mint-spinner-fading-circle-circle is-circle9"></div><div class="mint-spinner-fading-circle-circle is-circle10"></div><div class="mint-spinner-fading-circle-circle is-circle11"></div><div class="mint-spinner-fading-circle-circle is-circle12"></div><div class="mint-spinner-fading-circle-circle is-circle13"></div></div></span>
      加载中...
    </p>
    <!-- <p v-if="!loading">加载中······</p> -->
    </div>
  </div>
</template>

<script>
import util from '@/util/index'
import api from '@/util/function'
// import Vue from 'vue'
// import { InfiniteScroll } from 'mint-ui'
// Vue.use(InfiniteScroll)
export default {
  data () {
    return {
      newslists: [],
    //   list: '',
      now: 1,
      total: 0,
      loading: false,
      len: 0,
      navcompute: [{title: '快讯', path: '/industryInformation'}, {title: '资讯', path: ''}, {title: '测评', path: '/industryInformation'}, {title: '币种', path: '/industryInformation'}, {title: '厂商', path: '/industryInformation'}]
    }
  },
  methods: {
    loadMore () {
      var self = this
      this.loading = true
      if (this.total > this.newslists.length || this.newslists.length === 0) {
        util.post('NewsMuseumList', {sign: api.serialize({token: 0, page: this.now})}).then(function (res) {
          api.checkAjax(self, res, () => {
            self.total = res.total
            self.len = res.list.length
            setTimeout(function () {
              for (let i = 0; i < self.len; i++) {
                self.newslists.push(res.list[i])
              }
              self.loading = false
              // self.newslists.push(res.list)
              self.now++
            }, 2500)
          })
        }).catch(res => {
          console.log(res)
        })
      }
    }
    // loadMore () {
    //   this.getList()
    //   setTimeout(() => {
    //     var last = this.newslists[this.newslists.length - 1]
    //     for (var i = 1; i <= 6; i++) {
    //       this.newslists.push(last + i)
    //     }
    //   }, 1000)
    // }
  },
  mounted () {
    // var self = this
    // util.post('NewsMuseumList', {sign: api.serialize({token: 0})}).then(function (res) {
    //   api.checkAjax(self, res, () => {
    //     self.newslists = res
    //   })
    // }).catch(res => {
    //   console.log(res)
    // })
  }
}
</script>

<style lang="scss" scoped>
  .mobile_computehome{
    width: 100%;
    height: 100%;
    background: #f4f4f4;
    .mobile_navcompute{
      width: 100%;
      height: 2rem;
      background: white;
      display: flex;
      justify-content: space-between;
      border:1px solid #bfbfbf;
      box-sizing: border-box;
      border-left:0;
      border-right:0;
      margin-bottom: .5rem;
      :last-child span{
        display:none;
      }
      a{
        width: 20%;
        height: 2rem;
        display:inline-block;
        line-height: 2rem;
        text-align: center;
        span{
            float: right;
            font-size: 0.6rem;
            color:#1b1b1b;
        }
        em{
            font-style:normal;
            font-size: 0.6rem;
            color:#1b1b1b;
        }
        &:hover{
            em{
                display:inline-block;
                border-bottom:2px solid #fe5039;
                box-sizing: border-box;
                width: 1.9rem;
                height: 1.95rem;
                color:#fe5039;
            }
        }
        &.active{
            em{
                display:inline-block;
                border-bottom:2px solid #fe5039;
                box-sizing: border-box;
                width: 1.9rem;
                height: 1.95rem;
                color:#fe5039;
            }
        }
      }
    }
    .mobile_listscompute{
      width: 100%;
      overflow: hidden;
      background: white;
    }
  }
</style>
