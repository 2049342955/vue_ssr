<template>
  <div class="myChart2"></div>
</template>

<script>
  import echarts from 'echarts/lib/echarts'
  import 'echarts/lib/chart/bar'
  import 'echarts/lib/component/tooltip'
  export default {
    data () {
      return {
        dataAxis: ['点', '击', '柱', '子', '或', '者', '两', '指', '在', '触', '屏', '上', '滑', '动', '能', '够', '自', '动', '缩', '放'],
        data: [220, 182, 191, 234, 290, 330, 310, 123, 442, 321, 90, 149, 210, 122, 133, 334, 198, 123, 125, 220],
        yMax: 500,
        dataShadow: []
      }
    },
    methods: {
      drawMap (chart, v) {
        for (var i = 0; i < this.data.length; i++) {
          this.dataShadow.push(this.yMax)
        }
        var myChart = echarts.init(document.querySelector('.myChart2'))
        myChart.setOption({
          xAxis: {
            data: this.dataAxis,
            axisLabel: {
              inside: true,
              textStyle: {
                color: '#fff'
              }
            },
            axisTick: {
              show: false
            },
            axisLine: {
              show: false
            },
            z: 10
          },
          yAxis: {
            axisLine: {
              show: false
            },
            axisTick: {
              show: false
            },
            axisLabel: {
              textStyle: {
                color: '#999'
              }
            }
          },
          dataZoom: [
            {
              type: 'inside'
            }
          ],
          series: [
            { // For shadow
              type: 'bar',
              itemStyle: {
                normal: {color: 'rgba(0,0,0,0.05)'}
              },
              barGap: '-100%',
              barCategoryGap: '40%',
              data: this.dataShadow,
              animation: false
            },
            {
              type: 'bar',
              itemStyle: {
                normal: {
                  color: new echarts.graphic.LinearGradient(
                      0, 0, 0, 1,
                    [
                      {offset: 0, color: '#83bff6'},
                      {offset: 0.5, color: '#188df0'},
                      {offset: 1, color: '#188df0'}
                    ]
                  )
                },
                emphasis: {
                  color: new echarts.graphic.LinearGradient(
                    0, 0, 0, 1,
                    [
                      {offset: 0, color: '#2378f7'},
                      {offset: 0.7, color: '#2378f7'},
                      {offset: 1, color: '#83bff6'}
                    ]
                  )
                }
              },
              data: this.data
            }
          ]
        })
      }
    },
    mounted () {
      this.drawMap()
    }
  }
</script>

<style type="text/css" lang="scss">
  .myChart2{
    width:100%;
    height:600px;
    .anchorBL{
      display: none;
    }
  }
</style>