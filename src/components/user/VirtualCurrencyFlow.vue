<template>
  <section class="vcurrency_flow">
    <h2>币流水</h2>
    <h3>流水详情</h3>
    <div class="detail_box">
      <div class="data">
        <template v-for="d,k in data">
          <div class="item">
            <p>{{d.text}}</p>
            <div>
              <span class="currency">{{d.value}}</span>
              <span class="">元</span>
            </div>
          </div>
          <div class="line" v-if="k!==1"></div>
        </template>
      </div>
    </div>
    <div class="detail_table">
      <div class="detail_title">
        <span>筛选条件</span>
        <span>默认</span>
        <span>时间</span>
      </div>
      <table>
        <tr>
          <th v-for="n in nav">{{n}}</th>
        </tr>
        <tr v-for="l in list">
          <td v-for="v,k in l">{{v}}</td>
        </tr>
      </table>
    </div>
  </section>
</template>

<script>
  export default {
    data () {
      return {
        data: [{name: 'totalProfit', value: 0.44345589, text: '累积已获得BTC'}, {name: 'totalRecharge', text: '累计支付电费', value: 0.14345589}],
        nav: ['算力服务器', '购买时间', '总算力', '获得BTC', '支付电费', '状态'],
        list: [{server: '阿瓦隆001', time: '2017-09-21', totalCompute: '9T', profit: '-0.0000926687 BTC', ElectricityFees: '-0.0000926687 BTC', status: '成功'}, {server: '阿瓦隆001', time: '2017-09-21', totalCompute: '9T', profit: '-0.0000926687 BTC', ElectricityFees: '-0.0000926687 BTC', status: '成功'}, {server: '阿瓦隆001', time: '2017-09-21', totalCompute: '9T', profit: '-0.0000926687 BTC', ElectricityFees: '-0.0000926687 BTC', status: '成功'}, {server: '阿瓦隆001', time: '2017-09-21', totalCompute: '9T', profit: '-0.0000926687 BTC', ElectricityFees: '-0.0000926687 BTC', status: '成功'}]
      }
    },
    methods: {
      test (e) {
        console.log(11)
      }
    }
  }
</script>

<style type="text/css" lang="scss">
  @import '../../assets/css/style.scss';
  .vcurrency_flow{
    padding:0 15px;
    h2{
      padding:0 15px !important;
    }
    .detail_box{
      @include gap(25,v)
      margin-bottom:10px;
      .data{
        width:70%;
        @include detail_data
        .item:first-child{
          span.currency{
            color:$blue
          }
        }
      }
    }
    .detail_table{
      @include data_table
    }
  }
</style>
