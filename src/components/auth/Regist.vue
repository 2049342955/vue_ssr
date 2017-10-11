<template>
  <form class="form regist" action="" @submit.prevent="regist" novalidate>
    <h2>欢迎注册算力网</h2>
    <FormField :form="form"></FormField>
    <label for="accept">
      <input type="checkbox" id="accept" name="accept" checked>
      <span>阅读并接受<router-link to="/auth/userAgreement">《用户协议》</router-link>及<router-link to="/auth/serviceTerms">《算力网服务条款》</router-link></span>
      <span class="select_accept">请选择</span>
    </label>
    <button>注册</button>
  </form>
</template>

<script>
  import util from '@/util/index'
  import api from '@/util/function'
  import FormField from '@/components/common/FormField'
  export default {
    name: 'regist',
    components: {
      FormField
    },
    data () {
      return {
        form: [{name: 'mobile', type: 'text', title: '手机号码', placeholder: '请输入手机号', pattern: '^1[3578][0-9]{9}$', tips: '请输入11位手机号'}, {name: 'imgCode', type: 'text', title: '图形验证', placeholder: '请输入图形验证码', addon: 1, pattern: '^.{4}$', tips: '图形验证码应是4位', error: '图形验证码错误，请重新输入'}, {name: 'code', type: 'text', title: '短信验证', placeholder: '请输入短信验证码', addon: 2, pattern: '^.{6}$', tips: '短信验证码应是6位', error: '短信验证码有误，请重新获取', success: '发送成功'}, {name: 'password', type: 'password', title: '设置密码', placeholder: '请输入密码', pattern: '^.{6,16}$', tips: '密码应是6到16位'}, {name: 'password1', type: 'password', title: '确认密码', placeholder: '请再次输入密码', pattern: '^.{6,16}$', tips: '密码应是6到16位', error: '两次密码不一致'}]
      }
    },
    methods: {
      regist () {
        var ff = document.querySelector('.regist')
        var data = api.checkFrom(ff)
        if (!data) return false
        if (!ff.accept.checked) {
          ff.accept.setAttribute('data-status', 'invalid')
          return false
        }
        util.post('/register', {sign: api.serialize(Object.assign(data, {token: 0}))}).then(res => {
          if (res) {
            this.$router.push({name: 'login'})
          }
        })
      }
    }
  }
</script>

<style type="text/css" lang="scss">
  @import '../../assets/css/style.scss';
  form.regist{
    @include form;
    .select_accept{
      color:$red;
      font-size: 12px;
    }
    input{
      & ~ span.select_accept{
        display: none;
      }
      &[data-status='invalid'] ~ span.select_accept{
        display: inline;
      }
    }
  }
</style>
