<template>
  <article class="home">
    <Swiper :pagination-visible="true" :loop="true">
      <img class="swiper_one" :src="n" v-for="n in banners">
    </Swiper>
    <div class="title">
      <div class="text">
        <select name="" id="">
          <option value="">Bitcoin</option>
          <option value="">BCC</option>
          <option value="">Ethereum</option>
          <option value="">ETC</option>
        </select>
        <div v-for="i in info">{{i}}</div>
      </div>
    </div>
    <div class="chart_show">
      <div class="chart_main">
        <div class="myChart"></div>
        <div class="myText"></div>
      </div>
    </div>
  </article>
</template>

<script>
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
        info: {transfer: '1bt=22704.98元', dayProfit: '今日每日预计收入：5058元', yearProfit: '推算年化收益≈10%', difficulty: 1103400932964}
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
            borderColor: '#3c3c49'
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
            axisLine: {
              lineStyle: {
                color: '#e9e9eb'
              }
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
            axisLine: {
              lineStyle: {
                color: '#e9e9eb'
              }
            },
            nameTextStyle: {
              color: '#fff'
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
        setInterval(function () {
          for (var i = 0; i < 5; i++) {
            data.shift()
            data.push(randomData())
          }
          myChart.setOption({
            series: [{
              data: data
            }]
          })
        }, 1000)
      }
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
    }
  }
  .chart_show{
    background: #2e2e3d;
    .chart_main{
      @include main
      @include flex
      .myChart{
        width:55%;
        height:400px;
      }
      .myText{
        width:45%
      }
    }
  }
</style>
