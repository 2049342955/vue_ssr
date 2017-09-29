<template>
  <div>
    <form class="password" action="" @submit.prevent="password" novalidate v-show="!next">
      <h2>找回密码</h2>
      <div class="input" v-for="f in form">
        <span>{{f.title}}</span>
        <span>*</span>
        <input :class="f.name" :type="f.type" :name="f.name" autocomplete="off" :placeholder="f.placeholder" @blur="test" :pattern="f.pattern" data-status="">
        <template v-if="f.addon">
          <canvas id="code" width="90" height="40" v-if="f.addon===1" @click="changeCode"></canvas>
          <div class="btn" v-if="f.addon===2" @click="getCode">发送验证码</div>
        </template>
        <span :title="f.tips" :tips="f.placeholder" :error="f.error"></span>
      </div>
      <button>下一步</button>
    </form>
    <form class="next_form" action="" @submit.prevent="submit" novalidate v-show="next">
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
  // import doregist from '@/util/index'
  import api from '@/util/function'
  export default {
    name: 'regist',
    data () {
      return {
        form: [{name: 'tel', type: 'text', title: '手机号码', placeholder: '请输入手机号', pattern: '^1[3578][0-9]{9}$', tips: '请输入11位手机号'}, {name: 'imgCode', type: 'text', title: '图形验证', placeholder: '请输入图形验证码', addon: 1, pattern: '^.{4}$', tips: '图形验证码应是4位', error: '图形验证码错误，请重新输入'}, {name: 'code', type: 'text', title: '短信验证', placeholder: '请输入短信验证码', addon: 2, con: '发送验证码', pattern: '^.{6}$', tips: '短信验证码应是6位', error: '短信验证码有误，请重新获取'}],
        nextForm: [{name: 'pwd', type: 'password', title: '设置密码', placeholder: '请输入密码', pattern: '^.{6,16}$', tips: '密码应是6到16位'}, {name: 'repwd', type: 'password', title: '确认密码', placeholder: '请再次输入密码', pattern: '^.{6,16}$', tips: '密码应是6到16位', error: '两次密码不一致'}],
        code: '',
        next: false
      }
    },
    mounted () {
      this.changeCode()
    },
    methods: {
      password () {
        var ff = document.querySelector('.password')
        var data = api.checkFrom(ff, this)
        if (!data) return false
        // doregist('/user/login', data).then(res => {
        //   if (res.bjt) {
        //     this.$router.push({name: 'home', params: {token: res.bjt}})
        //     this.$store.commit('setToken', res.bjt)
        //   } else {
        //     alert(res)
        //   }
        // })
        this.next = true
      },
      submit () {
        var ff = document.querySelector('.next_form')
        var data = api.checkFrom(ff, this)
        if (!data) return false
        // doregist('/user/login', data).then(res => {
        //   if (res.bjt) {
        //     this.$router.push({name: 'home', params: {token: res.bjt}})
        //     this.$store.commit('setToken', res.bjt)
        //   } else {
        //     alert(res)
        //   }
        // })
      },
      test (e) {
        var ele = e.target
        this.check(ele)
      },
      check (ele) {
        var ff = document.querySelector('.next_form')
        if (!ele.checkValidity()) {
          ele.setAttribute('data-status', 'invalid')
        } else {
          if (ele.value && (ele.name === 'imgCode' && ele.value.toLowerCase() !== this.code.toLowerCase()) || (ele.name === 'repwd' && ele.value !== ff.pwd.value)) {
            ele.setAttribute('data-status', 'error')
          } else {
            ele.setAttribute('data-status', 'valid')
            return true
          }
        }
      },
      changeCode () {
        var ele = document.querySelector('#code')
        this.code = api.createCode(ele)
      },
      getCode () {
        var ff = document.querySelector('.password')
        var c = true
        for (var i = 0; i <= 1; i++) {
          if (ff[i].value) {
            if (!this.check(ff[i])) {
              c = false
            }
          } else {
            ff[i].setAttribute('data-status', 'null')
            c = false
          }
        }
        if (!c) return false
      }
    }
  }
</script>

<style type="text/css" lang="scss">
  @import '../../assets/css/style.scss';
  form.password,form.next_form{
    @include form
  }
</style>
