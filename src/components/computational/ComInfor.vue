<template>
  <div class="cominfor">
    <div class="cominfor_header">
      <div class="cominfor_headercon">
        <div class="cominfo_headerleft">
          <div class="red">
            <h1>算力资讯</h1>
            <p>随时获取最新行业讯息</p>
          </div>
          <div class="olbottom">
            <div v-for="n, k in headerlist" class="ollist">
              <div class="oltitle">{{n.title}}</div>
              <div class="rou">
                  <router-link :to="d.path" v-for="d, m in n.route">{{d.name}}</router-link>
              </div>
            </div>
          </div>
        </div>
        <div class="cominfo_headerright">
          <div class="bigtop">
            <div class="bigimg">
                <img :src="n.big" v-for="n, k in bigimglists[0].bigimglist" class="teimg"/> 
            </div>
            <div class="bigtab">
                <div class="bighover" v-for="d,m in bigimglists[0].bigcontent" :class="{'active': show === m}" @mouseover="hoverwhite(m)">
                    <h5>{{d.title}}</h5>
                    <p>{{d.name}}</p>
                </div>
            </div>
          </div>
          <div class="bigbottom">
            <div class="numbig" v-for="n, m in miners">
              <img :src="n.big"/>
              <h4>{{n.title}}</h4>
              <router-link to="#">{{n.route}}</router-link>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="cominfor_news">
      <img src="../../assets/images/information7.png"/>
      <div class="scroll">
        还是不行还是不行还是想
      </div>
    </div>
    <div class="cominfor_info">
      <h4>
        <p class="title">交易信息</p>
        <p class="text">提供实时二手平台信息</p>
        <!-- <router-link to="#"><img src="../../assets/images/fabu.png"/>发布消息</router-link> -->
      </h4>
      <div class="cominfor_infoleft">
        <p v-for="n,k in infoleft" class="infoleft_p">
            <span class="status">[{{n.status}}]</span>
            <span class="title">{{n.title}}</span>
            <span class="time">{{n.time}}</span>
        </p>
      </div>
      <div class="cominfor_inforight">
        <p v-for="n,k in inforight" class="inforight_p">
            <span class="status">[{{n.status}}]</span>
            <span class="title">{{n.title}}</span>
            <span class="time">{{n.time}}</span>
        </p>
      </div>
    </div>
    <div class="cominfor_she">
      <h4>
        <p class="title">设备之家</p>
        <p class="text">主流 · 测评 · 博物馆</p>
        <router-link to="#">了解更多 ></router-link>
      </h4>
      <div class="cominfor_shebottom">
        <div class="shebottomleft">
          <h6>【主流厂商】 <span>全面测评</span></h6>
          <div class="she_ol">
            <p class="border" v-for="n, k in sheol1"><span></span>{{n.title}}</p>
          </div>
          <router-link to="#">全部厂商介绍 ></router-link>
        </div>
        <div class="shebottomcen">
          <h6>【矿机测评】 <span>全面测评</span></h6>
          <div class="she_ol">
            <div class="imgshe" v-for="n, k in sheol2">
              <h2>{{n.enlish}}</h2>
              <div class="imgshe1">
                <img :src="n.big"/>
              </div>
              <p class="title">{{n.title}}</p>
              <p class="time">{{n.time}}</p>
            </div>
          </div>
          <router-link to="#">全部测评 ></router-link>
        </div>
        <div class="shebottomright">
          <h6>【矿机博物馆】 <span>全面测评</span></h6>
          <div class="all_ol">
            <div class="she_ol" v-for="n, k in sheol3">
                <img :src="n.big"/>
                <p class="title">{{n.title}}</p>
            </div>
          </div>
          <router-link to="#">全部厂商介绍 ></router-link>
        </div>
      </div>
    </div>
    <div class="cominfor_type">
      <h4>
        <p class="title">挖矿币种</p>
        <p class="text">虚拟数字货币产生情况</p>
        <router-link to="#">了解更多 ></router-link>
      </h4>
      <table border="0"  class="covertable">
        <thead>
          <tr>
            <th v-for="n, k in tr">{{n.title}}</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="d, m in td">
            <td><span>{{d.type}}</span> - {{d.title}}</td>
            <td>¥ {{d.money}}</td>
            <td>¥ {{d.price}}</td>
            <td>{{d.num}} <span>(PH/S)</span></td>
            <td>{{d.nuit}}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="cominfor_auto">
      <h4>
        <p class="title">矿场相册</p>
        <p class="text">提供实时二手信息平台</p>
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
  export default {
    data () {
      return {
        autool: [{title: '蒙古矿场', text: '国家电网合规用电', button: '即将开放'}, {title: '山西矿场', text: '国家电网合规用电', button: '即将开放'}, {title: '辽宁矿场', text: '国家电网合规用电', button: '即将开放'}],
        tr: [{title: '币种'}, {title: '价格(元)'}, {title: '流通市值（亿元）'}, {title: '全网算力'}, {title: '单位挖矿产出'}],
        td: [{type: 'BTC', title: '比特币', money: '6885.20', price: '1147.3', num: '9642', nuit: '0.000019$/T/天 （$12.82）'}, {type: 'BTC', title: '比特币', money: '6885.20', price: '1147.3', num: '9642', nuit: '0.000019$/T/天 （$12.82）'}],
        sheol1: [{title: '以色列比特币矿机公司SP科技'}, {title: '深圳黑剑28nm矿机公司'}, {title: '深圳黑剑28nm矿机公司'}],
        sheol2: [{title: '蚂蚁S10矿机测评', time: '2017-11-20', big: require('@/assets/images/kuan.png'), enlish: 'BitCoin'}, {title: '蚂蚁S10矿机测评', time: '2017-11-20', big: require('@/assets/images/kuan.png'), enlish: 'BitCoin'}],
        sheol3: [{title: '以色列比特币矿机公司SP科技', big: require('@/assets/images/kuan.png')}, {title: '以色列比特币矿机公司SP科技', big: require('@/assets/images/kuan.png')}, {title: '以色列比特币矿机公司SP科技', big: require('@/assets/images/kuan.png')}, {title: '以色列比特币矿机公司SP科技', big: require('@/assets/images/kuan.png')}],
        headerlist: [{
          title: '设备之家',
          route: [{
            name: '矿机测评 >',
            path: '#1'
          }, {
            name: '矿机博物馆 >',
            path: '#2'
          }]
        }, {
          title: '数字货币',
          route: [{
            name: '主流币种 >',
            path: '#3'
          }, {
            name: '数字货币 >',
            path: '#4'
          }]
        }, {
          title: '二手资讯'
        }],
        bigimglists: [{
          bigimglist: [{big: require('@/assets/images/img.jpg')}, {big: require('@/assets/images/information6.png')}, {big: require('@/assets/images/information6.png')}],
          bigcontent: [{title: '不止于此', name: '开启财富新篇章'}, {title: '不止于此', name: '开启财富新篇章'}, {title: '不止于此', name: '开启财富新篇章'}]
        }],
        show: 0,
        infoleft: [{status: '出售', title: '就是你兄弟就实习那是孙晓娜数控机械那些啊是小三线', time: '2017-11-29 09:01'}, {status: '出售', title: '就是你兄弟就实习那是孙晓娜数控机械那些啊是小三线', time: '2017-11-29 09:01'}],
        inforight: [{status: '转让', title: '就是你兄弟就实习那是孙晓娜数控机械那些啊是小三线', time: '2017-11-29 09:01'}, {status: '转让', title: '就是你兄弟就实习那是孙晓娜数控机械那些啊是小三线', time: '2017-11-29 09:01'}],
        miners: [{big: require('@/assets/images/information5.png'), title: '资深矿工-设备之家', route: '前往了解 >'}, {big: require('@/assets/images/information2.png'), title: '新手矿工-数字货币', route: '前往了解 >'}, {big: require('@/assets/images/information3.png'), title: '平台交易最新资讯', route: '前往了解 >'}]
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
      },
      mounted () {
        this.hoverwhite(0)
      }
    }
  }
</script>

<style lang="scss" scoped>
  @import '../../assets/css/style.scss';
  .cominfor{
    width: 100%;
    height: 100%;
    .cominfor_header{
      width: 100%;
      height: 550px;
      background-image: url('../../assets/images/information.png');
      overflow: hidden;
      background-size: 100% 100%;
      object-fit: cover;
      padding-top: 87px;
      .cominfor_headercon{
        width: 1180px;
        margin:0 auto;
        .cominfo_headerleft{
          width: 300px;
          height: 400px;
          float: left;
          background-image: url('../../assets/images/information1.png');
          margin-right: 4px;
          position: relative;
          .red{
            position: absolute;
            width: 296px;
            height: 170px;
            background-image: url('../../assets/images/red.png');
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
                    padding-left: 25px;
                    h5{
                        color: white;
                        font-size: 14px;
                        padding-top: 25px;
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
      height: 40px;
      margin:0 auto;
      margin-top: 30px;
      img{
          width: 146px;
          height: 30px;
          float: left;
      }
      .scroll{
          width: 940px;
          float: left;
          margin-left:55px;
          height: 30px;
          line-height: 30px;
          color: #333333;
          font-size: 15px;
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
            padding-right: 38px;
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
                    width: 256px;
                    display:inline-block;
                    line-height: 16px;
                    white-space: nowrap;  
                    text-overflow:ellipsis; 
                    overflow:hidden;
                }
                .time{
                    color:#a9a9a9;
                    font-size: 16px;
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
            padding-left: 38px;
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
                    width: 256px;
                    display:inline-block;
                    line-height: 16px;
                    white-space: nowrap;  
                    text-overflow:ellipsis; 
                    overflow:hidden;
                }
                .time{
                    color:#a9a9a9;
                    font-size: 16px;
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
        background-image: url('../../assets/images/tabletop.png');
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
                    margin-top: 34px;
                    color: #333333;
                    font-size: 17px;
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
                    margin-bottom: 10px;
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
                    margin-bottom:11px; 
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
        background-image: url('../../assets/images/table.png');
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
                        span{
                            color: #fe5039;
                            font-weight: 800;
                        }
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
                background-image: url('../../assets/images/tablebottom.png');
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

