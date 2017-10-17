<template>
  <header :class="[{frame_header: !$route.path.includes('user')&&!$route.path.includes('/detail')&&!$route.path.includes('account')&&!$route.path.includes('other')}, {border_box: $route.path.includes('bdc')||$route.path.includes('login')}, {auth_box:$route.path.includes('auth')&&!$route.path.includes('login')}, {user_box:$route.path.includes('user')||$route.path.includes('account')||$route.path.includes('/detail')||$route.path.includes('other')}]">
    <section class="box">
      <router-link class="logo" to="/"></router-link>
      <nav>
        <span v-if="$route.path.includes('regist')">用户注册</span>
        <span v-else-if="$route.path.includes('passwordRetrieval')">找回密码</span>
        <div class="item" v-for="(i,k) in nav" v-else>
          <router-link :to="i">{{ k }}</router-link>
        </div>
      </nav>
      <div class="side_nav">
        <template v-if="$route.path.includes('auth')">
          <router-link to="/" v-if="$route.path.includes('login')">返回首页</router-link>
          <div class="text" v-else>
            <span>已经拥有账号,</span>
            <router-link to="/auth/login">直接登录</router-link>
          </div>
        </template>
        <template v-else>
          <router-link to="/other/safeGuarantee">支持</router-link>
          <router-link to="/other/aboutUs">关于</router-link>
          <template v-if="token===0">
            <router-link class="btn" to="/auth/login">登录</router-link>
            <router-link class="border" to="/auth/regist">注册</router-link>
          </template>
          <template v-else>
            <router-link class="tel" to="/user/computeProperty">{{mobile|format}}</router-link>
            <a href="javascript:;" @click="logout">退出</a>
          </template>
        </template>
      </div>
    </section>
  </header>
</template>

<script>
  import api from '../../util/function'
  import { mapState } from 'vuex'
  export default {
    name: 'header',
    data () {
      return {
        nav: {'云矿机商城': '/cloudCompute/list/1/all', '算力转让区': '/computeTransfer/list/1/all', 'BDC展示区': '/bdc/list'}
      }
    },
    created () {
      window.addEventListener('scroll', this.test, false)
      if (this.token === 0) {
        this.$store.dispatch('getInfo')
      }
    },
    computed: {
      ...mapState({
        token: state => state.info.token,
        user_id: state => state.info.user_id,
        mobile: state => state.info.mobile
      })
    },
    methods: {
      logout () {
        this.$router.push({name: 'home'})
        this.$store.commit('LOGOUT')
      },
      test (e) {
        var ele = document.querySelector('.frame_header')
        if (!ele) return false
        if (e.target.scrollingElement.scrollTop > 0 || this.showNav) {
          ele.classList.add('bg_opacity')
          this.scroll = true
        } else {
          ele.classList.remove('bg_opacity')
          this.scroll = false
        }
      }
    },
    filters: {
      format: api.telReadable
    }
  }
</script>

<style type="text/css" lang="scss">
  @import '../../assets/css/style.scss';
  .logo{
    display: block;
    width: 145px;
    height: 51px;
  }
  .frame_header{
    @include position(0,0,auto,0)
    position: fixed;
    z-index: 5;
    &.bg_opacity{
      background: rgba(0,0,0,.8);
    }
    .box .logo{
      background: url('../../assets/images/css_sprites.png') -10px -81px
    }
    a{
      color:$white
    }
    .tel{
      color:$white
    }
  }
  .border_box{
    border-bottom:1px solid $light_text;
  }
  .auth_box{
    position: relative;
    z-index: 2;
    box-shadow:0px 4px 7px 0px rgba(138, 126, 126, 0.21);
    &.bg_opacity{
      background: transparent
    }
  }
  .auth_box,.user_box{
    .box{
      .logo{
        background: url('../../assets/images/css_sprites.png') -10px -10px;
      }
      nav .item a{
        color:$text;
        &:hover,&.router-link-active{
          border-bottom:1px solid $text
        }
      }
      .side_nav{
        a{
          color:$text;
        }
        .text{
          color:$light_text;
          a{
            color:$blue
          }
        }
        .tel{
          color: $blue;
          font-weight: bold;
        }
      }
    }
  }
  header{
    .box{
      @include main
      @include flex
      height:80px;
      nav{
        flex:1;
        @include flex
        margin-left:60px;
        .item{
          @include gap(20,h)
          a{
            font-size: 16px;
            &:hover{
              border-bottom:1px solid $white
            }
          }
        }
        span{
          color:$light_text;
          margin-left:-45px;
          padding-left:15px;
          border-left:1px solid $border
        }
      }
      .side_nav{
        a{
          @include gap(10,h)
          &.btn,&.border{
            @include gap(0,h)
            display: inline-block;
            width:70px;
            text-align: center;
            @include gap(5,h,margin)
            border-radius:3px
          }
          &.btn{
            background:$white;
            border:1px solid transparent;
            color:$blue
          }
          &.border{
            border:1px solid hsla(0,0%,100%,.4)
          }
        }
      }
    }
  }
</style>
