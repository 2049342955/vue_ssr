<template>
  <section class="product">
    <div class="top_nav">
      <div class="box">
        <router-link to="/minerShop/list">矿机商城</router-link>
        <span>></span>
        <router-link to="/minerShop/miner/1/all" v-if="$route.params.type==='1'">矿机</router-link>
        <router-link to="/minerShop/miner/2/all" v-else>云矿机</router-link>
        <span>></span>
        <em>{{$parent.detail.product_name||$parent.detail.name}}</em>
      </div>
    </div>
    <div class="items miner" v-if="$route.params.type==='1'">
      <div class="miner_type">
        <div class="iconfont">&#xe603;</div>
        <span>矿机</span>
      </div>
      <div class="miner_left">
        <img :src="$parent.detail.minerPicture" alt="">
      </div>
      <div class="miner_right">
        <h4>{{$parent.detail.name}}</h4>
        <p class="time">{{$parent.detail.DeliveryTime}}</p>
        <p class="suan_price"><span class="left_miner">矿 机 价</span><span class="right_miner">¥ <em>{{$parent.detail.one_amount_value}}</em></span></p>
        <p class="address"><span class="left_miner">总 算 力</span><span class="right_miner"><em>{{$parent.totalHash|format}}</em>T</span></p>
        <p class="address"><span class="left_miner">物&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;流</span><span class="right_miner">订单委托第三方物流公司发货，物流费用到付</span></p>
        <div class="miner_input">
          <span class="left_miner">数&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;量</span>
          <div class="input_box right_miner">
            <span @click="$parent.changeNum(+$parent.number-1)" style="cursor:pointer;">-</span>
            <input type="text" v-model="$parent.number" :placeholder="parseInt($parent.detail.single_limit_amount)||1" @blur="$parent.changeNum($parent.number)">
            <span @click="$parent.changeNum(+$parent.number+1)"  style="cursor:pointer;">+</span>
          </div>
          <p class="miner_number">库存{{$parent.leftNum}}台<span>({{parseInt($parent.detail.single_limit_amount)||1}}台起售)</span></p>
        </div>
        <button :class="['btn buy_btn', {error: $parent.buyStatus===1}, {over: $parent.buyStatus===2}]" v-if="$parent.detail.status===1" @click="checkPay">立即支付</button>
        <button class="btn" disabled v-else-if="$parent.detail.status===2" style="background:#c3bbba;">已售罄</button>
        <button class="btn" disabled v-else-if="$parent.detail.status===3">产品撤销</button>
      </div>
    </div>
    <div class="items cloud_miner" v-if="$route.params.type!=='1'">
      <div class="miner_type" style="background:#327fff;">
        <div class="iconfont">&#xe610;</div>
        <span>云矿机</span>
      </div>
      <div class="cloud_miner_left">
        <h4>
            {{$parent.detail.product_name}}
            <span>{{$parent.str[$parent.detail.status]}}</span>
        </h4>
        <p class="white">可使用算力白条</p>
        <div class="product_data">
          <template v-for="d,k in proData" v-if="k!=='product_name'">
            <div class="item">
              <div class="item_word">
                <span class="num" v-if="k==='price'">{{$parent.detail[k]|format}}</span>
                <span class="num" v-else>{{$parent.detail[k]}}</span>
                <span class="unit">{{d.unit}}</span>
              </div>
              <p class="tips">{{d.title}}</p>
            </div>
          </template>
        </div>
        <div class="progress_info press">
          <div class="progress_box">
            <div class="box" :style="{width:(parseInt($parent.detail.buyed_amount)/parseInt($parent.detail.amount)*100)+'%'}"></div>
          </div>
        </div>
        <div class="progress_price">
          <span class="one">当前进度 {{((parseInt($parent.detail.buyed_amount)/parseInt($parent.detail.amount))*100).toFixed(2)}}%</span>
          <span class="two">剩余可售 {{$parent.leftNum}}台</span>
        </div>
      </div>
      <div class="cloud_miner_right">
        <div class="price_text">我要购买<span class="buy_tips">({{parseInt($parent.detail.single_limit_amount)||1}}台起售)</span></div>
        <div class="input_box">
          <input type="text" v-model="$parent.number" :placeholder="parseInt($parent.detail.single_limit_amount)||1" @blur="$parent.changeNum($parent.number)">
          <span>台</span>
        </div>
        <div class="price_text1">需支付：<span class="money">{{$parent.totalPrice|format}}元</span></div>
        <div class="price_text1">总算力：<span class="money">{{$parent.totalHash|format}}T</span></div>
        <button class="btn" disabled v-if="$parent.leftStatus" style="background:#c3bbba;">已售罄</button>
        <button :class="['btn buy_btn', {error: $parent.buyStatus===1}, {over: $parent.buyStatus===2}]" v-else @click="checkPay($event, false)">立即支付</button>
        <button class="btn loan_btn" @click="checkPay($event, true)" v-if="$route.params.type==='2'&&!$parent.leftStatus">分期购买</button>
      </div>
    </div>
    <div class="info">
      <template v-if="$route.params.type!=='1'">
        <div class="info_ul">
          <div :class="['info_li',{'active': contentShow===k}]" v-for="n,k in infolists" @click="tabs(k)">{{n.title}}</div>
        </div>
        <div class="content_items">
          <template v-for="n,k in infolists">
            <div class="content_item" v-html="$parent.detail[n.name]" v-if="k!==3&&contentShow===k"></div>
            <div class="content_item" v-if="k===3&&contentShow===3">
              <img :src="$parent.detail[n.name]" alt="">
            </div>
          </template>
        </div>
      </template>
      <template v-else>
        <div class="info_ul">
          <div :class="['info_li',{'active': contentShow===m}]" v-for="d,m in infolist" @click="tabs(m,d.name)">{{d.title}}</div>
        </div>
        <div class="content_items">
          <div class="product_img">
            <div class="pro_name">{{$parent.detail.name}}</div>
            <div class="pro_slogan">{{$parent.detail.miner_list&&$parent.detail.miner_list.slogan}}</div>
            <div class="pro_resume">{{$parent.detail.miner_list&&$parent.detail.miner_list.resume}}</div>
            <img class="pro_img" :src="require('@/assets/images/miner_shop/miner_img.jpg')" alt="">
            <img class="params_img" :src="$parent.detail.ActivityPicture" alt="">
          </div>
          <div class="content_item" :id="d.name" v-for="d,m in infolist">
            <h2 v-if="m!==0">{{d.title}}</h2>
            <div class="content_con" v-html="$parent.detail[d.name]" v-if="d.name!=='MinerAdvantage'"></div>
            <div class="params_table" v-else>
              <table border="1" cellspacing="0">
                <tr v-for="p,k in params">
                  <td>{{p}}</td>
                  <td>{{($parent.detail.miner_list&&$parent.detail.miner_list[k])||$parent.detail[k]}}</td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </template>
    </div>  
    <div class="mobile_box">
      <div class="img">
        <img :src="$parent.detail.product_img||$parent.detail.minerPicture" alt="">
      </div>
      <div class="first_box">
        <h4>{{$parent.detail.product_name}}</h4>
        <div class="base_info">
          <div :class="['item', {mobile_hide:k==='status'&&$route.params.type==='1'}]" v-for="n,k in mobileNav1">
            <div class="item_data">{{k==='status'?$parent.str[$parent.detail[k]]:$parent.detail[k]}}<span>{{n.unit}}</span></div>
            <div class="item_text">{{n.title}}</div>
          </div>
        </div>
        <div class="progress_info">
          <div class="progress_box">
            <div class="box" :style="{width:((1-$parent.leftNum/$parent.detail.amount)*100).toFixed(1)+'%'}"></div>
          </div>
          <div class="progress_text">
            <div class="item">进度{{((1-$parent.leftNum/$parent.detail.amount)*100).toFixed(1)+'%'}}</div>
            <div class="item">剩余可售台数{{$parent.leftNum}}</div>
          </div>
        </div>
      </div>
      <div class="some_info">
        <div class="item" v-for="n,k in mobileNav2" v-if="!(k === 'incomeType'&&$route.params.type==='1')">
          <span>{{n.title}}</span>
          <span>{{$parent.detail[k]}}{{n.unit}}</span>
        </div>
      </div>
      <div class="product_desc">
        <p class="title">产品介绍</p>
        <div class="product_content" v-html="$parent.detail.machine_intro||$parent.detail.MInerBrief"></div>
        <p class="title">产品优势</p>
        <div class="product_content" v-html="$parent.detail.machine_advantage||$parent.detail.MinerAdvantage"></div>
        <p class="title">补充说明</p>
        <div class="product_content" v-html="$parent.detail.machine_agreement||$parent.detail.prProtocolSpeciaification"></div>
      </div>
      <div class="mobile_btn">
        <mt-button type="primary" size="large" @click="openMask">立即购买</mt-button>
      </div>
      <mt-popup position="bottom" v-model="sheetVisible">
        <div class="buy_box">
          <div class="img_text">
            <div class="img">
              <img :src="$parent.detail.product_img||$parent.detail.minerPicture" alt="">
            </div>
            <div class="text">
              <div class="price">￥{{$parent.detail.one_amount_value}}</div>
              <div class="name">{{$parent.detail.product_name}}</div>
              <div class="left">剩余可售{{$parent.leftNum}}台</div>
            </div>
          </div>
          <div class="buy_num">
            <div>购买数量<span class="buy_tips">({{parseInt($parent.detail.single_limit_amount)||1}}台起售)</span></div>
            <div class="input_box">
              <span @click="$parent.changeNum(+$parent.number-1)">-</span>
              <input type="text" v-model="$parent.number" placeholder="购买数量" @blur="$parent.changeNum($parent.number)">
              <span @click="$parent.changeNum(+$parent.number+1)">+</span>
            </div>
          </div>
          <div class="buy_text">
            <div class="item">购买算力</div>
            <div class="item">{{$parent.totalHash|format}}T</div>
          </div>
          <div class="buy_text last">
            <div class="item">支付金额</div>
            <div class="item">{{$parent.totalPrice|format}}元</div>
          </div>
          <div class="mobile_btn">
            <mt-button type="default" size="large" disabled v-if="$parent.leftStatus">已售罄</mt-button>
            <mt-button type="primary" size="large" @click="checkPay($event, false)" v-else>立即支付</mt-button>
          </div>
        </div>
      </mt-popup>
    </div>
  </section>
</template>

<script>
  import api from '../../util/function'
  import { mapState } from 'vuex'
  export default {
    props: {
      page: {
        type: String
      }
    },
    data () {
      return {
        proData: {one_amount_value: {title: '每台服务器价格', unit: '元'}, hash: {title: '每台服务器算力', unit: 'T'}, amount: {title: '服务器总台数', unit: '台'}},
        proText: {hashType: '算力类型', status: '购买类型', incomeType: '结算方式'},
        infolists: [{name: 'machine_intro', title: '产品参数'}, {name: 'machine_advantage', title: '产品优势'}, {name: 'machine_agreement', title: '协议说明'}, {name: 'product_photos', title: '矿场相册'}],
        infolist: [{name: 'MInerBrief', title: '产品介绍'}, {name: 'MinerAdvantage', title: '产品参数'}, {name: 'prProtocolSpeciaification', title: '补充说明'}],
        params: {ChipsNumber: '芯片数量', hash: '额定算力', voltage: '额定电压', minerSize: '矿机尺寸', minerOuterSize: '外箱尺寸', Cooling: '冷却', temperature: '工作温度', humidity: '工作湿度', network: '网络连接', weight: '净重', wallPower: '墙上功耗'},
        mobileNav1: {one_amount_value: {title: '每台服务器价格', unit: '元'}, hash: {title: '每台算力', unit: 'T'}, status: {title: '项目状态', unit: ''}},
        mobileNav2: {hashType: {title: '算力类型', unit: ''}, amount: {title: '服务器总数', unit: '台'}, incomeType: {title: '结算方式', unit: ''}},
        sheetVisible: false,
        contentShow: 0,
        active: 0
      }
    },
    methods: {
      checkPay (e, sh) {
        var startTime = this.$parent.detail.sell_start_time
        var now = Date.parse(new Date()) / 1000
        if (this.$parent.detail.status === 4) {
          api.tips('暂不能购买')
          return false
        }
        if (now < startTime) {
          api.tips('还未到开售时间，开售时间为：' + api.date(new Date(startTime * 1000)))
          return false
        }
        if (this.token === 0) {
          this.$router.push({name: 'login'})
          return false
        }
        if (!(this.true_name && this.true_name.status === 1)) {
          api.tips('请先实名认证', () => {
            if (this.isMobile) {
              this.$router.push({name: 'madministration'})
            } else {
              this.$router.push({name: 'account'})
            }
          })
          return false
        }
        this.$parent.goPay(e, sh)
      },
      openMask () {
        this.sheetVisible = true
      },
      tabs (k, name) {
        this.contentShow = k
        location.href = '#' + name
      }
    },
    mounted () {
      this.tabs(0)
      console.log(document.getElementsByClassName('product')[0].style.height)
    },
    filters: {
      format: api.decimal
    },
    computed: {
      ...mapState({
        token: state => state.info.token,
        true_name: state => state.info.true_name,
        bank_card: state => state.info.bank_card,
        isMobile: state => state.isMobile
      })
    }
  }
</script>

<style type="text/css" lang="scss">
  @import '../../assets/css/style.scss';
  .product{
    background: #f7f8fa;
    .top_nav{
      background-image: url('../../assets/images/miner.png');
      width: 100%;
      height: 352px;
      background-size: 100% 100%;
      .box{
        @include main
        padding-top: 12px;
        color: white;
        font-size: 12px;
        a{
          color: white;
        }
        span{
          padding:0 24px;
        }
        em{
          font-style: normal;
          color: #bfbfbf;
        }
      }
    }
    .items{
      @include main
      margin-bottom:30px;
      background: white;
      height: 350px;
      box-shadow: #dfe0e1 0 5px 5px -3px;
      position: relative;
      top: -310px;
      .miner_type{
        position: absolute;
        left: -10px;
        top:11px;
        width: 82px;
        height: 78px;
        background: #fe5039;
        text-align: center;
        color:white;
        .iconfont{
          font-size: 24px;
          padding-top:10px
        }
      }
    }
    .miner{
      .miner_left{
        width: 500px;
        border:1px solid #dcdcdc;
        height:324px;
        margin-top: 12px;
        margin-left: 12px;
        text-align: center;
        float: left;
        margin-right: 20px;
        img{
          width: 100%;
          height: auto;
        }
      }
      .miner_right{
        padding-top: 20px;
        width: 550px;
        float: left;
        h4{
          color: #666666;
          font-weight: 800;
          font-size: 14px;
          line-height: 0;
          margin-top: 10px;
        }
        .time{
          color: #fe5039;
          font-size: 12px;
          margin:15px 0;
        }
        .suan_price{
          width: 550px;
          height: 50px;
          background:#f3f3f3;
          line-height: 50px;
          margin-bottom: 20px;
          .right_miner{
            color: #ea2c2c;
            font-weight: 800;
            font-size: 14px;
            em{
              font-size: 24px;
            }
          }
        }
        .left_miner{
          color: #999999;
          font-size: 12px;
          width: 80px;
          display:inline-block;
          text-align: left;
          padding-left: 12px;
          box-sizing: border-box;
        }
        .right_miner{
          color: #121212;
          font-size: 12px;
          em{
            font-style: normal;
            font-size: 14px;
          }
        }
        .address{
          margin-bottom: 15px;
        }
        .miner_input{
          height: 34px;
          .left_miner{
            float: left;
            line-height: 34px;
          }
          .input_box{
            display:inline-block;
            width: 142px;
            height: 34px;
            border:1px solid #e5e5e5;
            border-radius: 3px;
            box-sizing: border-box;
            float: left;
            margin-right: 28px;
            span{
              width: 22px;
              height: 100%;
              display:inline-block;
              background:#e5e5e5;
              float: left;
              font-size: 16px;
              text-align: center;
              line-height: 30px;
            }
            input{
              width: 96px;
              height: 100%;
              float: left;
              text-align: center;
            }
            :nth-child(1){
              border-top-left-radius: 3px;
              border-bottom-left-radius: 3px;
              color: #c5c5c5;
            }
            :nth-child(3){
              border-top-right-radius: 3px;
              border-bottom-right-radius: 3px;
              color: #333333;
            }
          }
          .miner_number{
            float: left;
            line-height: 28px;
            color:#666666;
            span{
              color: #fe5039;
            }
          }
        }
        .btn{
          width: 242px;
          height: 44px;
          border:0;
          margin-top: 26px;
          background: #fe5039;
          color: white;
          font-size: 18px;
          margin-left: 79px;
        }
      }
    }
    .cloud_miner{
      .cloud_miner_left{
        width: 722px;
        height: 100%;
        padding-top: 56px;
        padding-left: 98px;
        box-sizing: border-box;
        float: left;
        background: #f3f8ff;
        h4{
          font-size: 27px;
          color: #333333;
          font-weight: 800;
          span{
            width: 56px;
            height: 16px;
            display:inline-block;
            border-radius: 16px;
            border:1px solid #fe5039;
            text-align: center;
            margin-left: 20px;
            line-height: 15px;
            font-size: 12px;
            color: #fe5039;
            font-weight: 100;
          }
        }
        .white{
          color: #327fff;
          border:1px solid #327fff;
          width: 115px;
          height: 25px;
          text-align: center;
          margin-top: 12px;
          font-size: 12px;
          line-height: 22px;
        }
        .product_data{
          width: 100%;
          height: 60px;
          margin-top: 30px;
          .item{
            width: 33.3%;
            text-align: center;
            float: left;
            height: 100%;
            .item_word{
              text-align: left;
              .num{
                color: #333;
                font-size: 30px;
              }
            }
            p{
              text-align: left;
            }
            .tips{
              color:#666666; 
            }
          }
          &:nth-child(1) .num{
            color: red;
          }
        }
        .press{
            width: 550px;
            height: 16px;
            background: #e3e3e3;
            margin-top: 44px;
            margin-bottom:15px;
            border-radius: 16px;
            .progress_box{
              position: relative;
              overflow:hidden;
              height:100%;
              .box{
                @include position;
                background: linear-gradient(to right, #337eff 20%, #c72abc);
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#337eff', endColorstr='#c72abc',GradientType=1 );
                border-top-left-radius: 16px;
                border-bottom-left-radius: 16px;
              }
            }
        }
        .progress_price{
          width: 550px;
          height: auto;
          .one{
            color:#327fff;
            font-weight: 800;
            float: left;
          }
          .two{
            float:right;
          }
        }
      }
      .cloud_miner_right{
        width: 456px;
        overflow: hidden;
        background: white;
        padding-bottom: 20px;
        float: left;
        padding-top: 40px;
        padding-left: 44px;
        box-sizing: border-box;
        .price_text{
          font-size: 18px;
          color:#121212;
          .buy_tips{
            color: #fe5039;
            font-size: 14px;
            margin-left: 20px;
          }
        }
        .input_box{
          border:1px solid #d2d2d2;
          margin-top: 20px;
          width: 288px;
          height: 50px;
          line-height: 50px;
          box-sizing: border-box;
          border-radius: 5px;
          display: block;
          margin-bottom: 20px;
          input{
            width: 90%;
            float: left;
            padding-left: 22px;
            line-height: 50px;
          }
        }
        .price_text1{
          text-align: left;
          color: #666666;
          font-size: 14px;
          margin-top: 10px;
          .money{
            color: #fe5039;
            font-size: 14px;
          }
        }
        .btn{
          width: 242px;
          height: 44px;
          border:0;
          margin-top: 16px;
          background: #fe5039;
          color: white;
          font-size: 18px;
          margin-left: 30px;
        }
        .loan_btn{
          background: #01bfb5;
        }
      }
    }
    .info{
      position: relative;
      @include main
      top:-300px;
      background: white;
      overflow: hidden;
      padding:0 98px;
      box-sizing: border-box;
      box-shadow: #dfe0e1 0 5px 5px -3px;
      .info_ul{
        border-bottom:1px solid #e5e5e5;
        width: 100%;
        overflow: hidden;
        .info_li{
          cursor:pointer;
          float: left;
          width: 75px;
          color:#333333;
          margin-right: 50px;
          font-size: 18px;
          height: 50px;
          padding-top: 12px;
          padding-bottom: 12px;
          box-sizing: border-box;
          &.active{
            color: #327fff;
            border-bottom: 2px solid #327fff;
            box-sizing: border-box;
          }
          &:hover{
            color: #327fff;
            border-bottom: 2px solid #327fff;
            box-sizing: border-box;
          }
        }
      }
      .content_items{
        position: relative;
        margin:15px 0 40px 0;
        padding-bottom:40px;
        background: #DDDFEB;
        .content_item{
          padding-top:20px;
          h2{
            font-weight: bold;
            margin-bottom:20px;
            padding:0 20px;
          }
          .params_table{
            margin:0 20px;
            margin-bottom:20px;
            box-shadow: #9a9a9a -4px 0 5px -3px;
            table{
              width:70%;
              border: 1px solid $light_black;
              tr{
                td{
                  padding:5px 15px;
                  &:nth-child(2){
                    width:70%;
                    text-align: right;
                  }
                }
              }
            }
          }
          .content_con img{
            margin-bottom:30px;
          }
        }
        .product_img{
          position: relative;
          .pro_name,.pro_slogan,.pro_resume{
            @include position(40)
            bottom:auto;
            text-align: center;
            color:#fff
          }
          .pro_name{
            font-size: 36px;
          }
          .pro_slogan{
            top:24%;
            font-size: 50px;
          }
          .pro_resume{
            top:80%;
            left:20%;
            width:60%;
            right:auto;
            font-size: 18px;
          }
          img{
            &.pro_img{

            }
            &.params_img{
              @include position(480,auto,auto,50)
              width:40%;
            }
          }
        }
      }
    }
    .top_nav,.items,.info{
      @include mobile_hide
    }
    .mobile_box{
      @include mobile_show
      .first_box,.product_desc,.mobile_btn{
        background: #fff;
        padding: 15px;
      }
      .first_box{
        margin-top:-15px;
        h4{
          font-size: 0.7rem;
          margin:10px 0;
        }
        .img{
          padding-bottom:15px
        }
        .base_info{
          padding-bottom:20px;
          @include flex(space-between)
          border-bottom:1px solid $border;
          .item{
            &.mobile_hide{
              opacity:0
            }
            .item_data{
              font-size: 18px;
              span{
                font-size: 14px;
                opacity: .7;
              }
            }
            .item_text{
              color:$light_black
            }
            &:first-child{
              .item_data{
                color:$orange
              }
            }
          }
        }
        .progress_info{
          padding-top:20px;
          .progress_box{
            position: relative;
            overflow:hidden;
            border-radius:5px;
            height:10px;
            background: $border;
            margin-bottom:10px;
            .box{
              @include position
              background: $orange;
            }
          }
          .progress_text{
            @include flex(space-between)
            color:$light_black;
            .item{

            }
          }
        }
      }
      .some_info{
        margin-top:15px;
        .item{
          @include flex(space-between)
          line-height: 50px;
          background: #fff;
          padding: 0 15px;
          &:not(:last-child){
            border-bottom:1px solid $border;
          }
        }
      }
      .product_desc{
        margin-top:15px;
        p.title{
          color:$text;
          font-size: 16px;
          margin-bottom:5px;
        }
        .product_content{
          color:$light_black
        }
      }
      .mobile_btn{
        text-align: center;
        border-top:1px solid $border;
        .mint-button--primary {
          background-color: $blue;
        }
        .mint-button--danger {
          background-color: $orange;
          margin-top:15px;
        }
      }
      .mint-popup{
        .buy_box{
          width:100vw;
          padding:0 15px;
          .img_text,.buy_num{
            padding: 15px 0;
          }
          .img_text{
            @include flex
            .img{
              width:130px;
              margin-right:15px;
              height:90px;
              img{
                height:90px;
                width: 130px;
                object-fit:cover
              }
            }
          }
          .buy_num{
            border-top:1px solid $border;
            border-bottom:1px solid $border;
            @include flex(space-between)
            .input_box{
              line-height: 30px;
              border:1px solid $border;
              @include number_box
              span{
                width:18%;
                color:$text !important
              }
              input{
                width:58%
              }
            }
            .buy_tips{
              font-size: 0.4rem;
              color:$orange
            }
          }
          .buy_text{
            @include flex(space-between)
            padding-top:15px;
            &.last{
              padding-bottom:20px;
            }
          }
        }
      }
    }
  }
</style>
