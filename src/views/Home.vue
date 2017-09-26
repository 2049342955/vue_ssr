<template>
  <article class="home">
    <Swiper :pagination-visible="true" :loop="true">
      <img class="swiper_one" :src="n" v-for="n in banners">
    </Swiper>
    <div class="title">
      <div class="text">
        <div class="select_coin" ref="select">
          <div class="now">
            <img :src="coin[no].img" alt="">
            <span class="text" @click="openSelect" title="0">{{coin[no].title}}</span>
            <span class="arrow"></span>
          </div>
          <div class="other">
            <div :class="['item', {active: k==no}]" v-for="c,k in coin">
              <img :src="c.img" alt="">
              <span class="text" @click="selectCoin" :title="k">{{coin[k].title}}</span>
              <span class="arrow" v-if="k===0"></span>
            </div>
          </div>
        </div>
        <div v-for="i,k in info">
          <template v-if="k === 'difficulty'">挖矿难度：{{i|format}}</template>
          <template v-else>挖矿难度：{{i}}</template>
        </div>
      </div>
      <div class="chart_show">
        <div class="chart_main">
          <div class="myChart"></div>
          <div class="myText">
            <h1>
              <span>{{coin[no].title}}</span>
              <span>{{coin[no].value}}</span>
            </h1>
            <div class="address">
              <p>挖矿服务地址：</p>
              <p v-for="a in coin[no].address">{{a}}</p>
            </div>
            <div class="data">
              <div class="item" v-for="d,k in coin[no].data">
                <span>{{k}}</span>
                <span>{{d}}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="ad">
      <div class="main">
        <h1>{{ad.title}}</h1>
        <p>{{ad.desc}}</p>
        <div class="list">
          <div class="item" v-for="a,k in ad.items">
            <img :src="a.img" alt="">
            <h3>{{a.title}}</h3>
            <div class="line"></div>
            <p>{{a.desc}}</p>
          </div>
        </div>
      </div>
    </div>
    <div class="cloud_list">
      <h2>
        <span>云矿机推荐</span>
        <span>由保全网提供存证、保全服务</span>
        <router-link to="/cloudCompute/shop">更多云矿机 ></router-link>
      </h2>
      <table>
        <tr>
          <th v-for="n in nav">{{n}}</th>
        </tr>
        <tr v-for="l in list">
          <td v-for="v,k in l" v-if="k!=='status'">
            <template v-if="k==='name'"><img :src="fire" alt="hot" v-if="l.status">{{v}}</template>
            <template v-else-if="k==='num'">{{v}}台</template>
            <template v-else-if="k==='price'">{{v|format}}元</template>
            <template v-else-if="k==='opr'"><a href="">{{v}}</a></template>
            <template v-else>{{v}}</template>
          </td>
        </tr>
      </table>
    </div>
    <div class="ad_img">
      <img :src="adImg" alt="">
      <div class="text">
        <h2>算力服务器一站式服务平台</h2>
        <p>通过设备集群式部署，为用户提供一站式算力服务器挖矿服务<br>包括矿场投资，算力服务器托管，算力服务器采购、算力租赁等，让用户轻松体验挖矿乐趣</p>
      </div>
    </div>
    <div class="web_info">
      <div class="main">
        <div class="box">
          <h3>
            <span class="icon"></span>
            <span class="text">网站动态</span>
            <router-link to="">查看更多 ></router-link>
          </h3>
          <div class="list">
            <router-link to="" class="item" v-for="a,k in activity" :key="k">
              <span class="icon"></span>
              <span class="line"></span>
              <span class="text">{{a.title}}</span>
              <span class="date">{{a.date}}</span>
            </router-link>
          </div>
        </div>
        <div class="box">
          <h3>
            <span class="icon"></span>
            <span class="text">产品公告</span>
            <router-link to="">查看更多 ></router-link>
          </h3>
          <div class="list">
            <router-link to="" class="item" v-for="a,k in notice" :key="k">
              <span class="icon"></span>
              <span class="line"></span>
              <span class="text">{{a.title}}</span>
              <span class="date">{{a.date}}</span>
            </router-link>
          </div>
        </div>
      </div>
    </div>
    <div class="partner">
      <div class="box">
        <h3>战略合作伙伴</h3>
        <div class="list">
          <div class="item" v-for="i in 12">
            <img class="img" :src="partner[0].img" alt="">
            <img class="img_hover" :src="partner[0].imgHover" alt="">
          </div>
        </div>
      </div>
    </div>
  </article>
</template>

<script>
  import api from '../util/function'
  import Swiper from '../components/common/Swipe'
  import echarts from 'echarts/lib/echarts'
  import 'echarts/lib/chart/line'
  export default {
    components: {
      Swiper
    },
    data () {
      return {
        banners: [require('@/assets/images/banner.jpg'), require('@/assets/images/banner.jpg')],
        info: {transfer: '1bt=22704.98元', dayProfit: '今日每日预计收入：5058元', yearProfit: '推算年化收益≈10%', difficulty: 1103400932964},
        coin: [{title: 'Bitcoin', img: require('@/assets/images/icons/bit.png'), value: '1571.18 PH/s', address: ['stratum+tcp://stratum.suanli.com:3333', 'stratum+tcp://stratum.suanli.com:443', 'stratum+tcp://stratum.suanli.com:25'], data: {'总幸运': '100%', '全网难度': 1103400932964, 'Block总数': 29447, '有效矿工数': 163721}}, {title: 'BCC', img: require('@/assets/images/icons/bcc.png'), value: '1571.18 PH/s', address: ['stratum+tcp://stratum.suanli.com:3333', 'stratum+tcp://stratum.suanli.com:443', 'stratum+tcp://stratum.suanli.com:25'], data: {'总幸运': '100%', '全网难度': 1103400932964, 'Block总数': 29447, '有效矿工数': 163721}}, {title: 'Ethereum', img: require('@/assets/images/icons/eth.png'), value: '1571.18 PH/s', address: ['stratum+tcp://stratum.suanli.com:3333', 'stratum+tcp://stratum.suanli.com:443', 'stratum+tcp://stratum.suanli.com:25'], data: {'总幸运': '100%', '全网难度': 1103400932964, 'Block总数': 29447, '有效矿工数': 163721}}, {title: 'ETC', img: require('@/assets/images/icons/etc.png'), value: '1571.18 PH/s', address: ['stratum+tcp://stratum.suanli.com:3333', 'stratum+tcp://stratum.suanli.com:443', 'stratum+tcp://stratum.suanli.com:25'], data: {'总幸运': '100%', '全网难度': 1103400932964, 'Block总数': 29447, '有效矿工数': 163721}}],
        no: 0,
        ad: {title: '全国首家算力产业链综合服务平台', desc: '算力网是中国信息化推进联盟区块链实验室的推进项目，为区块链算力产业链提供全系列服务', items: [{title: '项目合规', desc: '所有项目出具法律意见书并公开法律意见书', img: require('@/assets/images/icons/icon1.png')}, {title: '用电合规', desc: '项目为政府招商引资项目，全部国网供电，电力稳定持久', img: require('@/assets/images/icons/icon2.png')}, {title: '透明收益', desc: '全流程产业链对接，信息透明，避免踩坑', img: require('@/assets/images/icons/icon3.png')}, {title: '全程存证', desc: '对接保全网区块链电子凭证技术，实现全部在线协议的合规有效', img: require('@/assets/images/icons/icon4.png')}, {title: '算力管家', desc: '为用户投资的每一份算力，提供贴心的远程管家服务', img: require('@/assets/images/icons/icon5.png')}]},
        nav: ['项目名称', '出售总数', '购买单价', '最小购买单位', '每台算力', '算力类型', '项目进度', '操作'],
        list: [{name: 'Avalon(阿瓦隆A6)', num: 100, price: 12000, unit: '1台', compute: '9T', computeType: 'BTC', progress: '80%', opr: '申购', status: 'hot'}, {name: 'Avalon(阿瓦隆A6)', num: 100, price: 12000, unit: '1台', compute: '9T', computeType: 'BTC', progress: '80%', opr: '申购', status: 'hot'}, {name: 'Avalon(阿瓦隆A6)', num: 100, price: 12000, unit: '1台', compute: '9T', computeType: 'BTC', progress: '80%', opr: '申购', status: 'hot'}, {name: 'Avalon(阿瓦隆A6)', num: 100, price: 12000, unit: '1台', compute: '9T', computeType: 'BTC', progress: '80%', opr: '申购'}, {name: 'Avalon(阿瓦隆A6)', num: 100, price: 12000, unit: '1台', compute: '9T', computeType: 'BTC', progress: '80%', opr: '申购'}],
        fire: require('@/assets/images/fire.png'),
        adImg: require('@/assets/images/ad.jpg'),
        activity: [{title: '算力网关于比特币分叉处理方案的公告', date: '2017-07-19'}, {title: '算力网关于比特币分叉处理方案的公告', date: '2017-07-19'}, {title: '算力网关于比特币分叉处理方案的公告', date: '2017-07-19'}, {title: '算力网关于比特币分叉处理方案的公告', date: '2017-07-19'}, {title: '算力网关于比特币分叉处理方案的公告', date: '2017-07-19'}],
        notice: [{title: '算力网新产品云矿机第一期产品即将上线.', date: '2017-07-19'}, {title: '算力网新产品云矿机第一期产品即将上线.', date: '2017-07-19'}, {title: '算力网新产品云矿机第一期产品即将上线.', date: '2017-07-19'}, {title: '算力网新产品云矿机第一期产品即将上线.', date: '2017-07-19'}, {title: '算力网新产品云矿机第一期产品即将上线.', date: '2017-07-19'}],
        partner: [{img: require('@/assets/images/partner/partner_grey1.jpg'), imgHover: require('@/assets/images/partner/partner1.jpg')}]
      }
    },
    mounted () {
      this.drawLine()
      // var w = document.querySelector('body').clientWidth
      // this.width = w > 700 ? 15 : w < 440 ? w < 400 ? -15 : -8 : 0
    },
    methods: {
      drawLine () {
        let myChart = echarts.init(document.querySelector('.myChart'))
        var now = +new Date(2010, 9, 3)
        var oneDay = 24 * 3600 * 1000
        var value = Math.random() * 1000
        function randomData () {
          now = new Date(+now + oneDay)
          value = value + Math.random() * 21 - 10
          return {
            name: now.toString(),
            value: [
              [now.getFullYear(), now.getMonth() + 1, now.getDate()].join('/'),
              Math.round(value)
            ]
          }
        }
        function getData () {
          var data = []
          for (var i = 0; i < 1000; i++) {
            data.push(randomData())
          }
          return data
        }
        myChart.setOption({
          color: '#fff',
          title: {
            text: '动态数据 + 时间坐标轴'
          },
          grid: {
            show: true,
            borderColor: '#3c3c49',
            left: '7%',
            bottom: 80
          },
          tooltip: {
            trigger: 'axis',
            formatter: function (params) {
              params = params[0]
              var date = new Date(params.name)
              return date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear() + ' : ' + params.value[1]
            },
            axisPointer: {
              animation: false
            }
          },
          xAxis: {
            type: 'time',
            splitLine: {
              lineStyle: {
                color: '#3c3c49'
              }
            },
            axisLabel: {
              color: '#e9e9eb'
            },
            axisTick: {
              length: 0
            }
          },
          yAxis: {
            type: 'value',
            boundaryGap: [0, '100%'],
            splitLine: {
              lineStyle: {
                color: '#3c3c49'
              }
            },
            axisLabel: {
              color: '#e9e9eb'
            },
            axisTick: {
              length: 0
            }
          },
          series: [{
            name: '模拟数据',
            type: 'line',
            showSymbol: false,
            hoverAnimation: false,
            data: getData(),
            lineStyle: {
              normal: {
                color: '#518abb'
              }
            }
          }]
        })
        // setInterval(function () {
        //   for (var i = 0; i < 5; i++) {
        //     data.shift()
        //     data.push(randomData())
        //   }
        //   myChart.setOption({
        //     series: [{
        //       data: data
        //     }]
        //   })
        // }, 1000)
      },
      openSelect (e) {
        var ele = this.$refs['select'].classList
        if (ele.contains('active')) {
          ele.remove('active')
        } else {
          ele.add('active')
        }
      },
      selectCoin (e) {
        this.no = e.target.title
        var ele = this.$refs['select'].classList
        if (ele.contains('active')) {
          ele.remove('active')
        } else {
          ele.add('active')
        }
        this.drawLine()
      }
    },
    filters: {
      format: api.readable
    }
  }
</script>

<style type="text/css" lang="scss">
  @import '../assets/css/style.scss';
  .title{
    @include position(490)
    bottom:auto;
    height:60px;
    background:#183473;
    .text{
      @include main
      @include flex(space-between)
      color:$white;
      line-height:60px;
      font-size: 16px;
      .select_coin{
        position: relative;
        img{
          @include block(18)
        }
        .now{
          position: relative;
          width:140px;
          @include flex
          @include gap(10,h)
          cursor: pointer;
          .text{
            flex:1;
            padding-left:10px
          }
          .arrow{
            @include triangle(bottom)
          }
        }
        .other{
          @include position
          display: none;
          z-index: 4;
          transition: all 1s;
          .item{
            @include flex
            @include gap(10,h)
            cursor: pointer;
            background:#232428;
            .text{
              flex:1;
              padding-left:10px
            }
            &:hover,&.active{
              background:#44444f
            }
            .arrow{
              @include triangle(bottom)
            }
          }
        }
        &.active{
          .now{
            background:#232428;
            &:hover{
              background:#44444f
            }
          }
          .other{
            display: block;
          }
        }
      }
    }
    .chart_show{
      @include position()
      top:100%;
      bottom:auto;
      background: #2e2e3d;
      z-index: 3;
      display: none;
      .chart_main{
        @include main
        @include flex
        .myChart{
          width:640px;
          height:400px;
        }
        .myText{
          width:leave(640);
          padding-left:100px;
          color:$white;
          font-size: 16px;
          line-height: 1.6;
          h1{
            @include flex(space-between)
            font-size: 30px;
            font-weight: bold;
            padding-bottom: 10px
          }
          h1,.address{
            border-bottom: 1px solid #59a1d9;
            margin-bottom: 13px
          }
          .address{
            padding-bottom: 30px
          }
          .data{
            .item{
              @include flex(space-between)
            }
          }
        }
      }
    }
    &:hover .chart_show{
      display: block;
    }
  }
  .ad{
    background:#f7f8fa;
    border-bottom:1px solid $border;
    margin-bottom:65px;
    .main{
      @include gap(20,v)
      @include main
      height:293px;
      line-height: 2;
      h1,p{
        text-align: center
      }
      h1{
        font-size: 30px
      }
      p{
        font-size: 16px
      }
      .list{
        @include flex
        border:1px solid $border;
        border-bottom:0;
        margin-top:30px;
        .item{
          position: relative;
          height: 150px;
          flex:1;
          padding:20px;
          &:not(:last-child){
            border-right:1px solid $border;
          }
          h3{
            font-size: 20px;
          }
          .line{
            width:45px;
            border-bottom:2px solid $blue;
            margin-top:5px;
            margin-bottom:7px;
          }
          p{
            position: relative;
            text-align: left;
            line-height: 1.5;
            font-size: 14px;
            color:$light_text;
            z-index: 2;
          }
          img{
            position: absolute;
            top:calc(50% - 35px);
            right:20px;
            @include block(70)
          }
          &:hover{
            background: $white;
            h3{
              color:$blue
            }
          }
        }
      }
        
    }
  }
  .cloud_list{
    @include main
    margin-bottom:60px;
    h2{
      @include flex
      @include gap(15,v,margin)
      span:nth-child(1){
        font-size: 24px;
        font-weight: bold;
      }
      span:nth-child(2){
        margin-left:20px;
        font-size: 16px;
        background: linear-gradient(to right, #b28850, #cfa972);
        color:$white;
        padding:3px 10px
      }
      a{
        font-size: 16px;
        flex:1;
        text-align: right;
        color:#999;
        &:hover{
          color:$blue
        }
      }
    }
    table{
      width:100%;
      text-align: center;
      th{
        font-weight: normal;
        font-size: 18px;
        line-height: 65px;
        background: #ecf3ff
      }
      td{
        font-size: 16px;
        color:$light_text;
        line-height: 75px;
        border-bottom: 1px solid $border;
        img{
          width:13px;
          height:20px;
          vertical-align: middle;
          margin-right:5px
        }
      }
      tr:not(:first-child){
        &:hover{
          background: #f4f4f4
        }
        td:nth-child(3),a{
          color:$orange
        }
        td:last-child{
          a{
            width:130px;
            padding:5px 25px;
            border-radius:5px
          }
        }
        &:hover a{
          background:$orange;
          color:$white
        }
      }
    }
  }
  .ad_img{
    position: relative;
    height:315px;
    margin-bottom:60px;
    @include flex(flex-start,center)
    img{
      @include position
      height:100%;
      object-fit:cover;
      z-index: -1;
    }
    .text{
      @include main
      h2{
        font-size: 30px;
        font-weight: bold;
        margin-bottom:20px;
        color:$white
      }
      p{
        font-size: 16px;
        color:#d7d8d9
      }
    }
  }
  .web_info{
    border-top:1px solid $border;
    border-bottom:1px solid $border;
    margin-bottom:60px;
    .main{
      @include flex
      @include main
      .box{
        flex:1;
        padding-bottom:5px;
        &:first-child{
          padding-right:60px;
          border-right: 1px solid $border;
        }
        &:last-child{
          padding-left:60px;
        }
        h3{
          @include flex(space-between,center)
          padding-top:25px;
          margin-bottom:20px;
          .icon{
            width:3px;
            height:20px;
            background: $blue;
          }
          .text{
            flex:1;
            font-size: 24px;
            padding-left:20px;
          }
          a{
            color:#999;
            font-size: 14px;
            &:hover{
              color:$blue
            }
          }
        }
        .list{
          .item{
            position: relative;
            color:$light_text;
            padding-bottom:25px;
            @include flex(space-between)
            .icon{
              @include block(10,50%)
              border:1px solid #e8e8e8;
              background:#f2f2f2
            }
            .line{
              @include position(15,5,-6,auto)
              width:1px;
              background:#eaeaea;
              z-index: -1;
            }
            .text{
              flex:1;
              padding-left:14px;
            }
            .date{
              color:#999
            }
            &:hover{
              .icon{
                border-color:$orange;
                background:$white
              }
              .text{
                color:$orange
              }
            }
          }
        }
      }
    }
  }
  .partner{
    .box{
      @include main
      text-align: center;
      margin-bottom:60px;
      h3{
        font-size: 24px;
        margin-bottom:30px
      }
      .list{
        @include row(6,0)
        border-left:1px solid $border;
        border-top:1px solid $border;
        .item{
          height:70px;
          border-right:1px solid $border;
          border-bottom:1px solid $border;
          @include flex(center)
          img{
            width:81px;
            height:32px
          }
          .img,&:hover .img_hover{
            display: inline;
          }
          .img_hover,&:hover img{
            display: none;
          }
        }
      }
    }
  }
</style>
