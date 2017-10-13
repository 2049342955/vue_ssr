<template>
  <section class="money_flow">
    <h2>资金流水</h2>
    <h3>流水详情</h3>
    <div class="detail_box">
      <div class="data">
        <template v-for="d,k in dataNav">
          <div class="item">
            <p>{{d}}</p>
            <span class="currency">{{data[k]|currency}}</span>
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
          <td v-for="v,k in nav">
            <template v-if="k==='value'">{{l[k]|currency}}元</template>
            <template v-else>{{l[k]}}</template>
          </td>
        </tr>
      </table>
    </div>
    <MyMask :form="form[edit]" :title="editText" v-if="edit"></MyMask>
    <div class="web_tips" ref="tips"></div>
  </section>
</template>

<script>
  import util from '@/util'
  import api from '@/util/function'
  import { mapState } from 'vuex'
  import MyMask from '@/components/common/Mask'
  export default {
    components: {
      MyMask
    },
    data () {
      return {
        dataNav: {total_buy: '累积购买总金额', total_recharge: '累积充值总金额', balance_account: '账户余额'},
        data: {total_buy: 0, total_recharge: 0, balance_account: 0},
        nav: {create_time: '时间', type_name: '交易类型', trade_content: '交易内容', value: '交易金额', remark: '备注', status: '状态'},
        list: [{create_time: '2017-09-12', type_name: '购买算力', trade_content: '阿瓦隆1号100T', value: -90000, remark: '', status: '成功'}, {create_time: '2017-09-12', type_name: '充值', trade_content: '账户充值', value: +90000, remark: '', status: '成功'}, {create_time: '2017-09-12', type_name: '出售云矿机', trade_content: '云矿机出售', value: +90000, remark: '', status: '成功'}],
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
        if (str === 'Withdrawals' && !this.bank_card) {
          api.tips(this.$refs.tips, '请先绑定银行卡', () => {
            this.$router.push({name: 'account'})
          })
          return false
        }
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
    },
    mounted () {
      var self = this
      util.post('userCapital', {sign: api.serialize({token: this.token, user_id: this.user_id})}).then(function (res) {
        console.log(res)
        self.data = res
      })
      util.post('userCapitalList', {sign: api.serialize({token: this.token, user_id: this.user_id, page: 1, sort: ''})}).then(function (res) {
        console.log(res)
        self.list = res.value_list
      })
    },
    computed: {
      ...mapState({
        token: state => state.info.token,
        user_id: state => state.info.user_id,
        bank_card: state => state.info.bank_card
      })
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
