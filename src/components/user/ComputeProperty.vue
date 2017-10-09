<template>
  <section class="compute_property">
    <h2>个人中心</h2>
    <h3>资金账户</h3>
    <div class="compute_box">
      <div class="data">
        <template v-for="d,k in data">
          <div class="item">
            <p>{{d.text}}</p>
            <div>
              <span class="currency">{{d.value|currency}}</span>
              <span class="">元</span>
            </div>
          </div>
          <div class="line" v-if="k!==1"></div>
        </template>
      </div>
      <div class="btn">
        <button>充值</button>
        <button>提现</button>
      </div>
    </div>
    <h3>算力账户</h3>
    <div class="compute_box">
      <div class="data">
        <template v-for="d,k in data2">
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
        <button>收益图表</button>
        <button>提取收益</button>
      </div>
    </div>
    <h3>算力资产</h3>
    <div class="compute_box">
      <div class="detail_table">
        <div class="item" v-for="d,k in 5">
          <div class="item_title">{{d}}</div>
          <div class="item_value">{{k}}</div>
        </div>
        <div class="item" v-if="5%2">
          <div class="item_title"></div>
          <div class="item_value"></div>
        </div>
      </div>
      <div class="btn">
        <button>出售云矿机</button>
        <button>出租算力</button>
        <button>查看订单</button>
      </div>
    </div>
    <div class="compute_box">
      <div class="detail_table">
        <div class="item" v-for="d,k in 3">
          <div class="item_title">{{d}}</div>
          <div class="item_value">{{k}}</div>
        </div>
        <div class="item" v-if="3%2">
          <div class="item_title"></div>
          <div class="item_value"></div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
  import api from '@/util/function'
  export default {
    data () {
      return {
        data: [{name: 'totalMoney', value: 10000, text: '可用资金'}, {name: 'frozenMoney', text: '冻结资金', value: 10000}],
        data2: [{name: 'totalMoney', value: 10000, text: '可用资金'}, {name: 'frozenMoney', text: '冻结资金', value: 10000}, {name: 'frozenMoney', text: '冻结资金', value: 10000}]
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
  .compute_property{
    padding:0 15px;
    h2{
      padding:0 15px !important;
    }
    .compute_box{
      @include gap(25,v)
      @include flex
      margin-bottom:10px;
      .data{
        width:74%;
        @include detail_data
      }
      .btn{
        @include detail_btn
      }
      .detail_table{
        width:70%;
        @include detail
      }
    }
  }
</style>
