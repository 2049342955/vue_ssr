<template>
  <section class="account">
    <h2>账户管理</h2>
    <Setting :nav="nav" type="account"></Setting>
    <MyMask :form="form[edit]" :title="title" v-if="edit"></MyMask>
    <div class="web_tips" ref="tips"></div>
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
          {title: '手机认证', desc: '手机号码是在算力网进行操作的重要凭证。', text: '手机号码', name: 'tel'},
          {title: '实名认证', desc: '完成实名认证，认证后可以获得更多权限', text: '身份证号', name: 'auth'},
          {title: '风险测评', desc: '完成风险测评才可以充值、交易等操作。', text: '', name: 'test'},
          {title: '绑定银行卡', desc: '绑定银行卡才能进行提现。', text: '', name: 'card'},
          {title: '计算算力地址', desc: '请选择算力类型并设置算力地址', text: '', name: 'address'}
        ],
        form: {
          tel: [{name: 'mobile', type: 'text', title: '手机号码', placeholder: '请输入手机号', pattern: '^1[3578][0-9]{9}$', tips: '请输入11位手机号'}, {name: 'code', type: 'text', title: '短信验证', placeholder: '请输入短信验证码', addon: 2, pattern: '^.{6}$', tips: '短信验证码应是6位', error: '短信验证码有误，请重新获取', success: '发送成功'}],
          auth: [{name: 'truename', type: 'text', title: '姓名', placeholder: '请输入姓名', isChange: true}, {name: 'idcard', type: 'text', title: '证件号码', placeholder: '请输入您的证件号码', pattern: '^([0-9]{15}$|^[0-9]{18}$|^[0-9]{17}([0-9]|X|x))$', tips: '身份证号应是18位'}, {name: 'mobile', type: 'text', title: '手机号码', edit: 'disabled'}, {name: 'code', type: 'text', title: '短信验证', placeholder: '请输入短信验证码', addon: 2, pattern: '^.{6}$', tips: '短信验证码应是6位', error: '短信验证码有误，请重新获取', success: '发送成功'}],
          card: [{name: 'card_no', type: 'text', title: '银行卡号', placeholder: '请输入银行卡号', pattern: '^[0-9]{16,21}$', tips: '请输入16至21位的银行卡号'}, {name: 'open_bank', type: 'text', title: '开户银行', placeholder: '请输入开户银行名称', isChange: true}, {name: 'bank_branch', type: 'text', title: '开户支行', placeholder: '请输入开户支行名称', isChange: true}, {name: 'bank', type: 'select', title: '开户行地址', isChange: true}, {name: 'mobile', type: 'text', title: '银行预留手机号', placeholder: '请输入银行预留手机号', pattern: '^1[3578][0-9]{9}$', tips: '请输入11位手机号'}, {name: 'code', type: 'text', title: '手机验证码', placeholder: '请输入短信验证码', addon: 2, pattern: '^.{6}$', tips: '短信验证码应是6位', error: '短信验证码有误，请重新获取', success: '发送成功'}],
          address: [{name: 'product_hash_type', type: 'select', title: '算力类型', option: ['BTC'], unit: ''}, {name: 'address', type: 'text', title: '算力地址', placeholder: '请输入对应算力地址', pattern: '^[0-9a-zA-Z]{34}$', tips: '请输入34位的字符串'}, {name: 'mobile', type: 'text', title: '手机号码', edit: 'disabled'}, {name: 'code', type: 'text', title: '短信验证', placeholder: '请输入短信验证码', addon: 2, pattern: '^.{6}$', tips: '短信验证码应是6位', error: '短信验证码有误，请重新获取', success: '发送成功'}]
        },
        edit: '',
        title: '',
        product_hash_type: ''
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
        var tipsStr = ''
        switch (this.edit) {
          case 'tel':
            break
          case 'auth':
            url = 'user_truename'
            callbackUrl = 'show_user_truename'
            no = 1
            val = 'true_name'
            tipsStr = '实名认证已提交'
            break
          case 'card':
            url = 'BankCard'
            callbackUrl = 'show_bankcard'
            no = 3
            val = 'bank_card'
            tipsStr = '绑定成功'
            break
          case 'address':
            url = 'bindAddress'
            callbackUrl = 'show_Address'
            no = 4
            val = 'address'
            tipsStr = '设置成功'
            break
        }
        if (!data) return false
        var self = this
        util.post(url, {sign: api.serialize(Object.assign(data, sendData))}).then(function (back) {
          if (!back.code) {
            self.closeEdit()
            api.tips(self.$refs.tips, tipsStr)
            util.post(callbackUrl, {sign: api.serialize(sendData)}).then(function (res) {
              console.log(res)
              if (res) {
                self.nav[no].status = 1
                self.$store.commit('SET_INFO', {[val]: res})
              }
            })
          } else {
            api.tips(self.$refs.tips, back.msg)
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
