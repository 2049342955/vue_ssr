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
        <div class="scroll">
          <ul class="tbody table_list1">
            <li v-for="n,k in reslist">
              <span>{{n.mobile|format}}</span>
              <span>{{n.ammount}} 台</span>
              <span>{{n.pay_value}} 元</span>
              <span>{{n.buy_time.split(" ")[0]}} {{n.buy_time.split(" ")[1].split("-")[0]}} : {{n.buy_time.split(" ")[1].split("-")[1]}} : {{n.buy_time.split(" ")[1].split("-")[2]}}</span>
              <span>{{n.status}}</span>
            </li>
          </ul>
          <ul class="tbody table_list2">
            <li v-for="n,k in reslist2">
              <span>{{n.mobile|format}}</span>
              <span>{{n.ammount}} 台</span>
              <span>{{n.pay_value}} 元</span>
              <span>{{n.buy_time.split(" ")[0]}} {{n.buy_time.split(" ")[1].split("-")[0]}} : {{n.buy_time.split(" ")[1].split("-")[1]}} : {{n.buy_time.split(" ")[1].split("-")[2]}}</span>
              <span>{{n.status}}</span>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="info">
      <Swiper :pagination-visible="true" :loop="true" :autoPlay="5000" :data="info" oneWidth="1070" :button="true" :paginationVisiable="false"></Swiper>
      <!-- <el-carousel :interval="5000" arrow="always" height="500px">
        <el-carousel-item class="swiper_one" v-for="n, k in info" :key="item">
          <div class="left">
            <img src="../../assets/images/header.png" class="header"/>
            <img src="../../assets/images/color.png" class="index"/> 
            <h5>{{n.name}}</h5>
            <p>{{n.time}}</p>
          </div>
          <div class="right">{{n.content}}</div>
        </el-carousel-item>
      </el-carousel> -->
    </div>
  </div>
</template>
<script>
  import api from '../../util/function'
  import util from '../../util'
  import Swiper from '../../components/common/Swipe'
  import { mapState } from 'vuex'
  export default {
    components: {
      Swiper
    },
    data () {
      return {
        item: [{left: '规模化部署，专业的散热设备，远离运行噪音，使用低价合规电。', con: '运行', right: '在家运行占空间，又会产生大量的噪音和热量，家用电的成本也是不小的开支。'}, {left: '基础设施全方位提供服务。', con: '配套', right: '需要自己购买专用电源、控制组件和矿机支架等。'}, {left: 'T专业人员进行配置、维护。', con: '软件', right: '组装矿机后需要专业的软件支持，对于新人需要付出一定的学习成本。'}, {left: '出现问题平台负责解决，并安排专业人员进行维修。', con: '维修', right: '一旦矿机出现问题，需要自行解决维修问题，挖矿停止，将会造成一定的损失。'}],
        res: ['用户名', '购买数量', '购买金额', '购买时间', '状态'],
        reslist: [],
        reslist2: [],
        pay_value: '',
        info: [{url: '../../assets/images/header.png', name: '高新技术主管', time: 'Shsx jsxk ', content: ' 比特币的价格今年迄今为止的涨幅已达600%以上，目前的交易价格接近每枚7200美元，今后可能会涨至8000美元。但这将是它最后一个高点，至少一段时间内是如此。比特币自突破6044美元以来，显示出强劲的涨势。下一重点关注7941美元，再进一步走高前可能在该水平整固。”'}, {url: '../../assets/images/header.png', name: '高新技术主管', time: 'Shsx jsxk ', content: ' 比特币的价格今年迄今为止的涨幅已达600%以上，目前的交易价格接近每枚7200美元，今后可能会涨至8000美元。但这将是它最后一个高点，至少一段时间内是如此。比特币自突破6044美元以来，显示出强劲的涨势。下一重点关注7941美元，再进一步走高前可能在该水平整固。”'}],
        t: ''
      }
    },
    mounted () {
      var self = this
      util.post('showBuyList', {sign: api.serialize({token: this.token})}).then(function (res) {
        api.checkAjax(self, res, () => {
          self.reslist = res
          var box = document.querySelector('.scroll')
          var list1 = document.querySelector('.table_list1')
          if (self.reslist.length > 10) {
            self.reslist2 = res
            self.goTop(box, list1)
            box.onmouseover = function () {
              clearInterval(self.t)
            }
            box.onmouseout = function () {
              self.goTop(box, list1)
            }
          }
        })
      })
    },
    methods: {
      goTop (box, list1) {
        this.t = setInterval(() => {
          box.scrollTop ++
          if (box.scrollTop >= list1.offsetHeight) {
            box.scrollTop = 0
          }
        }, 50)
      }
    },
    destoryed () {
      clearInterval(this.t)
    },
    computed: {
      ...mapState({
        token: state => state.info.token
      })
    },
    filters: {
      format: api.telReadable
    }
  }
</script>
<style lang="scss">
  @import '../../assets/css/style.scss';
  .activity_list{
    .and{
      width: 1180px;
      overflow: hidden;
      padding-top: 29px;
      margin: 0 auto;
      margin-bottom: 60px;
      h1{
        margin-bottom: 14px;
        width: 100%;
        overflow: hidden;
        span{
          text-align: center;
          font-size: 26px;
          display: inline-block;
          float: left;
        }
        .left{
          color: #ff9b01;
          width: 566px;
        }
        .p{
          color: white;
          font-size: 32px;
          font-weight: 800;
        }
        .right{
          color: white;
          width: 566px;
        }
      }
      ul{
        width: 100%;
        position: relative;
        transition: all ease;
        height: 416px;
        li{
          margin-bottom: 1px;
          position: relative;
          box-sizing: border-box;
          width: 100%;
          overflow: hidden;
        }
        .left{
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
        .con{
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
          i{
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
        }
        .right{
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
      }
    }
    .res{
      width: 1180px;
      overflow: hidden;
      margin: 0 auto;
      margin-bottom: 58px;
      h2{
        color: #ff9b01;
        font-size: 26px;
        text-align: center;
        width: 100%;
        margin-bottom: 35px;
      }
      .table{
        width: 100%;
        background: url('../../assets/images/bgbig.png') no-repeat left center;
        height: 480px;
        overflow: hidden;
        box-sizing: border-box;
        border-collapse: inherit;
        .thead{
          width: 100%;
          li{
            width: 20%;
            height: 58px;
            font-size: 15px;
            color: #ff9b01;
            line-height: 58px;
            text-align: center;
            float: left;
          }
        }
        .scroll{
          height: 416px;
          overflow: hidden;
          width: 100%;
          padding-top:15px;
          .tbody{
            overflow: hidden;
            li{
              float: left;
              height: 40px;
              line-height: 40px;
              width: 100%;
              text-align: center;
              color: white;
              font-size: 13px;
              span{
                width: 20%;
                display:inline-block;
                float: left;
              }
            }
          }
        }
      }
    }
    .info{
      @include main
      overflow: hidden;
      background: url('../../assets/images/bigbg1.png');
      background-size: 100% 100%;
      height: 398px;
      margin-bottom: 40px;
      position: relative;
      padding:0 65px;
      .swiper_one{
        position:relative;
        height:500px;
        .left{
          position: absolute;
          top:66px;
          left:42px;
          width: 160px;
          text-align: center;
          .index{
          width: 190px;
          height: 202px;
          border-radius: 100%;
          position: absolute;
          top: -14px;
          left: -15px;
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
          height: 117px;
          position: absolute;
          right: 60px;
          left:270px;
          top:157px;
          color: white;
          font-size: 15px;
          line-height: 30px;
        }
      }
      .swiper-pagination{
        bottom:160px;
      }
      .prev,.next{
        position:absolute;
        bottom:160px;
        border-radius: 3px;
        font-family: "宋体";
        background: #6151ae;
        width: 30px;
        height: 40px;
        text-align: center;
        line-height: 40px;
        color:#fff;
        cursor: pointer;
        &:hover{
          opacity: .7
        }
      }
      .prev{
        right:110px;
      }
      .next{
        right:60px;
      }
    }
  }
</style>
