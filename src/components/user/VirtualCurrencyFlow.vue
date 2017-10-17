<template>
  <section class="vcurrency_flow">
    <h2>币流水</h2>
    <h3>流水详情</h3>
    <div class="detail_box">
      <div class="data">
        <template v-for="d,k in dataNav">
          <div class="item">
            <p>{{d}}</p>
            <div>
              <span class="currency">{{data[k]}}</span>
              <span class="">btc</span>
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
          <td v-for="v,k in nav">{{l[k]}}</td>
        </tr>
      </table>
      <Pager :len="len"></Pager>
    </div>
  </section>
</template>

<script>
  import util from '@/util'
  import api from '@/util/function'
  import { mapState } from 'vuex'
  import Pager from '@/components/common/Pager'
  export default {
    components: {
      Pager
    },
    data () {
      return {
        dataNav: {total_income: '累积已获得BTC', total_electric_fee: '累计支付电费'},
        data: {total_income: 0, total_electric_fee: 0},
        nav: {product_name: '算力服务器', paid_time: '购买时间', hold_amound: '总算力', paid_amound: '获得BTC', electric_fee: '支付电费', status: '状态'},
        list: [{product_name: '阿瓦隆001', paid_time: '2017-09-21', hold_amound: '9T', paid_amound: '-0.0000926687 BTC', electric_fee: '-0.0000926687 BTC', status: '成功'}, {product_name: '阿瓦隆001', paid_time: '2017-09-21', hold_amound: '9T', paid_amound: '-0.0000926687 BTC', electric_fee: '-0.0000926687 BTC', status: '成功'}, {product_name: '阿瓦隆001', paid_time: '2017-09-21', hold_amound: '9T', paid_amound: '-0.0000926687 BTC', electric_fee: '-0.0000926687 BTC', status: '成功'}, {product_name: '阿瓦隆001', paid_time: '2017-09-21', hold_amound: '9T', paid_amound: '-0.0000926687 BTC', electric_fee: '-0.0000926687 BTC', status: '成功'}],
        len: 0,
        now: 1
      }
    },
    methods: {
      getList () {
        var self = this
        util.post('userCoinList', {sign: api.serialize({token: this.token, user_id: this.user_id, product_hash_type: '1', page: this.now, sort: ''})}).then(function (res) {
          self.list = res.value_list
          if (self.now > 1) return false
          self.len = Math.ceil(res.total_num / 15)
        })
      }
    },
    mounted () {
      var self = this
      util.post('userCoin', {sign: api.serialize({token: this.token, user_id: this.user_id, product_hash_type: '1'})}).then(function (res) {
        console.log(res)
        self.data = res
      })
      this.getList()
    },
    computed: {
      ...mapState({
        token: state => state.info.token,
        user_id: state => state.info.user_id
      })
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
