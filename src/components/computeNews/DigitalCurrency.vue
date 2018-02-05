<template>
   <div class="currency_right">
    <h1>主流币种资料<span class="icon iconfont icon-dui"></span></h1>
    <div class="currency_toplist">
      <router-link :to="'/digitalCurrency/detail/' + n.id" class="toplist" v-for="n, k in toplists" :key="k">
        <img :src="n.icon"/>
        <span>{{n.coin_name}}</span>
      </router-link>
    </div>
    <h1 class="bottomlist">各类代币资料<span class="icon iconfont icon-dui"></span></h1>
    <div class="currency_toplist">
      <router-link :to="'/digitalCurrency/detail/' + n.id" class="toplist" v-for="n, k in bottomlists" :key="k">
        <img :src="n.icon"/>
        <span>{{n.coin_name}}</span>
      </router-link>
    </div>
  </div>
</template>

<script>
  import util from '@/util/index'
  import api from '@/util/function'
  import { mapState } from 'vuex'
  export default {
    data () {
      return {
        toplists: [{unit: require('@/assets/images/BDC-2.png'), name: '比特币(Bitcoin)'}, {unit: require('@/assets/images/BDC-2.png'), name: '比特币(Bitcoin)'}],
        bottomlists: [{unit: require('@/assets/images/BDC-2.png'), name: '比特币(Bitcoin)'}, {unit: require('@/assets/images/BDC-2.png'), name: '比特币(Bitcoin)'}]
      }
    },
    methods: {
      getList () {
        var self = this
        util.post('showCoinInfo', {sign: api.serialize({token: this.token})}).then(function (res) {
          api.checkAjax(self, res, () => {
            self.toplists = res.main_coin
            self.bottomlists = res.other_coin
          })
        }).catch(res => {
          console.log(res)
        })
      }
    },
    mounted () {
      this.getList()
    },
    computed: {
      ...mapState({
        token: state => state.info.token
      })
    }
  }
</script>

<style lang="scss" scoped>
  .currency_right{
    float: left;
    width: 1002px;
    height: 1424px;
    background: white;
    padding:32px 62px 0 62px;
    box-sizing: border-box;
    h1{
      color: #121212;
      font-size: 24px;
      font-weight: 800;
      span{
        font-size: 20px;
        margin-left: 13px;
      }
    }
    .bottomlist{
        margin-top: 58px;
    }
    .currency_toplist{
      width: 100%;
      margin-top: 30px;
      overflow: hidden;
      .toplist{
        width: 240px;
        height: 45px;
        border:1px solid #bfbfbf;
        float: left;
        display:block;
        margin-right: 10px;
        margin-bottom: 17px;
        img{
          width:30px;
          height: auto;
          margin-top: 6px;
          margin-left: 20px;
          position: relative;
          top:-8px;
        }
        span{
          margin-left: 20px;
          line-height: 45px;
          font-size: 14px;
          color: #333333;
        }
      }
    }
  }
</style>

