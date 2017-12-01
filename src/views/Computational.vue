<template>
  <div class="computational">
    <div class="computational_nav">
      <div class="computational_box">
        <router-link :to="n.path" v-for="n, k in computationallist">{{n.title}}</router-link>
      </div>
    </div>
    <div class="computational_content">
      <router-view class="computational_text"></router-view>
    </div>
  </div>
</template>

<script>
  export default {
    data () {
      return {
        computationallist: [{title: '算力资讯', path: '/computational/ComInfor'}, {title: '设备之家', path: '/computational/NewsFlash'}, {title: '交易信息', path: '/computational/transaction'}, {title: '挖矿币种', path: '/computational/currency'}, {title: '电场矿场', path: '/computational/electric'}]
      }
    }
  }
</script>

<style lang="scss" scoped>
  .computational{
    background: #eceff8;
    width: 100%;
    overflow: hidden;
    .computational_nav{
      width: 100%;
      height: 50px;
    //   margin-top: 80px;
      z-index: 999999;
      position: absolute;
      top:80px;
      background: white;
      .computational_box{
        width: 1180px;
        margin:0 auto;
        height: 50px;
        line-height: 50px;
        box-sizing: border-box;
        a{
          display:inline-block;
          width: 64px;
          height: 50px;
          box-sizing: border-box;
          text-align: center;
          margin-right: 34px;
          color: #666666;
          font-size: 14px;
          border-top: 2px solid white;
          &:hover{
            color:#327fff;
            height: 50px;
            box-sizing: border-box;
            border-top: 2px solid #327fff;
          }
          &.router-link-active{
            color:#327fff;
            height: 50px;
            box-sizing: border-box;
            border-top: 2px solid #327fff;
          }
        }
      }
    }
  }
</style>

