<template>
  <section class="recharge">
    <h2>用户充值</h2>
    <h3>操作提示</h3>
    <div class="recharge_text">
      <div class="recharge_info">
        <p>账号主体：杭州某某有限公司</p>
        <p>对公银行：建设银行</p>
        <p>银行卡号：32095023582232352</p>
        <p>备注：</p>
      </div>
      <div class="recharge_process" v-if="$route.params.type != '1'">
        <div :class="['item', {active: k===processStatus}]" v-for="p,k in processText">
          <i><template v-if="k>=processStatus">{{k+1}}</template></i>
          <span>{{p}}</span>
          <div class="line" v-if="k<3"></div>
        </div>
      </div>
    </div>
    <h3>充值申请</h3>
    <form class="form" @submit.prevent="submit" novalidate>
      <FormField :form="form"></FormField>
      <button>提交申请</button>
    </form>
    <div class="web_tips" ref="tips"></div>
  </section>
</template>

<script>
  import util from '@/util'
  import api from '@/util/function'
  import FormField from '@/components/common/FormField'
  import { mapState } from 'vuex'
  export default {
    components: {
      FormField
    },
    props: {
      page: {
        type: String
      }
    },
    data () {
      return {
        processText: ['银行转账', '提交申请', '审核通过'],
        processStatus: 0,
        form: [{name: 'amount', type: 'text', title: '充值金额', placeholder: '请输入充值金额', pattern: '^[0-9]+(.[0-9]{1,2})?$', tips: '请输入整数或两位小数'}, {name: 'bank_card', type: 'text', title: '充值银行卡', edit: 'bank_card'}, {name: 'request_id', type: 'text', title: '充值流水号', placeholder: '请输入充值流水号', pattern: '^[0-9]*$', tips: '请输入多位数字'}]
      }
    },
    methods: {
      submit () {
        var form = document.querySelector('.form')
        var data = api.checkFrom(form)
        var sendData = {token: this.token}
        if (!data) return false
        var self = this
        console.log(data)
        util.post('balance_recharge', {sign: api.serialize(Object.assign(data, sendData))}).then(function (back) {
          api.tips(self.$refs.tips, '提交成功，请等待工作人员确认')
          form.amount.value = ''
          form.request_id.value = ''
        })
      }
    },
    computed: {
      ...mapState({
        token: state => state.info.token,
        user_id: state => state.info.user_id,
        bank_card: state => state.info.bank_card.card_no
      })
    }
  }
</script>

<style type="text/css" lang="scss">
  @import '../../assets/css/style.scss';
  .recharge{
    padding:0 15px;
    .recharge_text{
      padding:20px 30px;
      @include flex
      .recharge_info{
        font-size: 16px;
        line-height: 2;
        color:$light_text
      }
      .recharge_process{
        flex:1;
        margin-left:80px;
        @include process
      }
    }
    .form{
      margin: 0 auto;
      padding:40px 130px;
      @include form(v)
      width:450px;
      .input{
        span:first-child {
          width: 80px;
        }
      }
    }
  }
</style>
