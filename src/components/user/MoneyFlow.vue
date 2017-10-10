<template>
  <section class="money_flow">
    <h2>资金流水</h2>
    <h3>流水详情</h3>
    <div class="detail_box">
      <div class="data">
        <template v-for="d,k in data">
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
        data: [{name: 'totalBuy', value: 422558, text: '累积购买总金额'}, {name: 'totalRecharge', text: '累积充值总金额', value: 500558}, {name: 'balance', text: '账户余额', value: 500558}],
        nav: ['时间', '交易类型', '交易内容', '交易金额', '备注', '状态'],
        list: [{time: '2017-09-12', type: '购买算力', content: '阿瓦隆1号100T', amount: -90000, remark: '', status: '成功'}, {time: '2017-09-12', type: '充值', content: '账户充值', amount: +90000, remark: '', status: '成功'}, {time: '2017-09-12', type: '出售云矿机', content: '云矿机出售', amount: +90000, remark: '', status: '成功'}],
        edit: '',
        form: {
          Withdrawals: [{name: 'money', type: 'text', title: '提现金额', placeholder: '请输入提现金额'}, {name: 'password', type: 'text', title: '交易密码', placeholder: '请输入交易密码'}],
          Recharge: [{name: 'money', type: 'text', title: '充值金额', placeholder: '请输入充值金额'}]
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
        .item:nth-child(5){
          span.currency{
            color:$orange
          }
        }
      }
      .btn{
        @include detail_btn
        @include gap(50,h)
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
    .detail_table{
      @include data_table
    }
  }
</style>
