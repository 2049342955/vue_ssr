<template>
  <section class="money_flow">
    <h2>资金流水</h2>
    <h3>流水详情</h3>
    <div class="detail_box">
      <div class="data">
        <template v-for="d,k in data">
          <div class="item">
            <p>{{d.text}}</p>
            <div>
              <span class="currency">{{d.value|currency}}</span>
              <span class="">元</span>
            </div>
          </div>
          <div class="line" v-if="k!==2"></div>
        </template>
      </div>
      <div class="btn">
        <button>充值</button>
        <button>提现</button>
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
          <td v-for="v,k in l">
            <template v-if="k==='amount'">{{v|currency}}元</template>
            <template v-else>{{v}}</template>
          </td>
        </tr>
      </table>
    </div>
  </section>
</template>

<script>
  import api from '@/util/function'
  export default {
    data () {
      return {
        data: [{name: 'totalBuy', value: 422558, text: '累积购买总金额'}, {name: 'totalRecharge', text: '累积充值总金额', value: 500558}, {name: 'balance', text: '账户余额', value: 500558}],
        nav: ['时间', '交易类型', '交易内容', '交易金额', '备注', '状态'],
        list: [{time: '2017-09-12', type: '购买算力', content: '阿瓦隆1号100T', amount: -90000, remark: '', status: '成功'}, {time: '2017-09-12', type: '充值', content: '账户充值', amount: +90000, remark: '', status: '成功'}, {time: '2017-09-12', type: '出售云矿机', content: '云矿机出售', amount: +90000, remark: '', status: '成功'}]
      }
    },
    methods: {
      test (e) {
        console.log(11)
      }
    },
    filters: {
      currency: api.currency
    }
  }
</script>

<style type="text/css" lang="scss">
  @import '../../assets/css/style.scss';
  .money_flow{
    padding:0 15px;
    h2{
      padding:0 15px !important;
    }
    .detail_box{
      @include gap(25,v)
      @include flex
      margin-bottom:10px;
      .data{
        flex:1;
        @include detail_data
        .item:last-child{
          span.currency{
            color:$orange
          }
        }
      }
      .btn{
        @include detail_btn
      }
    }
    .detail_table{
      @include data_table
    }
  }
</style>
