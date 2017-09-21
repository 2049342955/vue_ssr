<template>
  <article class="regist">
    
  </article>
</template>

<script>
  import doregist from '@/util/index'
  export default {
    name: 'regist',
    data () {
      return {
        img: ''
      }
    },
    methods: {
      regist () {
        var data = {}
        var ff = document.querySelector('.regist form')
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
  
</style>
