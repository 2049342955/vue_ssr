<template>
  <section class="detail">
    <h2>订单详情</h2>
    <h3>运行状况</h3>
    <div class="detail_box">
      <div class="process">
        <div class="item" v-for="p,k in process">
          <i><template v-if="!p.status">{{k+1}}</template></i>
          <span>{{p.title}}</span>
          <div class="line" v-if="k!==3"></div>
        </div>
      </div>
      <div class="detailinfo">
        <template v-for="i,k in info">
          <div class="item">
            <p>{{i}}</p>
            <div class="profit"><span>{{data[k]}}</span>Btc</div>
          </div>
          <div class="line" v-if="k!==2"></div>
        </template>
      </div>
    </div>
    <h3>基本信息</h3>
    <div class="detail_box">
      <div class="detail_table">
        <div class="item" v-for="d,k in type">
          <div class="item_title">{{d}}</div>
          <div class="item_value">{{data[k]}}</div>
        </div>
        <div class="item" v-if="Object.keys(data).length%2">
          <div class="item_title"></div>
          <div class="item_value"></div>
        </div>
      </div>
      <div class="detail_btn">
        <button>查看协议</button>
        <button>查看保全</button>
      </div>
    </div>
  </section>
</template>

<script>
  import util from '@/util'
  import api from '@/util/function'
  import { mapState } from 'vuex'
  export default {
    data () {
      return {
        process: [{title: '订单下达', status: 1}, {title: '矿场确认', status: 1}, {title: '矿机上架', status: 0}, {title: '回报计算', status: 0}],
        info: {realized_income_value: '累计已获得BTC', today_income: '今日BTC收益', total_realized_power_fee_value: '今日支付电费'},
        data: {},
        type: {hash_type: '算力类型', miner_name: '矿机名称', buy_amount: '购买数量', create_time: '购买日期', pay_value: '购买金额', income_type: '收益方式', total_hash: '总算力'}
      }
    },
    methods: {
      test (e) {
        console.log(11)
      }
    },
    mounted () {
      var self = this
      util.post('showOrderDetail', {sign: api.serialize({token: this.token, order_id: this.$route.params.id})}).then(function (res) {
        self.data = res
      })
    },
    computed: {
      ...mapState({
        token: state => state.info.token
      })
    }
  }
</script>
<style type="text/css" lang="scss">
  @import '../../assets/css/style.scss';
  .detail{
    padding:15px;
    h2{
      margin-bottom:15px;
      padding-left:15px
    }
    .detail_box{
      .process{
        padding:25px 30px;
        @include flex
        .item{
          &:not(:last-child){
            flex:1;
          }
          @include flex
          color:$blue;
          i{
            position: relative;
            @include block(20,50%)
            border: 1px solid $blue;
            text-align: center;
            margin-right:5px;
            &:empty:before{
              content:'';
              @include right(8,5,$blue)
            }
          }
          .line{
            margin:0 15px;
            flex:1;
            height: 1px;
            background: $border;
          }
        }
      }
      .detailinfo{
        padding:25px 30px;
        @include flex(space-between)
        .item{
          &:first-child .profit{
            span{
              color:$orange
            }
          }
          p{
            margin-bottom:10px
          }
          .profit{
            span{
              font-size: 24px;
              color:#000;
              margin-right:15px
            }
          }
        }
        .line{
          width:1px;
          height:40px;
          background: $border;
        }
      }
      .detail_table{
        @include detail
      }
      .detail_btn{
        margin:30px 15px;
        text-align: right;
        button{
          color:$white;
          background: $blue;
          padding:5px 15px;
          & + button{
            margin-left:10px
          }
        }
      }
    }
  }
</style>
