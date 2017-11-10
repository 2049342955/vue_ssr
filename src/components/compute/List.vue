<template>
  <div class="activity_list">
    <div class="and">
      <h1>
        <span class="left">云矿机挖机</span>
        <span class="p">PK</span>
        <span class="right">自己挖机</span>
      </h1>
      <ul>
        <li v-for="n,k in item">
          <span class="left">{{n.left}}</span>
          <span class="con"><i>{{n.con}}</i></span>
          <span class="right">{{n.right}}</span>
        </li>
       </ul>
    </div>
    <div class="res">
      <h2>云矿机购买记录</h2>
      <div class="table">
        <ul class="thead">
            <li v-for="n,k in res">{{n}}</li>
        </ul>
        <ul class="tbody">
          <li v-for="n,k in reslist">
            <span>{{n.name}}</span>
            <span>{{n.num}}</span>
            <span>{{n.price}} 元</span>
            <span>{{n.time}}</span>
            <span>{{n.status}}</span>
          </li>
        </ul>
      </div>
    </div>
    <div class="info">
      <div class="mainone" v-for="n, k in info">
        <div class="left">
          <img src="../../assets/images/header.png" class="header"/>
          <!-- <img src="../../assets/images/color.png" class="index"/> -->
          <h5>{{n.name}}</h5>
          <p>{{n.time}}</p>
        </div>
        <div class="right">{{n.content}}</div>
      </div>
      <div class="button">
        <button style="margin-right:7px;"><img src="../../assets/images/leftjian.png" class="trans"/></button>
        <button><img src="../../assets/images/leftjian.png"/></button>
      </div> 
    </div>
  </div>
</template>

<script>
  export default {
    data () {
      return {
        item: [{left: '规模化部署，专业的散热设备，远离运行噪音，使用低价合规电。', con: '运行', right: '在家运行占空间，又会产生大量的噪音和热量，家用电的成本也是不小的开支。'}, {left: '基础设施全方位提供服务。', con: '配套', right: '需要自己购买专用电源、控制组件和矿机支架等。'}, {left: 'T专业人员进行配置、维护。', con: '软件', right: '组装矿机后需要专业的软件支持，对于新人需要付出一定的学习成本。'}, {left: '出现问题平台负责解决，并安排专业人员进行维修。', con: '维修', right: '一旦矿机出现问题，需要自行解决维修问题，挖矿停止，将会造成一定的损失。'}],
        res: ['用户名', '购买数量', '购买金额', '购买时间', '状态'],
        reslist: [{name: '15570150173', num: '12台', price: '2259986.00', time: '2017-11-11 08:30:87', status: '抢购成功'}, {name: '15570150173', num: '12台', price: '2259986.00元', time: '2017-11-11 08:30:87', status: '抢购成功'}, {name: '15570150173', num: '12台', price: '2259986.00元', time: '2017-11-11 08:30:87', status: '抢购成功'}, {name: '15570150173', num: '12台', price: '2259986.00元', time: '2017-11-11 08:30:87', status: '抢购成功'}, {name: '15570150173', num: '12台', price: '2259986.00元', time: '2017-11-11 08:30:87', status: '抢购成功'}],
        info: [{url: '../../assets/images/header.png', name: '高新技术主管', time: 'Shsx jsxk ', content: ' 比特币的价格今年迄今为止的涨幅已达600%以上，目前的交易价格接近每枚7200美元，今后可能会涨至8000美元。但这将是它最后一个高点，至少一段时间内是如此。比特币自突破6044美元以来，显示出强劲的涨势。下一重点关注7941美元，再进一步走高前可能在该水平整固。”'}]
      }
    }
  }
</script>

<style lang="scss">
  .activity_list{
    .and{
      width: 1180px;
      overflow: hidden;
      padding-top: 29px;
      margin: 0 auto;
      margin-bottom: 60px;
    }
    h1{
      margin-bottom: 14px;
      width: 100%;
      overflow: hidden;
    }
    h1 span{
      text-align: center;
      font-size: 26px;
      display: inline-block;
      float: left;
    }
    h1 .left{
      color: #ff9b01;
      width: 566px;
    }
    h1 .p{
      color: white;
      font-size: 32px;
      font-weight: 800;
    }
    h1 .right{
      color: white;
      width: 566px;
    }
    .and ul{
      width: 100%;
    }
    .and ul li{
      margin-bottom: 1px;
      position: relative;
      box-sizing: border-box;
      width: 100%;
      overflow: hidden;
    }
    .and ul .left{
      width: 50%;
      height: 102px;
      background: #2c1963;
      text-align: center;
      float: left;
      display: inline-block;
      line-height: 92px;
      box-sizing: border-box;
      border:4px solid #966cff;
      color: white;
      font-size:16px;
    }
    .and ul .con{
      position: absolute;
      width: 80px;
      height: 80px;
      top:11px;
      display: inline-block;
      left:550px;
      border:10px solid #151136;
      border-radius: 100%;
      text-align: center;
      box-sizing: border-box;
    }
    .and ul .con i{
      width: 60px;
      height: 60px;
      border-radius: 100%;
      background: #ff9b01;
      display: inline-block;
      text-align: center;
      line-height: 60px;
      color: white;
      font-size: 16px;
    }
    .and ul .right{
      width: 50%;
      height: 102px;
      background: #917cce;
      text-align: left;
      font-size: 20px;
      float: left;
      padding:28px;
      padding-left: 69px;
      padding-top: 25px;
      display: inline-block;
      box-sizing: border-box;
      border:4px solid #cbbaff;
      color: white;
      font-size:16px;
    }
    .res{
      width: 1180px;
      overflow: hidden;
      margin: 0 auto;
      margin-bottom: 58px;
    }
    .res h2{
      color: #ff9b01;
      font-size: 26px;
      text-align: center;
      width: 100%;
      margin-bottom: 35px;
    }
    .res .table{
      width: 100%;
      background: url('../../assets/images/bgbig.png') no-repeat left center;
      height: 480px;
      box-sizing: border-box;
      border-collapse: inherit
    }
    .res .table .thead{
      width: 100%;
    }
    .res .table .thead li{
      width: 20%;
      height: 58px;
      font-size: 15px;
      color: #ff9b01;
      line-height: 58px;
      text-align: center;
      float: left;
    }
    .res .table .tbody{
      width: 100%;
      overflow-y: auto;
      height: 416px;
      padding-top: 27px;
    }
    .res .table .tbody li{
      float: left;
      height: 47px;
      width: 100%;
      text-align: center;
      color: white;
      font-size: 13px;
    }
    .res .table .tbody li span{
      width: 20%;
      display:inline-block;
      float: left;
    }
    .info{
      width: 1180px;
      overflow: hidden;
      margin:0 auto;
      background: url('../../assets/images/bigbg1.png');
      background-size: 100% 100%;
      height: 398px;
      margin-bottom: 40px;
      position: relative;
      .left{
        position: absolute;
        top:66px;
        left:112px;
        width: 160px;
        text-align: center;
        .index{
        width: 190px;
        height: 202px;
        border-radius: 100%;
        position: absolute;
        top:-10px;
        left:-20px;
        }
        .header{
          background: url('../../assets/images/color.png');
          width: 160px;
          height: 160px;
          border-radius: 100%;
        }
        h5{
          color: white;
          font-size: 15px;
          margin-top: 55px;
        }
        p{
          color: white;
          font-size: 15px;
          margin-top: 5px;
        }
      }
      .right{
        width: 740px;
        height: 117px;
        position: absolute;
        right: 100px;
        top:157px;
        color: white;
        font-size: 15px;
        line-height: 30px;
      }
      .button{
        position: absolute;
        right: 100px;
        bottom: 63px;
        button{
          width: 30px;
          height: 40px;
          border-radius: 3px;
          background: #6151ae;
          border:0;
          img{
            width: 10px;
            height: 11px;
            position: relative;
            top: -3px;
          }
        }
        .trans{
          transform: rotate(180deg);
          
        }
      }
    }
  }
</style>
