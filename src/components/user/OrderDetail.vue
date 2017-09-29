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
            <p>{{i.title}}</p>
            <div class="profit"><span>{{i.value}}</span>Btc</div>
          </div>
          <div class="line" v-if="k!==2"></div>
        </template>
      </div>
    </div>
    <h3>基本信息</h3>
    <div class="detail_box">
      <div class="detail_table">
        <div class="item" v-for="d,k in data">
          <div class="item_title">{{k}}</div>
          <div class="item_value">{{d}}</div>
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
  export default {
    data () {
      return {
        process: [{title: '订单下达', status: 1}, {title: '矿场确认', status: 1}, {title: '矿机上架', status: 0}, {title: '回报计算', status: 0}],
        info: [{name: 'totalProfit', title: '累计已获得BTC', value: 0.44345589}, {name: 'todayProfit', title: '今日BTC收益', value: 0.14345589}, {name: 'pay', title: '今日支付电费', value: 0.14345589}],
        data: {'算力类型': 'BTC', '购买数量': '100*1台=10台', '购买日期': '2017-09-12 18:00', '购买金额': '10*9000.00=90000.00', '收益方式': '每日结算，次日发放', '总算力': '90T', '服务器类型': '阿瓦隆', '所在区域': ''}
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
