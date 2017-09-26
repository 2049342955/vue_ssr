<template>
  <header class="frame_header active">
    <section class="nav_list">
      <div class="logo">
        <router-link to="/"><img :src="logo"></router-link>
      </div>
      <nav>
        <div class="item" v-for="(i,k) in nav">
          <router-link :to="i">{{ k }}</router-link>
        </div>
      </nav>
      <div class="side_nav">
        <!-- <select name="" id="">
          <option value="0">chinese</option>
          <option value="1" selected>English</option>
        </select> -->
        <router-link to="/helpSupport/safeGuarantee">支撑</router-link>
        <router-link to="/helpSupport/aboutUs">关于</router-link>
        <router-link class="btn" to="/auth/regist" v-if="!token">注册</router-link>
        <router-link class="btn" to="/auth/regist" v-else>退出</router-link>
        <router-link class="border" to="/user/index">管理中心</router-link>
      </div>
    </section>
  </header>
</template>

<script>
  import { mapState } from 'vuex'
  export default {
    name: 'header',
    data () {
      return {
        nav: {'云矿机': '/cloudCompute/shop', '算力转让': '/computeTransfer/List', '矿机市场': '/mine', 'BDC展示区': '/bdc/list'},
        logo: require('@/assets/images/login_logo.png')
      }
    },
    created () {
      this.$store.dispatch('getInfo')
      window.addEventListener('scroll', this.test, false)
    },
    computed: {
      ...mapState({
        token: state => state.token,
        info: state => state.info
      })
    },
    methods: {
      logout () {
        this.$store.commit('LOGOUT')
      },
      test (e) {
        var ele = document.querySelector('.header')
        if ((ele.classList.contains('active') && e.target.scrollingElement.scrollTop > 0) || this.showNav) {
          ele.classList.add('bg_opacity')
          this.scroll = true
        } else {
          ele.classList.remove('bg_opacity')
          this.scroll = false
        }
      }
    }
  }
</script>

<style type="text/css" lang="scss">
  @import '../../assets/css/style.scss';
  .frame_header{
    @include position(0,0,auto,0)
    position: fixed;
    z-index: 2;
    &.bg_opacity{
      background: rgba(0,0,0,.8);
      a.border{
        background:$blue;
        border:1px solid transparent;
      }
      .nav_list select{
        background: rgba(0,0,0,.8);
      }
    }
    .nav_list{
      @include main
      @include flex
      @include gap(20,v)
      .logo{
        @include fitimg(139,51)
      }
      a,select{
        color:$white
      }
      select{
        background: #1342ac;
      }
      a:hover{
        border-bottom:1px solid $white
      }
      nav{
        flex:1;
        @include flex
        padding-left:60px;
        .item{
          @include gap(20,h)
          a{
            font-size: 16px
          }
        }
      }
      .side_nav{
        a{
          @include gap(10,h)
        }
        a.btn,a.border{
          @include gap(0,h)
          display: inline-block;
          width:70px;
          text-align: center;
          @include gap(5,h,margin)
          border-radius:3px
        }
        a.btn{
          background:$white;
          border:1px solid transparent;
          color:$blue
        }
        a.border{
          border:1px solid $blue
        }
      }
    }
  }
</style>
