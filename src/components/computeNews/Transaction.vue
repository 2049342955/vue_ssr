<template>
  <div class="transaction">
    <div class="compute_news_nav">
      <div class="compute_news_box">
        <router-link :to="n.path" v-for="n, k in computationallist" :key="k">{{n.title}}</router-link>
      </div>
    </div>
    <div class="transaction_img">
    </div>
    <div class="transaction_all">
      共有<span>122</span>条交易信息
    </div>
    <div class="transaction_lists">
      <div class="transaction_list" v-for="n,k in lists">
        <div class="transaction_left">
          <h2><span>【{{n.status}}】</span>{{n.title}}</h2>
          <p class="text">{{n.info}}</p>
          <p class="address">{{n.address}}</p>
          <p class="time">{{n.time}} 小时前 / {{n.dian}} / {{n.news}}</p>
        </div>
        <div class="transaction_right">
          <div class="mobile">
            <span><img src="../../assets/images/dian.png"/></span>
            {{n.mobile|format}}
          </div>
          <button>点击查看完整号码</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import api from '@/util/function'
  export default {
    data () {
      return {
        computationallist: [{title: '算力资讯', path: '/computeNews/list'}, {title: '设备之家', path: '/equipments/list'}, {title: '交易信息', path: '/transaction'}, {title: '挖矿币种', path: '/digitalCurrency/list'}, {title: '电场矿场', path: '/computational/electric'}],
        lists: [{status: '转让', title: '蚂蚁1月份机子s913.5T带官电，现开始对外接单', info: '蚂蚁s913.5T带官电发货的机子现在开始正式接受预订了，余货不多，先到先得，全款发货，定金自提', address: '福建省 - 福州市', time: '3', dian: '蚂蚁', news: '全新', mobile: '17682446028'}]
      }
    },
    filters: {
      format: api.telReadable,
      date: api.date
    }
  }
</script>

<style lang="scss" scoped>
  .transaction{
    width: 100%;
    overflow: hidden;
    margin:0 auto;
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
    .transaction_img{
      width: 100%;
      height: 410px;
      background-image: url('../../assets/images/ji.png');
      background-size: 100% 100%;
    }
    .transaction_all{
        width: 1180px;
        height: 40px;
        border:1px solid #f2e5d2;
        margin:0 auto;
        position: relative;
        top: -20px;
        box-sizing: border-box;
        background: #fbfaf5;
        padding-left: 20px;
        line-height: 40px;
        color:#999999;
        font-size: 12px;
        box-shadow: #999 0 0 10px;
        span{
            color:#fe5039;
            font-weight: 800;
            margin:0 5px;
            font-size: 16px;
        }
    }
    .transaction_lists{
      width: 1180px;
      height: auto;
      padding-bottom:29px;
      margin: 0 auto;
      .transaction_list{
          width: 100%;
          height: 150px;
          box-shadow: #999 0 0 10px;
          background:white;
          .transaction_left{
              width: 75%;
              float: left;
              height: 100%;
              padding-top: 20px;
              padding-left: 20px;
              h2{
                  font-size: 16px;
                  color: #333333;
                  margin-bottom: 7px;
                  span{
                      color: #fe5039;
                      margin-right: 12px;
                  }
              }
              .text{
                  font-size: 14px;
                  color:#999999;
                  width: 626px;
                  white-space: nowrap;
                  text-overflow: ellipsis;
                  overflow: hidden;
                  margin-bottom: 7px;
              }
              .address{
                  font-size: 14px;
                  color:#999999;
                  margin-bottom: 7px;
              }
              .time{
                  font-size: 14px;
                  color: #333333;
              }
          }
          .transaction_right{
              text-align: right;
              float: right;
              width: 266px;
              margin-right: 17px;
              margin-top: 28px;
              .mobile{
                  width: 266px;
                  height: 38px;
                  border:1px solid #dcdcdc;
                  line-height: 38px;
                  text-align: center;
                  color: #666;
                  font-weight: 800;
                  font-size: 18px;
                  span{
                    display:inline-block;
                    width: 38px;
                    height: 100%;
                    background: #fe5039;
                    border-right:1px solid #dcdcdc;
                    float: left;
                    img{
                      width: 24px;
                      height: 24px;
                      position: relative;
                      top: -8px;
                    }
                  }
              }
              button{
                  width: 266px;
                  height: 38px;
                  background: #fe5039;
                  font-size: 16px;
                  color: white;
                  border:0;
                  margin-top: 18px;
              }
          }
      }
    }
  }
</style>

