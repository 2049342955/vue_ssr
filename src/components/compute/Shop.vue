<template>
  <section class="compute_shop">
    <div class="bg_box">
      <div class="bg"></div>
    </div>
    <ProductNav page="cloudCompute"></ProductNav>
    <ProductList :sort="sort" :dataNav="dataNav" page="cloudCompute"></ProductList>
  </section>
</template>

<script>
  import util from '@/util'
  import api from '@/util/function'
  import ProductList from '../common/ProductList'
  import ProductNav from '../common/ProductNav'
  export default {
    components: {
      ProductList, ProductNav
    },
    data () {
      return {
        computeDate: [{id: 1, title: '阿瓦隆001号', type: 'btc', price: 10000, hash: '9.0', number: 500, leftNum: 199}, {id: 1, title: '阿瓦隆001号', type: 'btc', price: 10000, hash: '9.0', number: 500, leftNum: 199}, {id: 1, title: '阿瓦隆001号', type: 'btc', price: 10000, hash: '9.0', number: 500, leftNum: 199}, {id: 1, title: '阿瓦隆001号', type: 'btc', price: 10000, hash: '9.0', number: 500, leftNum: 199}, {id: 1, title: '阿瓦隆001号', type: 'btc', price: 10000, hash: '9.0', number: 500, leftNum: 199}, {id: 1, title: '阿瓦隆001号', type: 'btc', price: 10000, hash: '9.0', number: 500, leftNum: 199}],
        sort: [{title: '价格', option: ['price_asc', 'price_desc'], value: 0}, {title: '算力', option: ['base_asc', 'base_desc'], value: 0}, {title: '出售总数', option: ['num_asc', 'num_desc'], value: 0}],
        dataNav: {'price': {title: '每台服务器价格', unit: '元'}, 'hash': {title: '每台服务器算力', unit: 'T'}, 'number': {title: '出售服务器总数', unit: '台'}, 'leftNum': {title: '剩余可售服务器', unit: '台'}}
      }
    },
    methods: {
      fetchData () {
        var self = this
        this.now = this.$route.params.type
        this.show = false
        // console.log(this.$route.params.type)
        // console.log(this.$route.params.sort)
        util.post('fundOrder', {sign: api.serialize({token: this.token, user_id: this.user_id})}).then(function (res) {
          self.data = res
        })
      }
    },
    watch: {
      '$route': 'fetchData'
    },
    mounted () {
      this.fetchData()
    }
  }
</script>

<style type="text/css" lang="scss">
  @import '../../assets/css/style.scss';
  @import '../../assets/fonts/iconfont.css';
  .compute_shop{
    .bg_box{
      @include bg(1920,420px,#12161d)
      z-index: -1;
      .bg{
        background:url(../../assets/images/cloudCompute.jpg) no-repeat;
      }
    }
  }
</style>
