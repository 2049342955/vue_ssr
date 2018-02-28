<template>
  <div class="pay_profit">
    <div class="pc_pay_profit" v-if="isMobile===0">
      <h3 class="title">收益信息</h3>
      <div class="pay_profit_detail">
        <div class="item" v-for="n in cloudNav">
          <span class="info_left">{{params[n].title}}</span>
          <span class="info_right">{{cloudMinerData[n]||'暂无'}}<em>{{params[n].unit}}</em></span>
        </div>
      </div>
    </div>
    <div class="mobile_pay_profit" v-if="isMobile===1">
      <div class="item" v-for="m in cloudNav">
        <span>{{params[m].title}}</span>
        <span>{{cloudMinerData[m]+params[m].unit}}</span>
      </div>
    </div>
  </div>
</template>

<script>
  import { mapState } from 'vuex'
  export default {
    props: {
      cloudMinerData: {
        type: Object
      }
    },
    data () {
      return {
        params: {
          batch_area: {title: '批次所在区域', unit: ''},
          contract_time: {title: '合约周期', unit: ''},
          electric_fee: {title: '电费', unit: '元/度'},
          safeguard_time: {title: '停电维护', unit: ''},
          settle_time: {title: '结算周期', unit: ''},
          trust_fee: {title: '托管费', unit: '元/台/月'}
        },
        cloudNav: ['electric_fee', 'trust_fee', 'contract_time', 'settle_time', 'safeguard_time', 'batch_area']
      }
    },
    computed: {
      ...mapState({
        isMobile: state => state.isMobile
      })
    }
  }
</script>

<style type="text/css" lang="scss">
  .pay_profit{
    .pc_pay_profit{
      .pay_profit_detail{
        padding: 20px 60px;
        .item{
          span{
            line-height: 2;
          }
          .info_left{
            width: 121px;
            display:inline-block;
            text-align: right;
            margin-right: 54px;
          }
          .info_right{
            font-size: 16px;
            color: #121212;
            font-weight: 800;
            em{
              font-style: normal;
              margin-left: 10px;
              font-weight: 100;
              color:$light_text;
              font-size: 13px;
            }
          }
        }
      }
    }
    .mobile_pay_profit {
      padding: 0.3rem;
      background: #fff;
      margin-bottom: 0.2rem;
      .item{
        @include flex(space-between)
        line-height: 30px;
        color:$light_black;
        span:last-child{
          color:$text
        }
      }
    }
  }
</style>
