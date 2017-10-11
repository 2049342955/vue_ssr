<template>
  <section class="compute_detail">
    <div class="main">
      <Pay v-if="next"></Pay>
      <div class="product" v-else>
        <div class="items">
          <div class="text">
            <div class="product_title">
              <h3>{{detail.title}}<span class="icon_img"></span></h3>
              <div>
                <span class="tips">批次所在区域：</span>
                <span>{{detail.address}}</span>
              </div>
            </div>
            <div class="product_con">
              <div class="product_img">
                <img :src="detail.imgurl" alt="">
              </div>
              <div class="product_text">
                <div class="product_data">
                  <template v-for="d,k in proData">
                    <div class="item">
                      <div class="item_word">
                        <span class="num" v-if="k==='price'">{{detail[k]|format}}</span>
                        <span class="num" v-else>{{detail[k]}}</span>
                        <span class="unit">{{d.unit}}</span>
                      </div>
                      <p class="tips">{{d.title}}</p>
                    </div>
                    <div class="line"></div>
                  </template>
                </div>
                <div class="product_word">
                  <div class="item" v-for="t,k in proText">
                    <span class="tips">{{t}}:</span>
                    <span>{{detail[k]}}</span>
                  </div>
                </div>
                <h4>{{detail.desc}}</h4>
              </div>
            </div>
          </div>
          <div class="price">
            <div class="price_title">
              <span class="tips">剩余可售服务器：</span>
              <span class="num">{{leftNum}}</span>
              <span>台</span>
            </div>
            <div class="price_input">
              <div class="price_text">购买数量（台）</div>
              <div class="input_box">
                <span @click="changeNum(+number-1)">-</span>
                <input type="text" v-model="number" placeholder="请输入购买数量，1台起售" @blur="changeNum(number)">
                <span @click="changeNum(+number+1)">+</span>
              </div>
              <div class="price_text">需支付：<span class="money">{{totalPrice|format}}元</span></div>
              <div class="price_text">总算力：<span class="money">{{totalHash|format}}T</span></div>
              <button class="btn" @click="goPay">立即支付</button>
            </div>
          </div>
        </div>
        <div class="info">
          <div class="info_item">
            <h3>产品优势</h3>
            <div class="box">
              <div class="item" v-for="a,k in detail.advantage">{{a}}</div>
            </div>
          </div>
          <div class="info_item">
            <h3>协议说明</h3>
            <div class="box">
              <div class="item" v-for="p,k in detail.Protocol">
                <p>{{p}}</p>
              </div>
            </div>
          </div>
          <div class="info_item">
            <h3>矿场相册</h3>
            <div class="box">
              <div class="item" v-for="i,k in detail.minerImg">
                <img :src="i" alt="">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
  import Pay from '../common/Pay'
  import api from '../../util/function'
  export default {
    components: {
      Pay
    },
    data () {
      return {
        next: false,
        proData: {price: {title: '每台服务器价格', unit: '元'}, hash: {title: '每台服务器算力', unit: 'T'}, num: {title: '服务器总台数', unit: '台'}},
        proText: {hashType: '算力类型', buyType: '购买类型', incomeType: '结算方式'},
        detail: {title: '阿瓦隆001号', address: '1号楼A区', imgurl: require('@/assets/images/detail_img.jpg'), price: 10000, hash: '9.0', num: 500, hashType: 'BTC', buyType: '预售', incomeType: '每日结算，次日发放', desc: '*  BTC挖矿阿瓦隆001号算力矿机来源嘉楠耘智A741矿机', leftNum: 5, advantage: ['一次购买，全程无忧挖矿，购买后立即享受收益', '算力网提供专业挖矿配件以及后续收益派发服务', '正规矿场运营，国家电力保证矿机7*24小时正常运行', '算力网提供专业技术维护，保证您矿机超长时间挖矿', '用户可收回矿机残值，保证投资收益', '用户可对矿机所有权进行转让'], Protocol: ['算力宝A7 云挖矿合约产品将A7矿机算力拆分成T，以按T销售的模式运作，以提升产品整体的灵活性。', '以下是无忧挖矿六号的合约介绍：', '售 价：        每份合约原价968RMB，其中包含的硬件费用包含矿机设备和矿机配件两部份。现算力宝平台补贴用户100RMB/T，售价868.00RMB/T。', '算力单位：   每份合约代表A7矿机1T的算力。', '电 费：        每份合约功耗为170W，电费为0.40CNY/KWH,其中矿机功耗为150W，电源功耗为20W，合计为170W，每天总电费为1.632CNY。', '算力收益：   合约合作矿池为1hash，1hash选用PPS收益模式，矿池收益当日结算，次日发放。算力收益=挖矿收益-电费。电费按次日16:00的比特币价格从前一天的比特币收益中抵扣。', '停电维护：   每月1号为矿场停电维护时间，当天比特币收益为0，同时也不需交电费。（2017年4月起，停电维护时间改为每月10号）', '停止挖矿：   如果连续10天挖矿收入小于电费，合约终止'], minerImg: [require('@/assets/images/miner1.jpg'), require('@/assets/images/miner2.jpg')]},
        totalPrice: 0,
        totalHash: 0,
        number: '',
        leftNum: 0,
        account: {balance: 10000}
      }
    },
    methods: {
      changeNum (n) {
        this.number = n < 0 ? 0 : n > this.detail.leftNum ? this.detail.leftNum : n
        this.totalPrice = this.detail.price * this.number
        this.totalHash = this.detail.hash * this.number
        this.leftNum = this.detail.leftNum - this.number
      },
      goPay () {
        this.next = true
      }
    },
    filters: {
      format: api.decimal
    },
    mounted () {
      this.leftNum = this.detail.leftNum
    }
  }
</script>

<style type="text/css" lang="scss">
  @import '../../assets/css/style.scss';
  .compute_detail{
    padding-top: 30px;
    padding-bottom: 110px;
    background: #f7f8fa;
    .main{
      @include main
      .product{
        h3{
          font-size: 18px;
          font-weight: bold;
        }
        .items{
          margin-bottom:30px;
          @include flex(flex-start,strech)
          .text{
            flex:1;
            .product_title{
              @include flex(space-between)
              padding-bottom:10px;
              border-bottom: 1px solid $border;
              margin-bottom:20px
            }
            .product_con{
              @include flex(flex-start,strech)
              margin-bottom:25px;
              .product_img{
                width:230px;
                margin-right:20px;
                img{
                  height:230px;
                  object-fit:cover
                }
              }
              .product_text{
                flex:1;
                .product_data{
                  @include flex(space-between)
                  background: #fff9f3;
                  padding:25px;
                  .item{
                    .item_word{
                      .num{
                        font-size: 24px;
                      }
                    }
                    &:first-child{
                      .item_word{
                        color:$orange
                      }
                    }
                  }
                  .line{
                    width:1px;
                    height:50px;
                    background: $border;
                    &:last-child{
                      display: none;
                    }
                  }
                }
                .product_word{
                  @include flex(space-between)
                  margin-top:20px;
                  padding:15px;
                  border:1px solid $border
                }
                h4{
                  margin-top:20px;
                  color: $light_text;
                }
              }
            }
          }
          .price{
            background:$white;
            width:330px;
            margin-left:30px;
            .price_title{
              padding:15px 30px;
              border-bottom:1px solid $border
            }
            .price_input{
              padding:15px 30px;
              .price_text{
                color: $light_text;
                margin-bottom:10px;
                .money{
                  color: $orange;
                }
              }
              .input_box{
                line-height: 40px;
                border:1px solid $border;
                margin-bottom:30px;
                @include flex
                span{
                  width:25px;
                  text-align: center;
                  background: $border;
                  font-size: 18px;
                  font-weight: bold;
                  color: #c5c5c5;
                  cursor: pointer;
                  user-select:none;
                  &:last-child{
                    color: $orange;
                  }
                }
                input{
                  flex:1;
                  padding:0 10px
                }
              }
              .btn{
                width:100%;
                @include button($orange)
                line-height: 3;
                margin-top:30px
              }
            }
          }
          .tips{
            color: $light_black;
          }
        }
        .info{
          .info_item{
            h3{
              padding-bottom:10px;
              border-bottom:1px solid $border
            }
            .box{
              padding:30px 0;
              font-size: 16px;
              .item{
                margin-bottom:30px
              }
            }
            &:first-child{
              .box{
                color: $light_text;
                @include row(2)
              }
            }
            &:nth-child(3){
              .box{
                @include row(2)
                .item img{
                  height:290px;
                  object-fit:cover
                }
              }
            }
          }
        }
        .items .text,.info{
          padding:15px 30px;
          background:$white;
        }
      }
    }
  }
</style>
