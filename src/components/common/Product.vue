<template>
  <section class="product">
    <div class="items">
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
      <div class="price" v-if="page==='cloudCompute'">
        <div class="price_title">
          <span class="tips">剩余可售服务器：</span>
          <span class="num">{{$parent.leftNum}}</span>
          <span>台</span>
        </div>
        <div class="price_input">
          <div class="price_text">购买数量<span class="buy_tips">(最少{{$parent.detail.single_limit_amount||1}}台)</span></div>
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
    </div>
    <div class="info">
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
            <div>购买数量<span class="buy_tips">(最少{{$parent.detail.single_limit_amount||1}}台)</span></div>
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
        if (this.token === 0) {
          this.$router.push({name: 'login'})
          return false
        }
        if (!(this.true_name && this.true_name.status === 1)) {
          api.tips('请先实名认证', () => {
            if (this.$route.path.includes('mHome')) {
              this.$router.push({name: 'madministration'})
            } else {
              this.$router.push({name: 'account'})
            }
          })
          return false
        }
        if (!(this.bank_card && this.bank_card.status === 1)) {
          api.tips('请先绑定银行卡', () => {
            if (this.$route.path.includes('mHome')) {
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
        bank_card: state => state.info.bank_card
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
    .items{
      margin-bottom:30px;
      @include flex(space-between,strech)
      .text{
        width:69%;
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
            width:30%;
            margin-right:5%;
            img{
              height:210px;
              object-fit:cover
            }
          }
          .product_text{
            width:64%;
            .product_data{
              @include flex(space-between)
              background: #fff9f3;
              padding:25px;
              .item{
                padding:0 15px;
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
              margin-top:10px;
              padding:15px;
              border:1px solid $border;
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
        width:28%;
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
              color: $orange
            }
            .buy_tips{
              font-size: 12px;
              color:$orange;
              margin-left:5px
            }
          }
          .input_box{
            line-height: 40px;
            border:1px solid $border;
            margin-bottom:30px;
            @include number_box
          }
          .btn{
            width:100%;
            line-height: 3;
            position: relative;
            margin-top:10px;
            &.buy_btn{
              @include button($orange)
            }
            &.loan_btn{
              @include button($blue)
            }
            &.error:before{
              @include position(-35)
              content:'请输入或添加至少1台矿机';
              color: $orange;
            }
            &.over:before{
              @include position(-35)
              content:'剩余可售量不足您所需求的量';
              color: $orange;
            }
            &:disabled{
              background: #f5b48f;
              border-color: #f5b48f;
            }
          }
        }
        &.transfer{
          .price_title{
            margin-bottom:20px;
          }
          .price_input{
            .price_text{
              .money{
                font-size: 24px;
                margin-right:3px
              }
              &:first-child{
                margin-bottom:20px
              }
              &:nth-child(2){
                margin-bottom:25px
              }
            }
          }
        }
      }
      .tips{
        color: $light_black;
      }
      @include mobile_hide
    }
    .info{
      .info_item{
        h3{
          padding-bottom:10px;
          border-bottom:1px solid $border
        }
        .box{
          padding:30px 0;
          font-size: 16px
        }
        .miner_photos.box{
          @include row(2)
          .item img{
            height:290px;
            object-fit:cover
          }
        }
      }
      @include mobile_hide
    }
    .items .text,.info{
      padding:15px 30px;
      background:$white;
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
