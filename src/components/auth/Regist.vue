<template>
  <form class="regist" action="" @submit.prevent="regist">
    <h2>欢迎注册算力网</h2>
    <div :class="['input', {addon: f.addon}]" v-for="f in form">
      <span>{{f.title}}</span>
      <span>*</span>
      <input type="text" :name="f.name" :placeholder="f.placeholder">
      <template v-if="f.addon">
        <div class="btn" v-if="f.addon===1"><img :src="f.con" alt="img code"></div>
        <div class="btn" v-if="f.addon===2">发送验证码</div>
      </template>
    </div>
    <label for="accept">
      <input type="checkbox" id="accept" name="accept" checked>
      <span>阅读并接受《用户协议》及《算力网服务条款》</span>
    </label>
    <button>注册</button>
  </form>
</template>

<script>
  import doregist from '@/util/index'
  export default {
    name: 'regist',
    data () {
      return {
        form: [{name: 'tel', title: '手机号码', placeholder: '请输入手机号'}, {name: 'imgCode', title: '图形验证', placeholder: '请输入短信验证码', addon: 1, con: require('@/assets/images/img_code.png')}, {name: 'code', title: '短信验证', placeholder: '请输入短信验证码', addon: 2, con: '发送验证码'}, {name: 'pwd', title: '设置密码', placeholder: '密码应在6-16位之间'}, {name: 'repwd', title: '确认密码', placeholder: '请再次输入密码'}]
      }
    },
    methods: {
      regist () {
        var data = {}
        var ff = document.querySelector('.regist')
        for (var i = 0; i <= ff.length - 2; i++) {
          if (ff[i].name === 'confirmPwd' && ff[i].value !== data.pwd) {
            alert('两次密码不一致')
            return false
          } else if (ff[i].name === 'accept') {
            data[ff[i].name] = ff[i].checked
          } else {
            data[ff[i].name] = ff[i].value
          }
        }
        doregist('/user/regist', data).then(res => {
          alert(res)
          if (res === '注册成功') {
            this.$router.push({name: 'login'})
          }
        })
      }
    }
  }
</script>

<style type="text/css" lang="scss">
  @import '../../assets/css/style.scss';
  form{
    @include form
  }
</style>
