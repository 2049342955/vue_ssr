<template>
  <div class="compute_news">
    <div class="compute_news_nav">
      <div class="compute_news_box">
        <router-link :to="n.path" v-for="n, k in computationallist">{{n.title}}</router-link>
      </div>
    </div>
    <div class="computational_content">
	    <div class="currency_header">suanLi&nbsp;&nbsp;之家 <span>主流 · 测评 · 博物馆</span></div>
	    <div class="currency_content">
	      	<div class="leftnav">
			      <div class="leftnav_ol" v-for="n, k in leftnav">
			        <router-link :to="n.path">
			          <span :class="['icon', 'iconfont', n.big]"></span>
			          <i>{{n.title}}</i>
			        </router-link>
			      </div>
			    </div>
		       <router-view class="currency_right"></router-view>
	      </div>
	    </div>
    </div>
  </div>
</template>

<script>
  export default {
    data () {
      return {
        computationallist: [{title: '算力资讯', path: '/industryInformation'}, {title: '设备之家', path: '/equipments/list'}, {title: '交易信息', path: '/transaction'}, {title: '挖矿币种', path: '/digitalCurrency/list'}, {title: '电场矿场', path: '/computational/electric'}],
        leftnav: [{big: 'icon-zixun1', title: '快讯', path: '/quickNews/list'}, {big: 'icon-kuangji', title: '测评', path: '/equipmentEvaluate/list'}, {big: 'icon-zixun', title: '行业', path: '/computeNews/list'}, {big: 'icon-bitebi', title: '币种', path: '/digitalCurrency/list'}, {big: 'icon-bowuguan', title: '博物馆', path: '/equipments/list'}, {big: 'icon-zhizaohangye', title: '厂商', path: '/manufacturer/list'}, {big: 'icon-dianlishebei', title: '电厂', path: ''}]
      }
    }
  }
</script>

<style lang="scss" scoped>
  .compute_news{
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
          &.router-link-active{
            color:#327fff;
            height: 50px;
            box-sizing: border-box;
            border-top: 2px solid #327fff;
          }
        }
      }
    }
    .computational_content{
    	width: 100%;
	    min-height: 1562px;
	    background: #303849;
	    .currency_header{
	      width: 1180px;
	      height: 84px;
	      line-height: 84px;
	      margin:0 auto;
	      font-size: 29px;
	      color: white;
	      font-weight: 800;
	      span{
	        font-size: 15px;
	        color: #999999;
	        font-weight: 100;
	        margin-left: 20px;
	      }
	    }
	    .currency_content{
	      width: 1180px;
	      margin:0 auto;
	      overflow: hidden;
	      .leftnav{
			    width: 70px;
			    height: 1425px;
			    background: #1c202a;
			    float: left;
			    .leftnav_ol{
			      width: 100%;
			      height: 68px;
			      text-align: center;
			      box-sizing: border-box;
						a{
							display: block;
							padding-top: 10px;
							width: 100%;
							height: 100%;
						}
			      span{
			        font-size:22px;
			        height: 22px;
			        margin-bottom: 9px;
			        color:#999999;
			        display:block;
			      }
			      i{
			        font-size: 12px;
			        color:#999;
			      }
			      &:hover{
			        background: #327fff;
			        span{
			          color:white;
			        }
			        i{
			          color:white;
			        }
			      }
						.router-link-active{
							background: #327fff;
			        span{
			          color:white;
			        }
			        i{
			          color:white;
			        }
						}
			    }
			  }
	      .currency_right{
	        float: left;
	        width: 1002px;
	        background: white;
	        padding:32px 62px 0 62px;
	        box-sizing: border-box;
	      }
	    }
    }
  }
</style>

