<template>
  <div class="currency">
    <div class="compute_news_nav">
      <div class="compute_news_box">
        <router-link :to="n.path" v-for="n, k in computationallist" :class="{'active': k === 2}" :key="k">{{n.title}}</router-link>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data () {
    return {
      computationallist: [{title: '算力资讯', path: '/industryInformation'}, {title: '设备之家', path: '/equipments/list'}, {title: '交易信息', path: '/transaction'}, {title: '挖矿币种', path: '/Currency'}, {title: '电场矿场', path: '/computational/electric'}]
    }
  }
}
</script>

<style lang="scss" scoped>
  .currency{
    background: #eceff8;
    width: 100%;
    overflow: hidden;
    .compute_news_nav{
      width: 100%;
      height: 50px;
      background: white;
			border-top: 1px solid #e5e5e5;
      .compute_news_box{
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
					&.active{
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
