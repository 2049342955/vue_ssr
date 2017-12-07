<template>
  <header id="header" class="mobile-header" :class="headerClass"
  :disabled="$route.name==='notFound'" v-if="showRouter.includes($route.name)">
    <div class="left" v-if="mobile !== ''">
      <router-link to="/auth/regist">注册</router-link>
      <span>|</span>
      <router-link to="/auth/login">登录</router-link>
    </div>
    <div v-else class="left">
      <i class="iconfont icon-customer-service"></i>
    </div>
    <img class="logo" :src="require('@/assets/images/mobile/logo.png')">
  </header>
</template>

<script>
  import { mapState } from 'vuex'
  export default {
    data () {
      return {
        headerClass: '',
        article: {
          title: 'Blockchain Data Center'
        },
        showRouter: ['home']
      }
    },
    mounted () {
      window.addEventListener('scroll', this.scrollEvent, false)
    },
    methods: {
      scrollEvent (e) {
        let ele = document.getElementById('header')
        if (!ele) return false
        let scrollTop = document.documentElement.scrollTop || window.pageYOffset || document.body.scrollTop
        if (scrollTop > 0 || this.showNav) {
          ele.className = 'fixed_header'
        } else {
          ele.className = ''
        }
      }
    },
    computed: {
      ...mapState({
        mobile: state => state.info.mobile
      })
    }
  }
</script>

<style type="text/css" lang="scss">
  @import '../../../assets/css/style.scss';
  @import '../../../assets/fonts/iconfont.css';
  header {
    width: 100%;
    height: 45px;
    padding: 0 15px;
    box-sizing: border-box;
    background: #fff;
    @include flex;

    .left {
      position: absolute;
      left: 15px;
      top: 12px;

      a {
        color: #666;
      }

      i {
        font-size: 20px;
      }
    }

    .logo {
      width: 90px;
      height: 20px;
      margin: 0 auto;
    }
  }

</style>
