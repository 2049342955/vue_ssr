<template>
  <section class="compute_property">
    <h2>个人中心</h2>
    <h3>资金账户</h3>
    <div class="compute_box money_box">
      <div class="data">
        <template v-for="d,k in moneyData">
          <div class="item">
            <p>{{d.text}}</p>
            <span class="currency">{{d.value|currency}}</span>
            <span class="">元</span>
          </div>
          <div class="line"></div>
        </template>
      </div>
      <div class="btn">
        <button @click="openMask('Recharge', '资金充值')">充值</button>
        <button @click="openMask('Withdrawals', '资金提现')">提现</button>
      </div>
    </div>
    <h3>算力账户</h3>
    <div class="compute_box compute_account">
      <div class="data">
        <template v-for="d,k in computeData">
          <div class="item">
            <p>{{d.text}}</p>
            <span class="currency">{{d.value}}</span>
            <span class="">btc</span>
          </div>
          <div class="line"></div>
        </template>
      </div>
      <div class="btn">
        <router-link to="/user/incomeChart">收益图表</router-link>
        <button @click="openMask('GetIncome', '提取收益')">提取收益</button>
      </div>
    </div>
    <h3>算力资产</h3>
    <div class="detail_table">
      <div class="item" v-for="d,k in computeProperty">
        <div class="item_title">{{d}}</div>
        <div class="item_value">{{data[k]}}</div>
      </div>
      <div class="item" v-if="7%2">
        <div class="item_title"></div>
        <div class="item_value"></div>
      </div>
    </div>
    <h4>算力产业基金</h4>
    <div class="detail_table fund_table">
      <div class="item" v-for="d,k in computeFund">
        <div class="item_title">{{d}}</div>
        <div class="item_value">{{data[k]}}</div>
      </div>
      <div class="item" v-if="4%2">
        <div class="item_title"></div>
        <div class="item_value"></div>
      </div>
    </div>
    <div class="fund_btn">
      <router-link to="/user/order/0/0">出售云矿机</router-link>
      <router-link to="/user/order/1/0">出租算力</router-link>
      <router-link to="/user/order/0/0">查看订单</router-link>
    </div>
    <MyMask :form="form[edit]" :title="editText" v-if="edit"></MyMask>
  </section>
</template>

<script>
  import api from '@/util/function'
  import MyMask from '@/components/common/Mask'
  export default {
    components: {
      MyMask
    },
    data () {
      return {
        moneyData: [{name: 'totalMoney', value: 10000, text: '总资金'}, {name: 'frozenMoney', text: '冻结资金', value: 10000}, {name: 'leftMoney', text: '账户余额', value: 10000}],
        computeData: [{name: 'todayProfit', value: 0.14345589, text: '今日收益'}, {name: 'accountMoney', text: '账户余额', value: 1.14345589}, {name: 'totalProfit', text: '累积已获得收益', value: 1.14345589}],
        computeProperty: {buy_miner: '已购入矿机', total_hash: '算力总和', rented_conmute: '已租赁算力', sold_miner: '已出售矿机', selling_miner: '出售中云矿机', rented_miner: '已出租云矿机', renting_miner: '出租中云矿机'},
        computeFund: {miner: '云矿机', total_hash: '云算力总和', rented_miner: '已出租云矿机', renting_miner: '出租中云矿机'},
        data: {buy_miner: '10台', total_hash: '90T', rented_conmute: '100T', sold_miner: '0台', selling_miner: '0台', rented_miner: '0台', renting_miner: '0台', miner: '10台'},
        edit: '',
        form: {
          Withdrawals: [{name: 'money', type: 'text', title: '提现金额', placeholder: '请输入提现金额'}, {name: 'password', type: 'text', title: '交易密码', placeholder: '请输入交易密码'}],
          Recharge: [{name: 'money', type: 'text', title: '充值金额', placeholder: '请输入充值金额'}],
          GetIncome: [{name: 'computeType', type: 'select', title: '算力类型', option: ['BTC', 'BCC', 'ETC']}, {name: 'money', type: 'text', title: '提取额度', placeholder: '请输入提取额度'}, {name: 'address', type: 'text', title: '提取地址', placeholder: '请输入提取地址'}]
        },
        editText: ''
      }
    },
    methods: {
      openMask (str, title) {
        window.scroll(0, 0)
        document.body.style.overflow = 'hidden'
        this.editText = title
        this.edit = str
      },
      closeEdit () {
        this.edit = ''
        document.body.style.overflow = 'auto'
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
        flex:1;
        @include detail_data
      }
      .btn{
        @include detail_btn
        @include gap(25,h)
      }
      &.money_box{
        .data{
          .item:nth-child(5){
            span.currency{
              color:$orange
            }
          }
          .item:nth-child(3){
            span.currency{
              color:$light_black
            }
          }
        }
        .btn{
          button{
            &:first-child{
              @include button($orange)
            }
            &:not(:first-child){
              @include button($blue)
            }
          }
        }
      }
      &.compute_account{
        .btn{
          button,a{
            @include button(#c2d9ff,bg,$blue)
          }
        }
      }
    }
    h4{
      margin:0 15px;
      text-align: center;
      font-size: 16px;
      @include button($blue)
      line-height: 2.1;
    }
    .detail_table{
      @include detail
      &.fund_table{
        margin-top:3px
      }
    }
    .fund_btn{
      text-align: right;
      padding:0 15px 30px 15px;
      a{
        display: inline-block;
        text-align: center;
        width:85px;
        border-radius:5px;
        line-height: 2;
        &:not(:last-child){
          @include button($blue)
        }
        &:last-child{
          @include button($blue,border)
        }
        & + a{
          margin-left:13px
        }
      }
    }
  }
</style>
