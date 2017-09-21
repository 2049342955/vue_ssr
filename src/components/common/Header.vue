<template>
  <header class="header">
    <section>
      <aside class="info">
        <span>客服电话：</span>
        <span class="active">400-888-6666</span>
        <span>工作日(9:00-18:00)</span>
      </aside>
      <nav>
        <template v-if="!token">
          <router-link to="/auth/login">登录</router-link>
          <span class="line"></span>
          <router-link to="/auth/regist">注册</router-link>
        </template>
        <template v-if="token">
          <span class="active">您好！{{info.userName}}（{{info.mob?info.mob.replace(/(\d{3})\d{4}(\d{4})/, '$1****$2'):''}}）</span>
          <span class="line"></span>
          <span class="out"  @click="logout">[退出]</span>
        </template>
      </nav>
    </section>
  </header>
</template>

<script>
  import { mapState } from 'vuex'
  export default {
    name: 'header',
    data () {
      return {
        location: ''
      }
    },
    created () {
      this.$store.dispatch('getInfo')
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
      }
    }
  }
</script>

<style type="text/css" lang="scss">
  @import '../../assets/css/style.scss';
  .header{
    background: $text;
    section{
      color:$light_white;
      line-height: 36px;
      @include main
      font-size: 12px;
      @include flex(space-between)
      .info{
        .active{
          font-size: 14px;
          @include gap(15,right)
          font-weight: bold;
          color:$dark_white
        }
      }
      nav{
        @include flex
        a{
          color:$light_white;
          &:hover{
            color:$white
          }
        }
        .active{
          color: $dark_white
        }
        .line{
          width: 1px;
          height: 11px;
          @include gap(10,h,margin)
          background:$light_text
        }
        .out{
          cursor: pointer
        }
      }
    }
  }
</style>
