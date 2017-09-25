<template>
  <article class="home">
    <Swiper :pagination-visible="true" :loop="true">
      <img class="swiper_one" :src="n" v-for="n in banners">
    </Swiper>
    <div class="title">
      <div class="text">
        <select name="" id="" @change="changeCoin">
          <option value="0" selected>Bitcoin</option>
          <option value="1">BCC</option>
          <option value="2">Ethereum</option>
          <option value="3">ETC</option>
        </select>
        <div v-for="i in info">{{i}}</div>
      </div>
      <div class="chart_show">
        <div class="chart_main">
          <div class="myChart"></div>
          <div class="myText">
            <h1>
              <span>{{text[no].title}}</span>
              <span>{{text[no].value}}</span>
            </h1>
            <div class="address">
              <p>挖矿服务地址：</p>
              <p v-for="a in text[no].address">{{a}}</p>
            </div>
            <div class="data">
              <div class="item" v-for="d,k in text[no].data">
                <span>{{k}}</span>
                <span>{{d}}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="ad">
      <div class="item" v-for="a in ad">
        <h1>{{a.title}}</h1>
        <p>{{a.desc}}</p>
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
        text: [{title: 'Bitcoin', value: '1571.18 PH/s', address: ['stratum+tcp://stratum.suanli.com:3333', 'stratum+tcp://stratum.suanli.com:443', 'stratum+tcp://stratum.suanli.com:25'], data: {'总幸运': '100%', '全网难度': 1103400932964, 'Block总数': 29447, '有效矿工数': 163721}}, {title: 'BCC', value: '1571.18 PH/s', address: ['stratum+tcp://stratum.suanli.com:3333', 'stratum+tcp://stratum.suanli.com:443', 'stratum+tcp://stratum.suanli.com:25'], data: {'总幸运': '100%', '全网难度': 1103400932964, 'Block总数': 29447, '有效矿工数': 163721}}, {title: 'Ethereum', value: '1571.18 PH/s', address: ['stratum+tcp://stratum.suanli.com:3333', 'stratum+tcp://stratum.suanli.com:443', 'stratum+tcp://stratum.suanli.com:25'], data: {'总幸运': '100%', '全网难度': 1103400932964, 'Block总数': 29447, '有效矿工数': 163721}}, {title: 'ETC', value: '1571.18 PH/s', address: ['stratum+tcp://stratum.suanli.com:3333', 'stratum+tcp://stratum.suanli.com:443', 'stratum+tcp://stratum.suanli.com:25'], data: {'总幸运': '100%', '全网难度': 1103400932964, 'Block总数': 29447, '有效矿工数': 163721}}],
        no: 0,
        ad: [{title: '便捷与优惠的云算力租赁服务平台', desc: '算力网致力于为用户打造便捷的云算力租赁服务流程通过设备集群式部署，为用户提供专业全面的云算力维护，让用户轻松体验挖矿乐趣'}],
        nav: ['项目名称', '出售总数', '购买单价', '最小购买单位', '每台算力', '算力类型', '项目进度', '操作'],
        list: [{name: 'Avalon(阿瓦隆A6)', num: 100, price: 12000, unit: '1台', compute: '9T', computeType: 'BTC', progress: '80%', opr: '申购', status: 'hot'}, {name: 'Avalon(阿瓦隆A6)', num: 100, price: 12000, unit: '1台', compute: '9T', computeType: 'BTC', progress: '80%', opr: '申购', status: 'hot'}, {name: 'Avalon(阿瓦隆A6)', num: 100, price: 12000, unit: '1台', compute: '9T', computeType: 'BTC', progress: '80%', opr: '申购', status: 'hot'}, {name: 'Avalon(阿瓦隆A6)', num: 100, price: 12000, unit: '1台', compute: '9T', computeType: 'BTC', progress: '80%', opr: '申购'}, {name: 'Avalon(阿瓦隆A6)', num: 100, price: 12000, unit: '1台', compute: '9T', computeType: 'BTC', progress: '80%', opr: '申购'}],
        fire: require('@/assets/images/fire.png')
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
        var data = []
        var now = +new Date(1997, 9, 3)
        var oneDay = 24 * 3600 * 1000
        var value = Math.random() * 1000
        for (var i = 0; i < 1000; i++) {
          data.push(randomData())
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
            data: data,
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
      changeCoin (e) {
        this.no = e.target.value
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
      &,select{
        color:$white;
        line-height:60px;
        font-size: 16px;
      }
      select{
        background: #183473
      }
    }
    .chart_show{
      @include position()
      top:100%;
      bottom:auto;
      background: #2e2e3d;
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
    @include gap(20,v)
    @include main
    height:400px;
    line-height: 2;
    .item{
      text-align: center;
      h1{
        font-size: 30px;
      }
      p{
        font-size: 16px;
      }
    }
  }
  .cloud_list{
    @include main
    margin-bottom:100px;
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
        color:#999
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
</style>
