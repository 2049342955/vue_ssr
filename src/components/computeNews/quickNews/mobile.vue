<template>
  <div class="mobilequicknews">
    <div v-infinite-scroll="loadMore" infinite-scroll-disabled="loading" infinite-scroll-distance="len" class="quicknews_lists">
      <div v-for="item, k in museum" :key="k" @click="clickcontent(item.id)" class="total">
        <h4> {{item.title}} </h4>
        <p v-html="item.content"></p>
        <div class="time"><span class="icon iconfont icon-shijian2"></span>{{times[k]}}分钟前</div>
      </div>
    </div>
    <p v-if="loading"  class="loadmore">加载中······</p>
  </div>
</template>

<script>
  import util from '@/util/index'
  import api from '@/util/function'
  import { mapState } from 'vuex'
  export default {
    data () {
      return {
        len: 0,
        now: 1,
        total: 0,
        loading: false,
        museum: [],
        content: '',
        times: []
      }
    },
    methods: {
      loadMore () {
        var self = this
        this.loading = true
        if (this.total > this.museum.length || this.museum.length === 0) {
          let time = this.museum.length === 0 ? 0 : 1000
          setTimeout(() => {
            util.post('showBrief_h5', {sign: api.serialize({token: 0, page: this.now})}).then(function (res) {
              api.checkAjax(self, res, () => {
                self.total = res.total
                for (var a = 0; a < res.length; a++) {
                  var date1 = res[a].dateline
                  var date2 = new Date()
                  var date3 = date2.getTime() - new Date(date1).getTime()
                  var leave1 = date3 % (24 * 3600 * 1000)
                  var days = Math.floor(date3 / (24 * 3600 * 1000)) * 24
                  var hours = Math.floor(leave1 / (3600 * 1000)) + days
                  self.times.push(hours)
                }
                for (let i = 0, len = res.length; i < len; i++) {
                  self.museum.push(res[i])
                }
                self.loading = false
                self.now++
              })
            }).catch(res => {
              console.log(res)
            })
          }, time)
        } else {
          this.loading = false
        }
      }
    },
    computed: {
      ...mapState({
        token: state => state.info.token
      })
    }
  }
</script>

<style lang="scss" scoped>
  .mobilequicknews{
    width: 100%;
    overflow: hidden;
    background: white;
    .quicknews_lists{
      width: 100%;
      padding:0 0.5rem;
      box-sizing: border-box;
      .total{
        border-bottom: 1px solid #bfbfbf;
        width: 100%;
        overflow: hidden;
        padding: 0.5rem 0;
        h4{
          font-size: 0.6rem;
          font-weight: 800;
          padding:0.1rem 0;
          width: 100%;
          white-space: nowrap;
          text-overflow: ellipsis;
          overflow: hidden;
        }
        p{
          padding: 0.2rem 0;
          box-sizing: border-box;
        }
        .time{
          padding-top:.2rem;
          span{
            color: #999;
            margin-right: .3rem;
            font-size: 0.8rem;
            position: relative;
            top: .05rem;
          }
        }
      }
    }
    .loadmore{
        width: 100%;
        height: 2rem;
        text-align: center;
        line-height: 2rem;
    }
  }
</style>
