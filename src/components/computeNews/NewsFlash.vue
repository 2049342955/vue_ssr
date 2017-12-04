<template>
  <div class="news_left">
    <h1><span>算力快报</span></h1>
    <div class="scroll_news">
      <div class="news_lists" v-for="n, k in newslists">
        <span class="icon iconfont icon-yinhao"></span>
        <h4>【{{n.title}}】<span>{{n.dateline}}</span></h4>
        <p v-html="n.content"></p>
      </div>
    </div>
  </div>
</template>

<script>
  import util from '@/util/index'
  import api from '@/util/function'
  import { mapState } from 'vuex'
  export default {
    data () {
      return {
        newslists: []
      }
    },
    methods: {
      getList () {
        var self = this
        util.post('NewsBriefList', {sign: api.serialize({token: this.token})}).then(function (res) {
          api.checkAjax(self, res, () => {
            self.newslists = res
          })
        }).catch(res => {
          console.log(res)
        })
      }
    },
    mounted () {
      this.getList()
    },
    computed: {
      ...mapState({
        token: state => state.info.token
      })
    }
  }
</script>

<style lang="scss" scoped>
  .news_left{
    float: left;
    width: 1002px;
    height: 1424px;
    background: white;
    padding:32px 62px 0 62px;
    box-sizing: border-box;
    h1{
      width: 100%;
      height: 53px;
      border-bottom: 1px solid #fe5039;
      margin-bottom: 28px;
      span{
        width: 183px;
        height: 100%;
        background: #fe5039;
        text-align: center;
        display:inline-block;
        line-height: 53px;
        color:white;
        font-weight: 800;
      }
    }
    .scroll_news{
      width: 100%;
      height: 1272px;
      overflow: auto;
      .news_lists{
        width: 100%;
        height: 120px;
        border-bottom: 1px solid #dcdcdc;
        margin-bottom: 10px;
        cursor: pointer;
        span{
          display: block;
          font-size: 16px;
          color: #fe5039;
        }
        h4{
          width: 100%;
          font-size: 14px;
          color: #333333;
          margin-bottom: 10px;
          span{
            float: right;
            color: #a9a9a9;
            font-size: 12px;
            margin-right: 20px;
          }
        }
        p{
          color: #a9a9a9;
          height: 44px;
          overflow: hidden;
          line-height: 22px;
          padding-right: 20px;
        }
        &:hover{
          height: auto;
          min-height: 120px;
          p{
            height: auto;
            min-height: 44px;
          }
        }
      }
        &::-webkit-scrollbar {/*滚动条整体样式*/
            width: 10px;     /*高宽分别对应横竖滚动条的尺寸*/
            background-color:transparent;
        }
        &::-webkit-scrollbar-thumb {/*滚动条里面小方块*/
            border-radius: 10px;
            max-height: 100px !important;
            background: #fe5039;
        }
    }
  }
</style>

