<template>
  <div class="cominfor">
    <div class="compute_news_nav">
      <div class="compute_news_box">
        <router-link :to="n.path" v-for="n, k in computationallist" :class="{'active': active === k}" :key="k">{{n.title}}</router-link>
      </div>
    </div>
    <div class="cominfor_header">
      <div class="cominfor_headercon">
        <div class="cominfo_headerleft">
          <router-link to="/computeNews/list" class="red">
            <h1>算力资讯</h1>
            <p>随时获取最新行业讯息</p>
          </router-link>
          <div class="olbottom">
            <div v-for="n, k in headerlist" class="ollist" :key="k">
              <router-link :to="n.link" class="oltitle">{{n.title}}</router-link>
              <div class="rou">
                <router-link :to="d.path" v-for="d, m in n.route" :key="m">{{d.name}}</router-link>
              </div>
            </div>
          </div>
        </div>
        <div class="cominfo_headerright">
          <div class="bigtop">
            <div class="bigimg">
              <img :src="n.image" v-for="n, k in bigimglist" class="teimg"/> 
            </div>
            <div class="bigtab">
              <div class="bighover" v-for="d,m in bigimglist" :class="{'active': show === m}" @mouseover="hoverwhite(m)">
                <h5>{{d.title}}</h5>
              </div>
            </div>
          </div>
          <div class="bigbottom">
            <div class="numbig" v-for="n, m in miners" :key="m">
              <img :src="n.big"/>
              <h4>{{n.title}}</h4>
              <router-link :to="n.path">{{n.route}}</router-link>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="cominfor_news">
      <router-link to="/quickNews">
        <img :src="require('@/assets/images/information7.png')"/>
      </router-link>
      <div class="scroll">
        <router-link to="/computeChart">【全网算力】<b>{{qwsl.hashrate}}PH/s</b>&nbsp;&nbsp;&nbsp;&nbsp;【全网困难度】<b>{{qwsl.difficulty}}T</b></router-link>
        <router-link :to="'/quickNews'" v-for="s, m in scroll" :key="m"> /&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="icon iconfont icon-new1"></span> {{s.title}}</router-link>
      </div>
    </div>
    <div class="cominfor_info">
      <h4>
        <p class="title">交易信息</p>
        <p class="text">提供实时二手平台信息</p>
        <router-link to="/transaction">了解更多 ></router-link>
      </h4>
      <div class="cominfor_infoleft">
        <router-link to="/transaction">
          <p v-for="n,k in infoleft" class="infoleft_p">
            <span class="status">【出售】</span>
            <span class="title">{{n.title}}</span>
            <span class="time">{{n.created_time}}</span>
          </p>
        </router-link>
      </div>
      <div class="cominfor_inforight">
        <router-link to="/transaction">
          <p v-for="n,k in inforight" class="inforight_p">
            <span class="status">【求购】</span>
            <span class="title">{{n.title}}</span>
            <span class="time">{{n.created_time}}</span>
          </p>
        </router-link>
      </div>
    </div>
    <div class="cominfor_she">
      <h4>
        <p class="title">设备之家</p>
        <p class="text">为您提供更全面的设备信息</p>
        <router-link to="/equipments/list">了解更多 ></router-link>
      </h4>
      <div class="cominfor_shebottom">
        <div class="shebottomleft">
          <h6>【主流厂商】</h6>
          <div style="height:291px;">
              <div class="she_ol">
                <router-link :to="'/manufacturer/detail/' + n.id" class="border" v-for="n, k in sheol1" :key="k"><span></span>{{n.title}}</router-link>
              </div>
          </div>
          <router-link to="/manufacturer/list">全部矿机介绍 ></router-link>
        </div>
        <div class="shebottomcen">
          <h6>【矿机测评】</h6>
          <div class="she_ol">
            <div class="imgshe" v-for="n, k in sheol2">
              <h2>BitCoin</h2>
              <div class="imgshe1">
                <img :src="n.image"/>
              </div>
              <p class="title">{{n.title}}</p>
              <p class="time">{{n.dateline}}</p>
            </div>
          </div>
          <router-link to="/equipmentEvaluate/list">全部矿机介绍 ></router-link>
        </div>
        <div class="shebottomright">
          <h6>【矿机博物馆】</h6>
          <div class="all_ol" style="height:287px;">
            <router-link :to="'/equipments/detail/' + n.id" class="she_ol" v-for="n, k in sheol3" :key="k">
              <img :src="n.image"/>
              <p class="title">{{n.title}}</p>
            </router-link>
          </div>
          <router-link to="/equipments/list">全部矿机介绍 ></router-link>
        </div>
      </div>
    </div>
    <div class="cominfor_type">
      <h4>
        <p class="title">挖矿币种</p>
        <p class="text">虚拟数字货币百科</p>
        <router-link to="/currency">了解更多 ></router-link>
      </h4>
      <table border="0"  class="covertable" style="margin:0;">
        <thead>
          <tr style="background:white;">
            <th v-for="n, k in tr">{{n.title}}</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="d, m in td">
            <td><span>{{d.name}}</span> - {{d.chinese_name}}</td>
            <td>¥ {{d.price}}</td>
            <td>¥ {{(d.market_cap_usd / 100000000).toFixed(2)}}</td>
            <td>{{d.qwsl}} <span>{{d.unit}}</span></td>
            <td>{{d.output}}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="cominfor_auto">
      <h4>
        <p class="title">矿场相册</p>
        <p class="text">让您进一步了解我们的矿场</p>
        <!-- <router-link to="#">了解更多 ></router-link> -->
      </h4>
      <div class="cominfor_autool">
        <div class="autool" v-for="n, k in autool">
          <h3>{{n.title}}</h3>
          <p>{{n.text}}</p>
          <router-link to="#">{{n.button}}</router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import util from '@/util/index'
  import api from '@/util/function'
  import { mapState } from 'vuex'
  export default {
    data () {
      return {
        scroll: [],
        autool: [{title: '蒙古矿场', text: '国家电网合规用电', button: '即将开放'}, {title: '山西矿场', text: '国家电网合规用电', button: '即将开放'}, {title: '辽宁矿场', text: '国家电网合规用电', button: '即将开放'}],
        tr: [{title: '币种'}, {title: '价格(元)'}, {title: '流通市值（亿/美元）'}, {title: '全网算力'}, {title: '单位挖矿产出'}],
        td: [],
        sheol1: [],
        sheol2: [],
        sheol3: [],
        headerlist: [{
          title: '设备之家',
          link: '/equipments/list',
          route: [{
            name: '矿机测评 >',
            path: '/equipmentEvaluate/list'
          }, {
            name: '矿机博物馆 >',
            path: '/equipments/list'
          }]
        }, {
          title: '数字货币',
          link: '/digitalCurrency/list',
          route: [{
            name: '主流币种 >',
            path: '/currency'
          }, {
            name: '数字货币 >',
            path: '/currency'
          }]
        }, {
          title: '二手资讯',
          link: '/transaction'
        }],
        bigimglist: '',
        show: 0,
        computationallist: [{title: '算力资讯', path: '/computeNews/list'}, {title: '设备之家', path: '/equipments/list'}, {title: '交易信息', path: '/transaction'}, {title: '挖矿币种', path: '/currency'}],
        // , {title: '电场矿场', path: '/computational/electric'}
        infoleft: [],
        inforight: [],
        active: 0,
        qwsl: '',
        miners: [{big: require('@/assets/images/information5.png'), title: '资深矿工-设备之家', route: '前往了解 >', path: '/equipments/list'}, {big: require('@/assets/images/information2.png'), title: '新手矿工-数字货币', route: '前往了解 >', path: '/digitalCurrency/list'}, {big: require('@/assets/images/information3.png'), title: '平台交易最新资讯', route: '前往了解 >', path: '/transaction'}]
      }
    },
    methods: {
      hoverwhite (k) {
        this.show = k
        var bigimg = document.getElementsByClassName('teimg')
        for (var a = 0; a < bigimg.length; a++) {
          if (a === k) {
            bigimg[a].style.opacity = '1'
          } else {
            bigimg[a].style.opacity = '0'
          }
        }
      }
    },
    mounted () {
      this.hoverwhite(0)
      var self = this
      util.post('showDifficulty', {sign: api.serialize({token: 0})}).then(function (res) {
        api.checkAjax(self, res, () => {
          self.qwsl = res
        })
      }).catch(res => {
        console.log(res)
      })
      util.post('showCoinData', {sign: api.serialize({token: 0})}).then(function (res) {
        api.checkAjax(self, res, () => {
          self.td = res
        })
      }).catch(res => {
        console.log(res)
      })
      util.post('NewsManfacturer', {sign: api.serialize({token: 0})}).then(function (res) {
        api.checkAjax(self, res, () => {
          self.sheol1 = res
        })
      }).catch(res => {
        console.log(res)
      })
      util.post('NewsReview', {sign: api.serialize({token: 0})}).then(function (res) {
        api.checkAjax(self, res, () => {
          self.sheol2 = res
        })
      }).catch(res => {
        console.log(res)
      })
      util.post('NewsMuseum', {sign: api.serialize({token: 0})}).then(function (res) {
        api.checkAjax(self, res, () => {
          self.sheol3 = res
        })
      }).catch(res => {
        console.log(res)
      })
      util.post('NewsBrief', {sign: api.serialize({token: 0})}).then(function (res) {
        api.checkAjax(self, res, () => {
          self.scroll = res
        })
      }).catch(res => {
        console.log(res)
      })
      util.post('showSecondHandTradeTopList', {sign: api.serialize({token: 0})}).then(function (res) {
        api.checkAjax(self, res, () => {
          self.inforight = res.buy_info
          self.infoleft = res.transfer_info
        })
      }).catch(res => {
        console.log(res)
      })
      util.post('showBannerNews', {sign: api.serialize({token: 0})}).then(function (res) {
        api.checkAjax(self, res, () => {
          self.bigimglist = res
        })
      }).catch(res => {
        console.log(res)
      })
    },
    computed: {
      ...mapState({
        token: state => state.info.token
      })
    }
  }
</script>

<style lang="scss" scoped>
  @import '../assets/css/style.scss';
  .cominfor{
    width: 100%;
    height: 100%;
    background:#eceff8;
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
          &.avtive{
            color:#327fff;
            height: 50px;
            box-sizing: border-box;
            border-top: 2px solid #327fff;
          }
          &:first-child{
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
    .cominfor_header{
      width: 100%;
      height: 490px;
      background-image: url('../assets/images/information.png');
      overflow: hidden;
      background-size: 100% 100%;
      object-fit: cover;
      padding-top: 27px;
      .cominfor_headercon{
        width: 1180px;
        margin:0 auto;
        .cominfo_headerleft{
          width: 300px;
          height: 400px;
          float: left;
          background-image: url('../assets/images/information1.png');
          margin-right: 4px;
          position: relative;
          .red{
            position: absolute;
            width: 296px;
            height: 170px;
            background-image: url('../assets/images/red.png');
            background-size: 100% 100%;
            left: -15px;
            top:-13px;
            text-align: center;
            h1{
                color: white;
                font-weight: 800;
                font-size: 40px;
                margin-top: 35px;
            }
            p{
                margin-top: 10px;
                color: white;
                letter-spacing:2px;
                font-size: 13px;
                &:after{
                    content:'';
                    @include triangle(right,white)
                    border-top: 5px solid transparent;
                    border-bottom: 5px solid transparent;
                    border-left: 5px solid white;
                    margin-left: 12px;
                }
                &:before{
                    content:'';
                    @include triangle(right,white)
                    border-top: 5px solid transparent;
                    border-bottom: 5px solid transparent;
                    border-left: 5px solid white;
                    margin-left: 12px;
                    transform:rotate(180deg);
                    margin-right: 12px;
                }
            }
          }
          .olbottom{
              padding:0;
              margin:0;
              padding-top: 190px;
              margin-left: 56px;
              .ollist{
                  width: 200px;
                  height: 74px;
                  border-left: 1px solid #535464;
                  margin:0;
                  padding:0;
                  .oltitle{
                      color: #327fff;
                      font-size: 14px;
                      padding-left: 11px;
                      &:before{
                          content: '';
                          width: 6px;
                          height: 6px;
                          background: #bfbfbf;
                          position: absolute;
                          left:54px;
                          border-radius: 100%;
                          margin-top:7px;
                      }
                  }
                  .rou{
                      margin-top: 12px;
                      margin-left: 14px;
                      a{
                          color: white;
                          margin-right: 22px;
                          &:hover{
                              color: #327fff; 
                          }
                      }
                  }
                  &:last-child{
                      height: 60px;
                  }
              }
          }
        }
        .cominfo_headerright{
          width: 876px;
          height: 400px;
          float: left;
          position: relative;
          .bigtop{
            width: 100%;
            height: 276px;
            .bigimg{
              width: 100%;
              height: 100%;
              position: relative;
              img{
                width: 100%;
                height: 100%;
                object-fit: cover;
                opacity: 0;
                position: absolute;
                top:0;
                left:0;
                transition: 2s;
                &:first-child{
                    opacity: 1;
                }
              }
            }
            .bigtab{
                width: 182px;
                height: 276px;
                position: absolute;
                right: 0;
                background: rgba(105, 105, 105, 0.66);
                top:0;
                .bighover{
                    width: 100%;
                    height: 92px;
                    padding:0 10px;
                    box-sizing: border-box;
                    h5{
                        color: white;
                        font-size: 14px;
                        line-height: 92px;
                        text-align: center;
                        white-space: nowrap;
                        text-overflow: ellipsis;
                        overflow: hidden;
                    }
                    p{
                        font-size: 12px;
                        color: #bcb2b3;
                    }
                    &:hover{
                        background: white;
                        border-right: 4px solid #327fff;
                        h5{
                           color: #7d7d7d; 
                        }
                        p{
                           color: #c6c6c6;
                        }
                    }
                    &.active{
                        background: white;
                        border-right: 4px solid #327fff;
                        h5{
                           color: #7d7d7d; 
                        }
                        p{
                           color: #c6c6c6;
                        }
                    }
                }
            }
          }
          .bigbottom{
            width: 100%;
            height: 120px;
            margin-top: 5px;
            .numbig{
              width: 290px;
              height: 120px;
              float: left;
              position: relative;
              img{
                width: 100%;
                height: 100%;
                position: absolute;
                top:0;
                left:0;
              }
              h4{
                  position: absolute;
                  top:34px;
                  color:white;
                  text-align: center;
                  width: 100%;
                  font-weight: 800;
                  font-size: 18px;
              }
              a{
                  display: block;
                  width: 84px;
                  height: 24px;
                  border:1px solid white;
                  position: absolute;
                  text-align: center;
                  line-height: 22px;
                  font-size: 12px;
                  color:white;
                  margin-top: 66px;
                  margin-left: 102px;
              }
              &:nth-child(2){
                margin:0 3px;
              }
            }
          }
        }
      }
    }
    .cominfor_news{
      width: 1180px;
      height: 30px;
      margin:0 auto;
      margin-top: 30px;
      img{
          width: 116px;
          height: 25px;
          float: left;
      }
      .scroll{
          width: 940px;
          float: left;
          margin-left:30px;
          height: 30px;
          line-height: 30px;
          color:#121212;
          font-size: 15px;
          a{
            display:inline-block;
            float: left;
          }
          :nth-child(1){
            color:#121212;
            display:inline-block;
            margin-right: 30px;
            b{
              font-weight: 800;
              color:#121212;
            }
          }
          :nth-child(2){
            width: 40%;
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
            color: #121212;
            span{
              color: #f84a35;
              margin-right:10px;
            }
          }
      }
    }
    .cominfor_info{
        width: 1180px;
        overflow: hidden;
        margin: 0 auto;
        background: white;
        margin-top: 24px;
        box-shadow: #d2d4db 0 0 20px;
        padding:30px 44px 30px 44px;
        margin-bottom: 25px;
        h4{
            width: 100%;
            overflow: hidden;
            padding-bottom: 18px;
            border-bottom: 1px solid #e5e5e5;
            margin-bottom: 20px;
            .title{
                font-size: 24px;
                color: #333333;
                font-weight: 800;
                display: inline;
            }
            .text{
                font-size: 12px;
                color: #808080;
                margin-left: 22px;
                display: inline;
            }
            a{
                float: right;
                color:#327fff;
                font-size: 16px;
                img{
                    width:16px;
                    height: 16px;
                    margin-right: 10px;
                    position: relative;
                    top: -3px;
                }
            }
        }
        .cominfor_infoleft{
            width: 50%;
            overflow: hidden;
            border-right: 1px solid #e5e5e5;
            padding-right: 18px;
            float: left;
            .infoleft_p{
                width: 100%;
                height: 16px;
                margin-bottom: 24px;
                .status{
                    color: #fe5039;
                    font-size: 16px;
                    margin-right: 10px;
                    line-height: 16px;
                    position: relative;
                    top:-3px;
                }
                .title{
                    color: #5d5d5d;
                    font-size: 16px;
                    margin-right: 50px;
                    width: 206px;
                    display:inline-block;
                    line-height: 16px;
                    white-space: nowrap;  
                    text-overflow:ellipsis; 
                    overflow:hidden;
                }
                .time{
                    color:#a9a9a9;
                    font-size: 15px;
                }
                &:hover{
                    .status{
                       color: #327fff;
                    }
                    .title{
                        color: #327fff;
                    }
                    .time{
                        color: #327fff;
                    }
                }
            }
        }
        .cominfor_inforight{
            width: 50%;
            overflow: hidden;
            padding-left: 48px;
            float: left;
            .inforight_p{
                width: 100%;
                height: 16px;
                margin-bottom: 24px;
                .status{
                    color: #327fff;
                    font-size: 16px;
                    margin-right: 10px;
                    line-height: 16px;
                    position: relative;
                    top:-3px;
                }
                .title{
                    color: #5d5d5d;
                    font-size: 16px;
                    margin-right: 50px;
                    width: 206px;
                    display:inline-block;
                    line-height: 16px;
                    white-space: nowrap;  
                    text-overflow:ellipsis; 
                    overflow:hidden;
                }
                .time{
                    color:#a9a9a9;
                    font-size: 15px;
                }
                &:hover{
                    .status{
                       color: #327fff;
                    }
                    .title{
                        color: #327fff;
                    }
                    .time{
                        color: #327fff;
                    }
                }
            }
        }
    }
    .cominfor_she{
        width: 1180px;
        overflow: hidden;
        margin: 0 auto;
        background: white;
        box-shadow: #d2d4db 0 0 20px;
        padding:30px 44px 0px 44px;
        margin-bottom: 25px;
        background-image: url('../assets/images/tabletop.png');
        background-size: 100% 100%;
        h4{
            width: 100%;
            overflow: hidden;
            padding-bottom: 18px;
            border-bottom: 1px solid #e5e5e5;
            margin-bottom: 20px;
            .title{
                font-size: 24px;
                color: #333333;
                font-weight: 800;
                display: inline;
            }
            .text{
                font-size: 12px;
                color: #808080;
                margin-left: 22px;
                display: inline;
            }
            a{
                float: right;
                color:#327fff;
                font-size: 16px;
            }
        }
        .cominfor_shebottom{
            width: 100%;
            overflow: hidden;
            padding-bottom: 54px;
            .shebottomleft{
                width: 360px;
                overflow: hidden;
                float: left;
                h6{
                    font-size: 16px;
                    color:black;
                    font-weight: 800;
                    margin-bottom: 10px;
                    span{
                        color:#666666;
                        font-size: 16px;
                        font-weight: 100;
                    }
                }
                .she_ol{
                    margin-bottom: 60px;
                }
                .she_ol .border{
                    width: 100%;
                    margin-top: 24px;
                    color: #333333;
                    font-size: 17px;
                    display:block;
                    white-space: nowrap;
                    text-overflow: ellipsis;
                    overflow: hidden;
                    span{
                        border-radius: 100%;
                        background: #333333;
                        width: 16px;
                        height: 16px;
                        margin-right: 15px;
                        display:inline-block;
                        position: relative;
                        top: 2px;
                    }
                    &:hover{
                        color: #327fff;
                        span{
                            background: #327fff;
                        }
                    }
                }
                a{
                    color: #333;
                    font-size: 16px;
                }
            }
            .shebottomcen{
                width: 360px;
                overflow: hidden;
                float: left;
                h6{
                    font-size: 16px;
                    color:black;
                    font-weight: 800;
                    margin-bottom: 10px;
                    span{
                        color:#666666;
                        font-size: 16px;
                        font-weight: 100;
                    }
                }
                .she_ol{
                    margin: 18px 0;
                    overflow: hidden;
                    .imgshe{
                        width: 160px;
                        height: 268px;
                        box-shadow: #d2d4db 0 0 20px;
                        background: white;
                        border-radius: 10px;
                        float: left;
                        position: relative;
                        margin-top: 10px;
                        margin-bottom: 10px;
                        &:nth-child(1){
                          margin-left: 10px;
                          margin-right: 15px;
                        }
                        h2{
                            width: 70px;
                            height: 24px;
                            background: #01beb5;
                            color: white;
                            font-size: 13px;
                            text-align: center;
                            line-height: 24px;
                            position: absolute;
                            left:0;
                            top:6px;
                        }
                        .imgshe1{
                            width: 100%;
                            position: absolute;
                            top:0;
                            left: 0;
                            height: 200px;
                            text-align: center;
                            vertical-align: middle;
                            img{
                                width: 117px;
                                height: 74px;
                                margin-top: 70px;
                                margin-bottom: 50px;
                                object-fit: cover;
                            }
                        }
                        .title{
                            font-size: 14px;
                            color: #59493f;
                            width: 100%;
                            padding-left: 13px;
                            padding-top: 200px;
                        }
                        .time{
                            color: #666666;
                            font-size: 12px;
                            margin-top: 5px;
                            padding-left: 13px;
                        }
                    }
                }
                a{
                    color: #333;
                    font-size: 16px;
                }
            }
            .shebottomright{
                width: 275px;
                overflow: hidden;
                float: left;
                margin-left: 95px;
                h6{
                    font-size: 16px;
                    color:black;
                    font-weight: 800;
                    margin-bottom: 20px;
                    span{
                        color:#666666;
                        font-size: 16px;
                        font-weight: 100;
                    }
                }
                .all_ol{
                    overflow: hidden;
                    margin-bottom: 18px;
                }
                .she_ol{
                    width: 126px;
                    height: 130px;
                    box-shadow: #d2d4db 0 0 20px;
                    background: white;
                    border-radius: 5px;
                    float: left;
                    margin: 5px;
                    display:block;
                    margin-bottom:8px; 
                    text-align: center;
                    img{
                        width:76px;
                        height: 44px;
                        margin-top: 26px;
                        margin-bottom: 26px;
                    }
                    .title{
                        font-size: 14px;
                        color:#5d5d5d;
                        white-space: nowrap;
                        text-overflow: ellipsis;
                        overflow: hidden;
                    }
                }
                a{
                    color: #333;
                    font-size: 16px;
                }
            }
        }
    }
    .cominfor_type{
        width: 1180px;
        overflow: hidden;
        margin: 0 auto;
        background: white;
        box-shadow: #d2d4db 0 0 20px;
        padding:30px 44px 0px 44px;
        margin-bottom: 25px;
        padding-bottom: 58px;
        background-image: url('../assets/images/table.png');
        background-size: 100% 100%;
        h4{
            width: 100%;
            overflow: hidden;
            padding-bottom: 18px;
            border-bottom: 1px solid #e5e5e5;
            margin-bottom: 20px;
            .title{
                font-size: 24px;
                color: #333333;
                font-weight: 800;
                display: inline;
            }
            .text{
                font-size: 12px;
                color: #808080;
                margin-left: 22px;
                display: inline;
            }
            a{
                float: right;
                color:#327fff;
                font-size: 16px;
            }
        }
        .covertable{
            text-align: center;
            width: 100%;
            thead{
                tr{
                  padding-bottom:24px;
                  border-bottom: 1px solid #dcdcdc;
                  th{
                      color: #333;
                      height: 40px;
                      padding-left: 30px;
                      text-align: left;
                      width: 20%;
                  }
                  :nth-child(2){
                    padding-left: 5px;
                  }
                  :nth-child(3){
                    padding-left: 0px;
                  }
                  :nth-child(5){
                    padding-left: 50px;
                  }
                }
            }
            tbody{
                tr{
                    height: 55px;
                    line-height: 55px;
                    border-bottom: 1px solid #e5e5e5;
                    &:first-child{
                       margin-top: 20px;
                    }
                    td{
                        text-align: left;
                        // padding-left: 50px;
                        box-sizing: border-box;
                        span{
                            color: #fe5039;
                            font-weight: 800;
                        }
                    }
                    :nth-child(3){
                      padding-left: 15px;
                    }
                }
            }
        }
    }
    .cominfor_auto{
        width: 1180px;
        overflow: hidden;
        margin: 0 auto;
        background: white;
        box-shadow: #d2d4db 0 0 20px;
        padding:30px 44px 0px 44px;
        margin-bottom: 25px;
        padding-bottom: 58px;
        h4{
            width: 100%;
            overflow: hidden;
            padding-bottom: 18px;
            border-bottom: 1px solid #e5e5e5;
            margin-bottom: 20px;
            .title{
                font-size: 24px;
                color: #333333;
                font-weight: 800;
                display: inline;
            }
            .text{
                font-size: 12px;
                color: #808080;
                margin-left: 22px;
                display: inline;
            }
            a{
                float: right;
                color:#327fff;
                font-size: 16px;
            }
        }
        .cominfor_autool{
            width: 100%;
            height: 40px;
            .autool{
                width: 350px;
                height: 202px;
                float: left;
                background-image: url('../assets/images/tablebottom.png');
                background-size: 100% 100%;
                text-align: center;
                color: white;
                &:nth-child(2){
                    margin: 0 17px;
                }
                h3{
                    font-size: 34px;
                    margin-top: 50px;
                    font-weight: 800;
                }
                p{
                    margin-top: 8px;
                }
                a{
                    width: 130px;
                    height: 38px;
                    display: block;
                    background: rgba(0, 0, 0, 0.5);
                    color: white;
                    line-height: 38px;
                    margin-top: 15px;
                    border-radius: 5px;
                    margin-left: 110px;
                }
            }
        }
    }
  }
</style>
