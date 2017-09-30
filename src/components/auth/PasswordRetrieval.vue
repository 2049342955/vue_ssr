<template>
  <div>
    <form class="password form" action="" @submit.prevent="submit(1)" novalidate v-if="!next">
      <h2>找回密码</h2>
      <FormField :form="form"></FormField>
      <button>下一步</button>
    </form>
    <form class="next_form form" action="" @submit.prevent="submit" novalidate v-else>
      <h2>找回密码</h2>
      <div class="input" v-for="f in nextForm">
        <span>{{f.title}}</span>
        <span>*</span>
        <input :class="f.name" :type="f.type" :name="f.name" autocomplete="off" :placeholder="f.placeholder" @blur="test" :pattern="f.pattern" data-status="">
        <span :title="f.tips" :tips="f.placeholder" :error="f.error"></span>
      </div>
      <button>提交</button>
    </form>
  </div>
</template>

<script>
  import util from '@/util/index'
  import api from '@/util/function'
  import { mapState } from 'vuex'
  import FormField from '@/components/common/FormField'
  export default {
    name: 'regist',
    components: {
      FormField
    },
    data () {
      return {
        form: [{name: 'mobile', type: 'text', title: '手机号码', placeholder: '请输入手机号', pattern: '^1[3578][0-9]{9}$', tips: '请输入11位手机号'}, {name: 'imgCode', type: 'text', title: '图形验证', placeholder: '请输入图形验证码', addon: 1, pattern: '^.{4}$', tips: '图形验证码应是4位', error: '图形验证码错误，请重新输入'}, {name: 'code', type: 'text', title: '短信验证', placeholder: '请输入短信验证码', addon: 2, pattern: '^.{6}$', tips: '短信验证码应是6位', error: '短信验证码有误，请重新获取', success: '发送成功'}],
        nextForm: [{name: 'password', type: 'password', title: '设置密码', placeholder: '请输入密码', pattern: '^.{6,16}$', tips: '密码应是6到16位'}, {name: 'password1', type: 'password', title: '确认密码', placeholder: '请再次输入密码', pattern: '^.{6,16}$', tips: '密码应是6到16位', error: '两次密码不一致'}],
        next: false,
        code_id: '',
        valid_code: '',
        mobile: ''
      }
    },
    methods: {
      submit (n) {
        var ff = document.querySelector('.form')
        var data = api.checkFrom(ff)
        if (!data) return false
        var self = this
        if (n === 1) {
          util.post('valid_code', {sign: api.serialize(Object.assign(data, {token: this.token}))}).then(res => {
            console.log(res)
            self.mobile = data.mobile
            self.code_id = res.id
            self.valid_code = res.valid_code
            self.next = true
          })
        } else {
          util.post('forgitPwd', {sign: api.serialize(Object.assign(data, {token: this.token, valid_code: this.valid_code, code_id: this.code_id, mobile: this.mobile}))}).then(res => {
            if (res === '修改成功') {
              this.$router.push({name: 'login'})
            }
          })
        }
      },
      test (e) {
        var ele = e.target
        var ff = document.querySelector('.form')
        api.checkFiled(ele, ff)
      }
    },
    computed: {
      ...mapState({
        token: state => state.info.token
      })
    }
  }
</script>

<style type="text/css" lang="scss">
  @import '../../assets/css/style.scss';
  form.password,form.next_form{
    @include form
  }
</style>
