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
  import doregist from '@/util/index'
  import api from '@/util/function'
  export default {
    name: 'regist',
    data () {
      return {
        form: [{name: 'tel', type: 'text', title: '手机号码', placeholder: '请输入手机号', pattern: '^1[3578][0-9]{9}$', tips: '请输入11位手机号'}, {name: 'imgCode', type: 'text', title: '图形验证', placeholder: '请输入图形验证码', addon: 1, pattern: '^.{4}$', tips: '图形验证码应是4位', error: '图形验证码错误，请重新输入'}, {name: 'code', type: 'text', title: '短信验证', placeholder: '请输入短信验证码', addon: 2, con: '发送验证码', pattern: '^.{6}$', tips: '短信验证码应是6位', error: '短信验证码有误，请重新获取'}, {name: 'pwd', type: 'password', title: '设置密码', placeholder: '请输入密码', pattern: '^.{6,16}$', tips: '密码应是6到16位'}, {name: 'repwd', type: 'password', title: '确认密码', placeholder: '请再次输入密码', pattern: '^.{6,16}$', tips: '密码应是6到16位', error: '两次密码不一致'}],
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
        doregist('/user/regist', data).then(res => {
          alert(res)
          if (res === '注册成功') {
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
        if (ele.value && (ele.name === 'imgCode' && ele.value.toLowerCase() !== this.code.toLowerCase()) || (ele.name === 'repwd' && ele.value !== ff[3].value)) {
          ele.setAttribute('data-status', 'error')
        }
        api.checkFiled(ele)
      },
      changeCode () {
        var ele = document.querySelector('#code')
        this.code = api.createCode(ele)
      },
      getCode () {
        if (api.checkCode(document.querySelector('.regist'))) return false
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
