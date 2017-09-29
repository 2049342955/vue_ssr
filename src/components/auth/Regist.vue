<template>
  <form class="regist" action="" @submit.prevent="regist" novalidate>
    <h2>欢迎注册算力网</h2>
    <div :class="['input', {addon: f.addon}]" v-for="f in form">
      <span>{{f.title}}</span>
      <span>*</span>
      <input :type="f.type" :name="f.name" autocomplete="off" :placeholder="f.placeholder" @blur="test" :pattern="f.pattern" data-status="">
      <template v-if="f.addon">
        <canvas id="code" width="90" height="40" v-if="f.addon===1" @click="changeCode"></canvas>
        <div class="btn" v-if="f.addon===2" @click="getCode">{{f.con}}</div>
      </template>
      <span :title="f.tips" :tips="f.placeholder" :error="f.error"></span>
    </div>
    <label for="accept">
      <input type="checkbox" id="accept" name="accept" checked>
      <span>阅读并接受<router-link to="/auth/userAgreement">《用户协议》</router-link>及<router-link to="/auth/serviceTerms">《算力网服务条款》</router-link></span>
    </label>
    <button>注册</button>
  </form>
</template>

<script>
  import util from '@/util/index'
  import api from '@/util/function'
  export default {
    name: 'regist',
    data () {
      return {
        form: [{name: 'mobile', type: 'text', title: '手机号码', placeholder: '请输入手机号', pattern: '^1[3578][0-9]{9}$', tips: '请输入11位手机号'}, {name: 'imgCode', type: 'text', title: '图形验证', placeholder: '请输入图形验证码', addon: 1, pattern: '^.{4}$', tips: '图形验证码应是4位', error: '图形验证码错误，请重新输入'}, {name: 'code', type: 'text', title: '短信验证', placeholder: '请输入短信验证码', addon: 2, con: '发送验证码', pattern: '^.{6}$', tips: '短信验证码应是6位', error: '短信验证码有误，请重新获取'}, {name: 'password', type: 'password', title: '设置密码', placeholder: '请输入密码', pattern: '^.{6,16}$', tips: '密码应是6到16位'}, {name: 'password1', type: 'password', title: '确认密码', placeholder: '请再次输入密码', pattern: '^.{6,16}$', tips: '密码应是6到16位', error: '两次密码不一致'}],
        code: ''
      }
    },
    mounted () {
      this.changeCode()
    },
    methods: {
      regist () {
        var ff = document.querySelector('.regist')
        var data = api.checkFrom(ff)
        if (!data) return false
        util.post('/register', {sign: api.serialize(Object.assign(data, {token: 0, ip: '192.168.3.131'}))}).then(res => {
          console.log(res)
          if (res.msg) {
            this.$router.push({name: 'login'})
          }
        })
      },
      test (e) {
        var ele = e.target
        this.check(ele)
      },
      check (ele) {
        var ff = document.querySelector('.regist')
        if (ele.value && (ele.name === 'imgCode' && ele.value.toLowerCase() !== this.code.toLowerCase()) || (ele.name === 'password1' && ele.value !== ff.password.value)) {
          ele.setAttribute('data-status', 'error')
        }
        api.checkFiled(ele)
      },
      changeCode () {
        var ele = document.querySelector('#code')
        this.code = api.createCode(ele)
      },
      getCode () {
        var form = document.querySelector('.regist')
        if (!api.checkCode(form)) return false
        util.post('/send_code', {sign: api.serialize({token: 0, mobile: form[0].value, ip: '192.168.3.131'})}).then(res => {
          console.log(res)
        })
      }
    }
  }
</script>

<style type="text/css" lang="scss">
  @import '../../assets/css/style.scss';
  form.regist{
    @include form
  }
</style>
