<template>
  <section class="product">
    <div class="bgImg">
      <p v-if="$route.params.type==='1'" class="centertype">矿机商城<span>></span>矿机<span>></span><em>{{$route.params.name}}</em></p>
      <p v-else-if="$route.params.type==='0'" class="centertype">矿机商城<span>></span>云矿机<span>></span><em>{{$route.params.name}}</em></p>
    </div>
    <div class="items" v-if="$route.params.type==='1'">
      <div class="absolute">
        <img src="../../assets/images/kuangji.png"/>
        矿机
      </div>
      <div class="miner_left">
        <img :src="$parent.detail.minerPicture" alt="">
      </div>
      <div class="miner_right">
        <h4>{{$route.params.name}}</h4>
        <p class="time">抢购成功订单2-3周内陆续发货！发货时间 : {{$parent.detail.DeliveryTime}}天后发货</p>
        <p class="suan_price"><span class="left_miner">算 力 价</span><span class="right_miner">¥ <em>{{$parent.totalPrice|format}}</em></span></p>
        <p class="address"><span class="left_miner">总 算 力</span><span class="right_miner"><em>{{$parent.totalHash|format}}</em>T</span></p>
        <p class="address"><span class="left_miner">物&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;流</span><span class="right_miner">订单委托第三方物流公司发货，物流费用到付</span></p>
        <div class="miner_input">
          <span class="left_miner">数&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;量</span>
          <div class="input_box right_miner">
            <span @click="$parent.changeNum(+$parent.number-1)">-</span>
            <input type="text" v-model="$parent.number" :placeholder="parseInt($parent.detail.single_limit_amount)||1" @blur="$parent.changeNum($parent.number)">
            <span @click="$parent.changeNum(+$parent.number+1)">+</span>
          </div>
          <p class="miner_number">库存{{$parent.leftNum}}台<span>（最少购买{{parseInt($parent.detail.single_limit_amount)||1}}台）</span></p>
        </div>
        <button class="btn" v-if="$parent.detail.status===1" @click="checkPay">立即支付</button>
        <button class="btn" disabled v-else-if="$parent.detail.status===2">已转让</button>
        <button class="btn" disabled v-else-if="$parent.detail.status===3">产品撤销</button>
      </div>
    </div>
    <div class="items miner_yun" v-if="$route.params.type==='0'">
      <div class="yun_left">
        <div class="absolute">
          <img src="../../assets/images/yun.png"/>
          云矿机
        </div>
        <h4>
            {{$parent.detail.product_name}}
            <span v-if="$parent.detail.status===4">预售</span>
            <span v-else-if="$parent.detail.status===5">可售</span>
            <span v-if="$parent.detail.status===6">已售馨</span>
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
            <div class="box" :style="{width:((parseInt($parent.detail.buyed_amount)/parseInt($parent.detail.amount))*100)+'%'}"></div>
          </div>
        </div>
        <div class="progress_price">
          <span class="one">当前进度 {{(parseInt($parent.detail.buyed_amount)/parseInt($parent.detail.amount))*100}}%</span>
          <span class="two">剩余可售 {{$parent.leftNum}}台</span>
        </div>
      </div>
      <div class="yun_right">
        <div class="price_text">我要购买<span class="buy_tips">(最少{{parseInt($parent.detail.single_limit_amount)||1}}台)</span></div>
        <div class="input_box">
          <input type="text" v-model="$parent.number" :placeholder="parseInt($parent.detail.single_limit_amount)||1" @blur="$parent.changeNum($parent.number)">
          <span>台</span>
        </div>
        <div class="price_text1">需支付：<span class="money">{{$parent.totalPrice|format}}元</span></div>
        <div class="price_text1">总算力：<span class="money">{{$parent.totalHash|format}}T</span></div>
        <button class="btn" disabled v-if="$parent.leftStatus">已售罄</button>
        <button :class="['btn buy_btn', {error: $parent.buyStatus===1}, {over: $parent.buyStatus===2}]" v-else @click="checkPay($event, false)">立即支付</button>
        <button class="btn loan_btn" @click="checkPay($event, true)" v-if="$parent.rateshow&&!$parent.leftStatus">分期购买</button>
      </div>
    </div>
     <!-- <div class="items">
       <div class="text">
        <div class="product_title">
          <h3>{{$parent.detail.product_name}}<span :class="'icon_currency '+$parent.detail.hashType"></span></h3>
          <div v-if="$parent.detail.batch_area&&$route.params.type!=='1'">
            <span class="tips">批次所在区域：</span>
            <span>{{$parent.detail.batch_area}}</span>
          </div>
        </div>
        <div class="product_con">
          <div class="product_img">
            <img :src="$parent.detail.product_img||$parent.detail.minerPicture" alt="">
          </div>
          <div class="product_text">
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
                <div class="line"></div>
              </template>
            </div>
            <div class="product_word" v-if="$route.params.type!=='1'">
              <div class="item" v-for="t,k in proText">
                <span class="tips">{{t}}:</span>
                <span v-if="k==='status'">{{$parent.str[$parent.detail[k]]}}</span>
                <span v-else>{{$parent.detail[k]}}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="price" v-if="page==='minerShop'">
        <div class="price_title">
          <span class="tips">剩余可售服务器：</span>
          <span class="num">{{$parent.leftNum}}</span>
          <span>台</span>
        </div>
        <div class="price_input">
          <div class="price_text">购买数量<span class="buy_tips">(最少{{parseInt($parent.detail.single_limit_amount)||1}}台)</span></div>
          <div class="input_box">
            <span @click="$parent.changeNum(+$parent.number-1)">-</span>
            <input type="text" v-model="$parent.number" placeholder="请输入购买数量" @blur="$parent.changeNum($parent.number)">
            <span @click="$parent.changeNum(+$parent.number+1)">+</span>
          </div>
          <div class="price_text">需支付：<span class="money">{{$parent.totalPrice|format}}元</span></div>
          <div class="price_text">总算力：<span class="money">{{$parent.totalHash|format}}T</span></div>
         <button class="btn" disabled v-if="$parent.leftStatus">已售罄</button>
         <button :class="['btn buy_btn', {error: $parent.buyStatus===1}, {over: $parent.buyStatus===2}]" v-else @click="checkPay($event, false)">立即支付</button>
         <button class="btn loan_btn" @click="checkPay($event, true)" v-if="$parent.rateshow&&!$parent.leftStatus">分期购买</button>
        </div>
      </div>
      <div class="price transfer" v-else>
        <div class="price_title tips">转让算力服务器</div>
        <div class="price_input">
          <div class="price_text">需支付：<span class="money">{{$parent.detail.total_price|format}}元</span></div>
          <div class="price_text">总算力：<span class="money">{{$parent.detail.transfer_amount|format}}T</span></div>
          <button class="btn" v-if="$parent.detail.status===1" @click="checkPay">立即支付</button>
          <button class="btn" disabled v-else-if="$parent.detail.status===2">已转让</button>
          <button class="btn" disabled v-else-if="$parent.detail.status===3">产品撤销</button>
        </div>
      </div> 
    </div>  -->
    <div class="info">
      <!-- <el-tabs>
        <el-tab-pane label="产品介绍" v-html="$parent.detail.machine_intro||$parent.detail.MInerBrief"></el-tab-pane>
        <el-tab-pane label="产品优势" v-html="$parent.detail.machine_advantage||$parent.detail.MinerAdvantage"></el-tab-pane>
        <el-tab-pane label="补充说明" v-html="$parent.detail.machine_agreement||$parent.detail.prProtocolSpeciaification"></el-tab-pane>
        <el-tab-pane label="矿场相册" v-if="$route.params.type!=='1'"><img :src="$parent.detail.product_photos" alt=""></el-tab-pane>
      </el-tabs> -->
    </div>
    <!-- <div class="info">
      <div class="info_item">
        <h3>产品介绍</h3>
        <div class="box" v-html="$parent.detail.machine_intro||$parent.detail.MInerBrief"></div>
      </div>
      <div class="info_item">
        <h3>产品优势</h3>
        <div class="box" v-html="$parent.detail.machine_advantage||$parent.detail.MinerAdvantage"></div>
      </div>
      <div class="info_item">
        <h3>补充说明</h3>
        <div class="box" v-html="$parent.detail.machine_agreement||$parent.detail.prProtocolSpeciaification"></div>
      </div>
      <div class="info_item" v-if="$route.params.type!=='1'">
        <h3>矿场相册</h3>
        <div class="box miner_photos">
           <div class="item"> 
            <img :src="$parent.detail.product_photos" alt="">
           </div> 
        </div>
      </div>
    </div> -->
    
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
            <div>购买数量<span class="buy_tips">(最少{{parseInt($parent.detail.single_limit_amount)||1}}台)</span></div>
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
            <mt-button type="primary" size="large" @click="checkPay($event, false, 1)" v-else>立即支付</mt-button>
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
      },
      proData: {
        type: Object
      },
      proText: {
        type: Object
      },
      text: {
        type: Object
      },
      rateshow: {
        type: String
      }
    },
    data () {
      return {
        mobileNav1: {one_amount_value: {title: '每台服务器价格', unit: '元'}, hash: {title: '每台算力', unit: 'T'}, status: {title: '项目状态', unit: ''}},
        mobileNav2: {hashType: {title: '算力类型', unit: ''}, amount: {title: '服务器总数', unit: '台'}, incomeType: {title: '结算方式', unit: ''}},
        sheetVisible: false
      }
    },
    methods: {
      checkPay (e, sh, mobile) {
        var startTime = this.$parent.detail.sell_start_time
        var now = Date.parse(new Date()) / 1000
        if (now < startTime) {
          api.tips('还未到开售时间，开售时间为：' + api.date(new Date(startTime * 1000), 'date'))
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
        if (!(this.bank_card && this.bank_card.status === 1)) {
          api.tips('请先绑定银行卡', () => {
            if (this.isMobile) {
              this.$router.push({name: 'madministration'})
            } else {
              this.$router.push({name: 'account'})
            }
          })
          return false
        }
        this.$parent.goPay(e, sh, mobile)
      },
      openMask () {
        this.sheetVisible = true
      }
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
    h3{
      font-size: 18px;
      font-weight: bold;
    }
    .bgImg{
      background-image: url('../../assets/images/miner.png');
      width: 100%;
      height: 352px;
      background-size: 100% 100%;
      .centertype{
        width: 1180px;
        margin:0 auto;
        padding-top: 12px;
        color: white;
        font-size: 12px;
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
      .absolute{
        position: absolute;
        left: -10px;
        top:11px;
        width: 82px;
        height: 78px;
        background: #fe5039;
        text-align: center;
        color:white;
        img{
          width: 25px;
          display:block;
          height: auto;
          margin:0 auto;
          margin-top:15px; 
          margin-bottom: 8px;
        }
      }
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
          margin-left: 94px;
        }
      }
    }
    .miner_yun{
      background: #f3f8ff;
      position: relative;
      .absolute{
        position: absolute;
        left: -10px;
        top:11px;
        width: 82px;
        height: 78px;
        background: #fe5039;
        text-align: center;
        color:white;
        img{
          width: 25px;
          display:block;
          height: auto;
          margin:0 auto;
          margin-top:15px; 
          margin-bottom: 8px;
        }
      }
      .yun_left{
        width: 722px;
        height: 100%;
        padding-top: 56px;
        padding-left: 98px;
        box-sizing: border-box;
        float: left;
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
          &:nth-child(1) .item_word .num{
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
      .yun_right{
        width: 456px;
        height: 314px;
        background: white;
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
          margin-top: 26px;
          background: #fe5039;
          color: white;
          font-size: 18px;
          margin-left: 94px;
        }
      }
    }
    .info{
      position: relative;
      top:-300px;
      background: white;
      overflow: hidden;
      padding:0 98px;
      box-sizing: border-box;
      box-shadow: #dfe0e1 0 5px 5px -3px;
      .el-tabs__nav-scroll{
        margin-top: 12px;
      }
      .el-tabs__content{
        margin-top: 40px;
        margin-bottom: 70px;
      }
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
