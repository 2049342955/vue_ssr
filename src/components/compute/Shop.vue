<template>
  <section class="compute_shop">
    <div class="bg_box">
      <div class="bg"></div>
    </div>
    <ProductNav page="cloudCompute"></ProductNav>
    <ProductList :sort="sort" :dataNav="dataNav" page="cloudCompute"></ProductList>
    <Pager :len="len"></Pager>
  </section>
</template>

<script>
  import util from '@/util'
  import api from '@/util/function'
  import { mapState } from 'vuex'
  import ProductList from '../common/ProductList'
  import ProductNav from '../common/ProductNav'
  import Pager from '@/components/common/Pager'
  export default {
    components: {
      ProductList, ProductNav, Pager
    },
    data () {
      return {
        computeDate: [],
        sort: [{title: '价格', option: ['price_asc', 'price_desc'], value: 0}, {title: '算力', option: ['base_asc', 'base_desc'], value: 0}, {title: '出售总数', option: ['num_asc', 'num_desc'], value: 0}],
        dataNav: {'one_amount_value': {title: '每台服务器价格', unit: '元'}, 'hash': {title: '每台服务器算力', unit: 'T'}, 'amount': {title: '出售服务器总数', unit: '台'}, 'leftNum': {title: '剩余可售服务器', unit: '台'}},
        len: 0,
        now: 1,
        show: false
      }
    },
    methods: {
      fetchData () {
        var self = this
        var obj = {}
        if (this.$route.params.sort === 'default') {
          obj = {token: this.token, product_type: this.$route.params.type, page: this.now}
        } else {
          obj = {token: this.token, product_type: this.$route.params.type, sort: this.$route.params.sort, page: this.now}
        }
        util.post('productList', {sign: api.serialize(obj)}).then(function (res) {
          console.log(res)
          self.computeDate = res.data
          self.show = !res.list.length
          if (self.now > 1) return false
          self.len = res.page.total_page
        })
      },
      getList () {
        this.fetchData()
      }
    },
    watch: {
      '$route': 'fetchData'
    },
    mounted () {
      this.fetchData()
    },
    computed: {
      ...mapState({
        token: state => state.info.token,
        user_id: state => state.info.user_id
      })
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
