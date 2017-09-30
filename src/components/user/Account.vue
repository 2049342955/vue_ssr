<template>
  <section class="account">
    <h2>账户管理</h2>
    <div class="con">
      <div :class="['item', {fail: !n.status}, {success: n.status}]" v-for="n,k in nav">
        <div class="icon"></div>
        <div class="con_title">{{n.title}}</div>
        <div class="desc">{{n.desc}}</div>
        <div class="val">
          <template v-if="n.status&&n.name==='tel'">{{n.text}}：<span>{{mobile|format}}</span></template>
          <template v-if="n.status&&n.name==='auth'">{{true_name.truename}}：<span>{{true_name.idcard|cardformat}}</span></template>
          <template v-if="n.status&&n.name==='test'">风险分数：<span>{{testResult}}</span></template>
          <template v-if="n.status&&n.name==='card'">{{bankCard.open_bank}}：<span>{{bankCard.card_no|cardformat}}</span></template>
          <template v-if="n.status&&n.name==='address'">{{n.text}}：<span>{{mobile|format}}</span></template>
        </div>
        <div class="opr" @click="setEdit(n.name,n.title)" v-if="n.name!=='test'">{{n.opr}}</div>
        <router-link class="opr" to="/accountEvaluate" v-else>{{n.opr}}</router-link>
      </div>
    </div>
    <div class="mask" v-if="edit">
      <div class="form_box">
        <div class="close" @click="closeEdit()">
          <span class="icon"></span>
          <span>关闭</span>
        </div>
        <h2>{{title}}</h2>
        <form class="form form_content" @submit.prevent="submit" novalidate>
          <FormField :form="form[edit]"></FormField>
          <button>确认提交</button>
        </form>
      </div>
    </div>
  </section>
</template>
<script>
  import api from '@/util/function'
  import util from '@/util'
  import { mapState } from 'vuex'
  import FormField from '@/components/common/FormField'
  export default {
    components: {
      FormField
    },
    data () {
      return {
        nav: [
          {title: '手机认证', desc: '手机号码是在算力网进行操作的重要凭证。', text: '手机号码', opr: '修改', status: 1, name: 'tel'},
          {title: '实名认证', desc: '完成实名认证，认证后可以获得更多权限', text: '身份证号', opr: '认证', status: 0, name: 'auth'},
          {title: '风险测评', desc: '完成风险测评才可以充值、交易等操作。', text: '', opr: '测评', status: 0, name: 'test'},
          {title: '绑定银行卡', desc: '绑定银行卡才能进行提现。', text: '', opr: '绑定', status: 0, name: 'card'}
          // {title: '计算算力地址', desc: '请选择算力类型并设置算力地址', text: '', opr: '设置', status: 0, name: 'address'}
        ],
        tipInfo: ['正在审核', '认证成功', '认证不一致'],
        form: {
          tel: [{name: 'mobile', type: 'text', title: '手机号码', placeholder: '请输入手机号', pattern: '^1[3578][0-9]{9}$', tips: '请输入11位手机号'}, {name: 'code', type: 'text', title: '短信验证', placeholder: '请输入短信验证码', addon: 2, pattern: '^.{6}$', tips: '短信验证码应是6位', error: '短信验证码有误，请重新获取', success: '发送成功'}],
          auth: [{name: 'truename', type: 'text', title: '姓名', placeholder: '请输入姓名', isChange: true}, {name: 'idcard', type: 'text', title: '证件号码', placeholder: '请输入您的证件号码', pattern: '^([0-9]{15}$|^[0-9]{18}$|^[0-9]{17}([0-9]|X|x))$', tips: '身份证号应是18位'}, {name: 'mobile', type: 'text', title: '手机号码', edit: 'disabled'}, {name: 'code', type: 'text', title: '短信验证', placeholder: '请输入短信验证码', addon: 2, pattern: '^.{6}$', tips: '短信验证码应是6位', error: '短信验证码有误，请重新获取', success: '发送成功'}],
          card: [{name: 'card_no', type: 'text', title: '银行卡号', placeholder: '请输入银行卡号', pattern: '^([1-9]{1})([0-9]{14}|[0-9]{18})$', tips: '请输入19位的银行卡号'}, {name: 'open_bank', type: 'text', title: '开户银行', placeholder: '请输入开户银行名称', isChange: true}, {name: 'bank_branch', type: 'text', title: '开户支行', placeholder: '请输入开户支行名称', isChange: true}, {name: 'bank', type: 'select', title: '开户行地址', isChange: true}, {name: 'mobile', type: 'text', title: '银行预留手机号', placeholder: '请输入银行预留手机号', pattern: '^1[3578][0-9]{9}$', tips: '请输入11位手机号'}, {name: 'code', type: 'text', title: '手机验证码', placeholder: '请输入短信验证码', addon: 2, pattern: '^.{6}$', tips: '短信验证码应是6位', error: '短信验证码有误，请重新获取', success: '发送成功'}],
          address: [{name: 'type', type: 'select', title: '算力类型', option: ['BIT', 'ETH', 'ETC', 'BCC']}, {name: 'imgCode', type: 'text', title: '算力地址', placeholder: '请输入对应算力地址'}, {name: 'tel', type: 'text', title: '手机号码', placeholder: '请输入手机号', pattern: '^1[3578][0-9]{9}$', tips: '请输入11位手机号'}, {name: 'code', type: 'text', title: '短信验证', placeholder: '请输入短信验证码', addon: 2, pattern: '^.{6}$', tips: '短信验证码应是6位', error: '短信验证码有误，请重新获取'}]
        },
        edit: '',
        title: '',
        idcard: '',
        cardNo: '',
        true_name: {idcard: '', truename: ''},
        bankCard: {open_bank: '', card_no: ''},
        testResult: 0
      }
    },
    methods: {
      submit () {
        var form = document.querySelector('.form_content')
        var data = api.checkFrom(form)
        var url = ''
        var callbackUrl = ''
        var no = -1
        var val = ''
        var sendData = {token: this.token, user_id: this.user_id}
        switch (this.edit) {
          case 'tel':
            url = '1'
            break
          case 'auth':
            url = 'user_truename'
            callbackUrl = 'show_user_truename'
            no = 1
            val = 'true_name'
            break
          case 'card':
            url = 'BankCard'
            callbackUrl = 'show_bankcard'
            no = 3
            val = 'bankCard'
            break
          case 'address':
            url = '4'
            break
        }
        if (!data) return false
        var self = this
        util.post(url, {sign: api.serialize(Object.assign(data, sendData))}).then(function (data) {
          if (data) {
            self.closeEdit()
            util.post(callbackUrl, {sign: api.serialize(sendData)}).then(function (res) {
              self.nav[no].status = 1
              self[val] = res
            })
          }
        })
      },
      setEdit (str, title) {
        this.edit = str
        this.title = title
        window.scroll(0, 0)
        document.body.style.overflow = 'hidden'
      },
      closeEdit () {
        this.edit = ''
        document.body.style.overflow = 'auto'
      }
    },
    computed: {
      ...mapState({
        token: state => state.info.token,
        user_id: state => state.info.user_id,
        mobile: state => state.info.mobile
      })
    },
    mounted () {
      var self = this
      util.post('getAll', {sign: api.serialize({token: this.token, user_id: this.user_id})}).then(function (data) {
        if (data.true_name) {
          self.nav[1].status = 1
          self.nav[1].opr = self.tipInfo[data.true_name.status]
          self.true_name = data.true_name
        }
        if (data.bank_card) {
          self.nav[3].status = 1
          self.bankCard = data.bank_card
        }
        if (data.risk.user_risk_score > 0) {
          self.nav[2].status = 1
          self.testResult = data.risk.user_risk_score
        }
      })
    },
    filters: {
      format: api.telReadable,
      cardformat: api.cardReadable
    }
  }
</script>

<style type="text/css" lang="scss">
  @import '../../assets/css/style.scss';
  .account{
    h2{
      padding:10px 25px;
      border-bottom: 1px solid $border;
    }
    .con{
      padding:25px 30px;
      .item{
        @include flex
        border:1px solid;
        padding:15px;
        &.success{
          border-color:$green_border;
          background: $green_bg;
          .icon{
            position: relative;
            background: $green;
            &:before{
              content:'';
              @include right
            }
          }
          .con_title{
            color: $green;
          }
        }
        &.fail{
          border-color:$fail_border;
          background: $fail_bg;
          .icon{
            text-align: center;
            background: $fail;
            color: $white;
            &:before{
              content:'!'
            }
          }
          .con_title{
            color: $fail;
          }
        }
        &:not(:last-child){
          margin-bottom:25px;
        }
        .icon{
          @include block(18,50%)
          margin-right:10px
        }
        .con_title{
          width: 140px;
          font-size: 16px;
          font-weight: bold;
        }
        .desc{
          flex:1
        }
        .val{
          width: 280px;
          color: $light_text;
          span{
            color: $text;
          }
        }
        .opr{
          color: $blue;
          cursor: pointer;
        }
      }
    }
    .mask{
      @include mask
      .form_box{
        .form_content{
          padding:40px 130px;
          @include form(v)
          width:450px;
          .input{
            span{
              &:first-child {
                width: 115px;
                text-align: right;
              }
              &:nth-child(2) {
                left: 135px
              }
            }
            input,select{
              padding-left:185px
            }
            .select{
              padding-left:185px;
              @include flex
              select{
                flex:1;
                padding:6px 0;
                border:none;
                & + select{
                  margin-left:3px
                }
              }
            }
          }
        }
      }
    }
  }
</style>
