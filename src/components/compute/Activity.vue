<template>
  <div class="content">
    <div class="top">
    </div>
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
      <table>
        <thead>
          <tr>
            <th v-for="n,k in res">{{n}}</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="n,k in reslist">
            <td>{{n.name}}</td>
            <td>{{n.num}}</td>
            <td>{{n.price}}</td>
            <td>{{n.time}}</td>
            <td>{{n.status}}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div>
  <el-button>默认按钮</el-button>
  <el-button type="primary">主要按钮</el-button>
  <el-button type="success">成功按钮</el-button>
  <el-button type="info">信息按钮</el-button>
  <el-button type="warning">警告按钮</el-button>
  <el-button type="danger">危险按钮</el-button>
</div>
  </div>
</template>

<script>
  export default {
    name: 'content',
    data () {
      return {
        item: [{left: '规模化部署，专业的散热设备，远离运行噪音，使用低价合规电。', con: '运行', right: '在家运行占空间，又会产生大量的噪音和热量，家用电的成本也是不小的开支。'}, {left: '基础设施全方位提供服务。', con: '配套', right: '需要自己购买专用电源、控制组件和矿机支架等。'}, {left: 'T专业人员进行配置、维护。', con: '软件', right: '组装矿机后需要专业的软件支持，对于新人需要付出一定的学习成本。'}, {left: '出现问题平台负责解决，并安排专业人员进行维修。', con: '维修', right: '一旦矿机出现问题，需要自行解决维修问题，挖矿停止，将会造成一定的损失。'}],
        res: ['用户名', '购买数量', '购买金额', '购买时间', '状态'],
        reslist: [{name: '15570150173', num: '12台', price: '2259986.00元', time: '2017-11-11 08:30:87', status: '抢购成功'}]
      }
    }
  }
</script>

<style>
  *{
    padding:0;
    margin:0;
  }
  .top{
    width: 100%;
    height: 300px;
    background: red;
  }
  .content{
    width: 100%;
    min-height:700px;
    overflow: hidden;
    background: #151136;
  }
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
  .and ul li:nth-of-type(2) .right{
    padding-top: 33px;
    text-align: center;
  }
  .and ul li:nth-of-type(2) .con{
    top:113px;
  }
  .and ul li:nth-of-type(3) .con{
    top:213px;
  }
  .and ul li:nth-of-type(4) .con{
    top:318px;
  }
  .res{
    width: 1180px;
    overflow: hidden;
    margin: 0 auto;
  }
  .res h2{
    color: #ff9b01;
    font-size: 26px;
    text-align: center;
    width: 100%;
    margin-bottom: 35px;
  }
  .res table{
    width: 100%;
    background: url('../../assets/images/bg3.jpg') no-repeat left center;
    overflow: hidden;
    padding:5px;
    box-sizing: border-box;
  }
  .res table thead{
    width: 100%;
    background: url('../../assets/images/bg1.jpg'); 
  }
  .res table thead tr{
    width: 100%;
    height: 58px;
    background-size: 100% 100%;
    z-index:-1;
  }
  .res table thead tr th{
    width: 20%;
    text-align: center;
    font-size: 14px;
    color: #ff9b01;
  }
  .res table tbody{
    background: url('../../assets/images/bg2.jpg'); 
    width: 100%;
    overflow: hidden;
    background-size: 100% 100%;
  }
  .res table tbody td{
    padding-top: 27px;
    padding-bottom: 49px;
    text-align: center;
    color: white;
    font-size: 12px;
  }
  .res table tbody tr{
    margin-bottom:30px;
  }
</style>
