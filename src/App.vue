<template>
  <article id="app">
    <MyHead></MyHead>
    <router-view class="body"/>
    <MyFoot v-if="$route.name!=='auth-login'&&$route.name!=='auth-regist'&&$route.name!=='auth-passwordRetrieval'"></MyFoot>
    <div class="toast"></div>
  </article>
</template>

<script>
  import util, { fetchApiData } from '@/util'
  import api from '@/util/function'
  import { mapState } from 'vuex'
  import MyHead from '@/components/common/Header'
  import MyFoot from '@/components/common/Footer'
  export default {
    components: {
      MyHead,
      MyFoot
    },
    methods: {
      pageInit () {
        if (this.token !== 0) {
          fetchApiData(this, 'getAll', {token: this.token}, (res) => {
            this.$store.commit('SET_INFO', res)
          })
        } else {
          setTimeout(() => {
            this.pageInit()
          }, 5)
        }
      }
    },
    mounted () {
      // 7.5 = 750 / 100
      var width = document.documentElement.clientWidth
      document.documentElement.style.fontSize = (width / 7.5) + 'px'
      window.addEventListener('orientationchange', function () {
        document.documentElement.style.fontSize = (width / 7.5) + 'px'
      })
      window.addEventListener('resize', function () {
        document.documentElement.style.fontSize = (width / 7.5) + 'px'
      })
      if (api.checkEquipment()) {
        this.$store.commit('SET_EQUIPMENT', 1)
      } else {
        this.$store.commit('SET_EQUIPMENT', 0)
      }
      if (this.token === 0) {
        this.$store.dispatch('getInfo')
      }
      this.pageInit()
      util.post('getCurrencys', {token: 0}).then((res) => {
        this.$store.commit('SET_HASH_TYPE', res.msg)
      })
    },
    computed: {
      ...mapState({
        token: state => state.info.token,
        isMobile: state => state.isMobile
      })
    }
  }
</script>

<style type="text/css" lang="scss">
  @import './assets/css/public.scss';
  @import './assets/fonts/iconfont.css';
</style>
