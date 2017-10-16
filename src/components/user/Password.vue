<template>
  <section class="password">
    <h2>密码管理</h2>
    <Setting :nav="nav" type="password"></Setting>
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
  import md5 from 'js-md5'
  export default {
    components: {
      MyMask, Setting
    },
    data () {
      return {
        nav: [
          {title: '登录密码', desc: '登录算力网的重要凭证', text: '登录密码', name: 'login'},
          {title: '交易密码', desc: '购买算力、转让算力需要验证交易密码', text: '交易密码', name: 'trade'}
        ],
        form: {
          login: [{name: 'mobile', type: 'text', title: '手机号码', edit: 'disabled'}, {name: 'code', type: 'text', title: '短信验证', placeholder: '请输入短信验证码', addon: 2, pattern: '^.{6}$', tips: '短信验证码应是6位', error: '短信验证码有误，请重新获取', success: '发送成功'}, {name: 'password', type: 'password', title: '设置密码', placeholder: '请输入密码', pattern: '^.{6,16}$', tips: '密码应是6到16位'}, {name: 'password1', type: 'password', title: '确认密码', placeholder: '请再次输入密码', pattern: '^.{6,16}$', tips: '密码应是6到16位', error: '两次密码不一致'}],
          trade: [{name: 'mobile', type: 'text', title: '手机号码', edit: 'disabled'}, {name: 'code', type: 'text', title: '短信验证', placeholder: '请输入短信验证码', addon: 2, pattern: '^.{6}$', tips: '短信验证码应是6位', error: '短信验证码有误，请重新获取', success: '发送成功'}, {name: 'trade_password', type: 'password', title: '设置密码', placeholder: '请输入密码', pattern: '^.{6,16}$', tips: '密码应是6到16位'}, {name: 'trade_password1', type: 'password', title: '确认密码', placeholder: '请再次输入密码', pattern: '^.{6,16}$', tips: '密码应是6到16位', error: '两次密码不一致'}]
        },
        edit: false,
        title: ''
      }
    },
    methods: {
      submit () {
        var form = document.querySelector('.form_content')
        var data = api.checkFrom(form)
        var url = ''
        var sendData = {token: this.token, user_id: this.user_id}
        switch (this.edit) {
          case 'login':
            url = 'changeLoginPassword'
            break
          case 'trade':
            url = 'tradePassword'
            data.trade_password = md5(data.trade_password)
            data.trade_password1 = md5(data.trade_password1)
            break
        }
        if (!data) return false
        var self = this
        util.post(url, {sign: api.serialize(Object.assign(data, sendData))}).then(function (res) {
          if (res) {
            api.tips(self.$refs.tips, '修改成功')
            self.closeEdit()
            self.$store.commit('SET_ITEM', {'trade_password': true})
          } else {
            api.tips(self.$refs.tips, '验证码错误')
          }
        })
      },
      closeEdit () {
        this.edit = ''
        document.body.style.overflow = 'auto'
      }
    },
    mounted () {
      var self = this
      util.post('judgeSetPassword', {sign: api.serialize({token: this.token, user_id: this.user_id})}).then(function (data) {
        console.log(data)
        if (data) {
          self.$store.commit('SET_ITEM', {'trade_password': true})
        }
      })
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
  .password{
    .mask{
      @include mask
      .form_box{
        .form_content{
          padding:40px 130px;
          @include form(v)
          width:450px
        }
      }
    }
  }
</style>
