<template>
  <section class="account">
    <h2>账户管理</h2>
    <Setting :nav="nav"></Setting>
    <MyMask :form="form[edit]" :title="title" v-if="edit"></MyMask>
  </section>
</template>

<script>
  import api from '@/util/function'
  import util from '@/util'
  import { mapState } from 'vuex'
  import MyMask from '@/components/common/Mask'
  import Setting from '@/components/common/Setting'
  export default {
    components: {
      MyMask, Setting
    },
    data () {
      return {
        nav: [
          {title: '手机认证', desc: '手机号码是在算力网进行操作的重要凭证。', text: '手机号码', opr: '已认证', status: 1, name: 'tel', setting: false},
          {title: '实名认证', desc: '完成实名认证，认证后可以获得更多权限', text: '身份证号', opr: '认证', status: 0, name: 'auth', setting: true},
          {title: '风险测评', desc: '完成风险测评才可以充值、交易等操作。', text: '', opr: '测评', status: 0, name: 'test', setting: true},
          {title: '绑定银行卡', desc: '绑定银行卡才能进行提现。', text: '', opr: '绑定', status: 0, name: 'card', setting: true},
          {title: '计算算力地址', desc: '请选择算力类型并设置算力地址', text: '', opr: '设置', status: 0, name: 'address', setting: true}
        ],
        form: {
          tel: [{name: 'mobile', type: 'text', title: '手机号码', placeholder: '请输入手机号', pattern: '^1[3578][0-9]{9}$', tips: '请输入11位手机号'}, {name: 'code', type: 'text', title: '短信验证', placeholder: '请输入短信验证码', addon: 2, pattern: '^.{6}$', tips: '短信验证码应是6位', error: '短信验证码有误，请重新获取', success: '发送成功'}],
          auth: [{name: 'truename', type: 'text', title: '姓名', placeholder: '请输入姓名', isChange: true}, {name: 'idcard', type: 'text', title: '证件号码', placeholder: '请输入您的证件号码', pattern: '^([0-9]{15}$|^[0-9]{18}$|^[0-9]{17}([0-9]|X|x))$', tips: '身份证号应是18位'}, {name: 'mobile', type: 'text', title: '手机号码', edit: 'disabled'}, {name: 'code', type: 'text', title: '短信验证', placeholder: '请输入短信验证码', addon: 2, pattern: '^.{6}$', tips: '短信验证码应是6位', error: '短信验证码有误，请重新获取', success: '发送成功'}],
          card: [{name: 'card_no', type: 'text', title: '银行卡号', placeholder: '请输入银行卡号', pattern: '^[0-9]{18,21}$', tips: '请输入18至21位的银行卡号'}, {name: 'open_bank', type: 'text', title: '开户银行', placeholder: '请输入开户银行名称', isChange: true}, {name: 'bank_branch', type: 'text', title: '开户支行', placeholder: '请输入开户支行名称', isChange: true}, {name: 'bank', type: 'select', title: '开户行地址', isChange: true}, {name: 'mobile', type: 'text', title: '银行预留手机号', placeholder: '请输入银行预留手机号', pattern: '^1[3578][0-9]{9}$', tips: '请输入11位手机号'}, {name: 'code', type: 'text', title: '手机验证码', placeholder: '请输入短信验证码', addon: 2, pattern: '^.{6}$', tips: '短信验证码应是6位', error: '短信验证码有误，请重新获取', success: '发送成功'}],
          address: [{name: 'product_hash_type', type: 'select', title: '算力类型', option: [{title: 'BTC', value: '1'}]}, {name: 'address', type: 'text', title: '算力地址', placeholder: '请输入对应算力地址', pattern: '^[0-9a-zA-Z]{34}$', tips: '请输入34位的字符串'}, {name: 'mobile', type: 'text', title: '手机号码', edit: 'disabled'}, {name: 'code', type: 'text', title: '短信验证', placeholder: '请输入短信验证码', addon: 2, pattern: '^.{6}$', tips: '短信验证码应是6位', error: '短信验证码有误，请重新获取', success: '发送成功'}]
        },
        edit: '',
        title: '',
        true_name: {idcard: '', truename: ''},
        bankCard: {open_bank: '', card_no: ''},
        testResult: 0,
        bindAddress: {address: '', product_hash_type: ''}
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
            url = 'bindAddress'
            callbackUrl = 'show_Address'
            no = 4
            val = 'bindAddress'
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
              console.log(res)
            })
          }
        })
      },
      closeEdit () {
        this.edit = ''
        document.body.style.overflow = 'auto'
      }
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
  .account{
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
