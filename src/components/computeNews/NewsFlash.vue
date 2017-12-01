<template>
  <div class="news_left">
    <h1><span>算力资讯</span></h1>
    <div class="scroll_news">
      <div class="news_lists" v-for="n, k in newslists">
        <span class="icon iconfont icon-yinhao"></span>
        <h4>【{{n.title}}】<span>{{n.time}}</span></h4>
        <p>{{n.text}}</p>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    data () {
      return {
        newslists: [{title: '市场基本首都机场上档次三等奖承诺书电厂上档次你打开上次你说电厂打算充年开始调查你的身材', text: '打算充不是的基础上的厂商电厂金卡戴珊半年才看见你上档次上档次跨境电商才能看见滴水穿石的抽点时间承诺书扩大基础能刷到吃大餐你开电脑充多少', time: '2017-11-29 13:57:24'}, {title: '市场基本首都机场上档次三等奖承诺书电厂上档次你打开上次你说电厂打算充年开始调查你的身材', text: '打算充不是的基础上的厂商电厂金卡戴珊半年才看见你上档次上档次跨境电商才能看见滴水穿石的抽点时间承诺书扩大基础能刷到吃大餐你开电脑充多少', time: '2017-11-29 13:57:24'}]
      }
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
          }
        }
        p{
          color: #a9a9a9;
          height: 42px;
          overflow: hidden;
          line-height: 22px;
        }
      }
    }
  }
</style>

