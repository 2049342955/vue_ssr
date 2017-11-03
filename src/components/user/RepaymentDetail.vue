<template>
  <section class="message_detail">
    <h2>还款管理</h2>
    <h3>分期详情</h3>
    <div class="data">
     <ul>
       <li>
         <h4>{{moneydata.title}}</h4>
         <p>算力服务器</p>
       </li>
       <li>
         <h4>{{moneydata.money}} <span>元</span></h4>
         <p>分期金额</p>
       </li>
       <li>
         <h4>{{moneydata.lv}} <span>%</span></h4>
         <p>手续费率</p>
       </li>
       <li style="border-right:0;">
         <h4>{{moneydata.year}} <span> 年 </span>{{moneydata.month}}<span> 月 </span>{{moneydata.day}}<span> 日 </span></h4>
         <p>分期时间</p>
       </li>
     </ul>
     <ol>
       <li v-for="n,k in monrynav">
         {{n[0]}} : <span>{{n[1]}}</span>
       </li>
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
    <div class="button">
      <div class="opaction">
        <h4>确认还款<span>x</span></h4>
        <div class="one">
          <label>还款方式</label>
          <select>
            <option>算力收益</option>
          </select>
        </div>
        <div class="one">
          <label>还款总额</label>
          <input type="text" value="0.0024562 btc"/>
        </div>
        <div class="one">
          <label>交易密码</label>
          <input type="password" placeholder="请输入交易密码"/>
        </div>
        <button>提交</button>
      </div>
    </div>
  </section>
</template>

<script>
  // import util from '@/util'
  // import api from '@/util/function'
  // import { mapState } from 'vuex'
  export default {
    data () {
      return {
        data: {type: ['算力类型', 'BTC'], num: ['购买数量', '100 * 1台 = 10台'], time: ['购买日期', '2017-09-12 18:00'], money: ['购买金额', '10 * 9000.00元 = 90000.00元'], shou: ['收益方式', '每日结算，次日发放'], all: ['总算力', '90T'], fu: ['服务器类型', '阿瓦隆'], address: ['所在区域', '']},
        moneydata: {title: '阿瓦隆1号矿机', money: '10000.00', lv: '15', year: '2017', month: '06', day: '22'},
        monrynav: {'0': ['分期期限', '12个月'], '1': ['预期时间', '20天'], '2': ['逾期罚息', '0.00']}
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
    .button{
      width: 100%;
      height: 100%;
      position: fixed;
      background:rgba(0,0,0,.2);
      top:0;
      left:0;
    }
    .button .opaction{
      width: 476px;
      height: 380px;
      background: white;
      position: absolute;
      left: 50%;
      top:50%;
      margin-left:-238px;
      margin-top:-190px;
      h4{
        width: 100%;
        margin-top: 29px;
        font-size: 18px;
        text-align: center;
        span{
          position: absolute;
          right: 0;
          margin-right: 42px;
          font-family: cursive;
        }
      }
      .one{
        width: 100%;
        padding:70px;
        box-sizing: border-box;
        label{
          display:inline-block;
          width: 70px;
          font-size: 16px;
          height: 28px;
        }
        input{
          width: 250px;
          height: 28px;
          border:1px solid #999;
        }
      }
    }
  }
</style>
