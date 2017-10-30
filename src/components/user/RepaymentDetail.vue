<template>
  <section class="message_detail">
    <h2>还款管理</h2>
    <h3>分期详情</h3>
    <div class="data">
     <ul>
       <li>
         <h4>阿瓦隆1号矿机</h4>
         <p>算力服务器</p>
       </li>
       <li>
         <h4>10000.00 <span>元</span></h4>
         <p>分期金额</p>
       </li>
       <li>
         <h4>15 <span>%</span></h4>
         <p>手续费率</p>
       </li>
       <li style="border-right:0;">
         <h4>2017 <span> 年 </span>09<span> 月 </span>12<span> 日 </span></h4>
         <p>分期时间</p>
       </li>
     </ul>
     <ol>
       <li>分期期限 ：<span>12个月</span></li>
       <li>预期时间 ：<span>00天</span></li>
       <li>逾期罚息 ：<span>0.00</span></li>
       <li><router-link to="javascript:;" style="color:#327fff;">查看计算公式</router-link></li>
     </ol>
     <div class="table">
       <div class="item" v-for="n,k in data">
         <div class="title">{{n[0]}}</div>
         <div class="value">{{n[1]}}</div>
       </div>
     </div>
    </div>
    <router-link to="javascript:;" class="submit">提前还款</router-link>
  </section>
</template>

<script>
  // import util from '@/util'
  // import api from '@/util/function'
  // import { mapState } from 'vuex'
  export default {
    data () {
      return {
        data: {type: ['算力类型', 'BTC'], num: ['购买数量', '100 * 1台 = 10台'], time: ['购买日期', '2017-09-12 18:00'], money: ['购买金额', '10 * 9000.00元 = 90000.00元'], shou: ['收益方式', '每日结算，次日发放'], all: ['总算力', '90T'], fu: ['服务器类型', '阿瓦隆'], address: ['所在区域', '']}
      }
    }
  }
</script>

<style type="text/css" lang="scss">
  @import '../../assets/css/style.scss';
  .message_detail{
    padding:0 15px;
    h2{
      padding:0 15px !important;
    }
    .data{
      width: 100%;
      padding:20px 10px 0;
      ul{
        width: 100%;
        height: 104px;
        background: #fff9f3;
        padding-top:28px;
        box-sizing: border-box;
        li{
          width: 25%;
          float: left;
          height: 50px;
          border-right:1px solid #e5e5e5;
          text-align:center;
          h4{
            font-size:18px;
            color:black;
            span{
              font-size: 14px;
            }
          }
          p{
            color: #999999;
          }
        }
      }
      ol{
        width: 100%;
        border:1px solid #eeeeee;
        height: 54px;
        box-sizing: border-box;
        li{
          width: 25%;
          float: left;
          line-height: 54px;
          text-align: center; 
          color: #999999;
          span{
            color: black;
          }
        }
      }
      .table{
        width: 100%;
        margin-top: 118px;
        border:1px solid #d2e9ff;
        border-bottom:0;
        border-right:0;
        box-sizing: border-box;
        overflow: hidden;
        .item{
          width: 50%;
          float: left;
          box-sizing: border-box;
          border-bottom:1px solid #d2e9ff;
          border-right:1px solid #d2e9ff;
          height: 40px;
          line-height:40px;
          text-align:center;
          .title{
            float: left;
            width: 164px;
            border:1px solid #d2e9ff;
            height: 40px;
            border-left:0;
            border-top:0;
            background-color: rgba(240,247,253,1);
            font-size: 16px;
            color: black;
            box-sizing: border-box;
          }
          .value{
            font-size: 16px;
            color:#666666;
          }
        }
      }
    }
    .submit{
      width: 86px;
      height: 34px;
      background: #327fff;
      font-size:12px;
      text-align:center;
      float:right;
      margin-top: 23px;
      color: white;
      line-height: 34px;
      margin-bottom: 125px;
      border-radius: 5px;
      margin-right:10px;
    }
  }
</style>
