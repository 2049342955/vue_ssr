<template>
  <section class="transfer_list">
    <div class="bg_box">
      <div class="bg"></div>
    </div>
    <ProductNav page="computeTransfer"></ProductNav>
    <ProductList :sort="sort" :dataNav="dataNav" page="computeTransfer"></ProductList>
  </section>
</template>

<script>
  import util from '@/util'
  import api from '@/util/function'
  import { mapState } from 'vuex'
  import ProductList from '../common/ProductList'
  import ProductNav from '../common/ProductNav'
  export default {
    components: {
      ProductList, ProductNav
    },
    data () {
      return {
        computeDate: [],
        sort: [{title: '价格', option: ['transfer_price-asc', 'transfer_price-desc'], value: 0}, {title: '数量', option: ['transfer_amount-asc', 'transfer_amount-desc'], value: 0}, {title: '期限', option: ['transfer_time-asc', 'transfer_time-desc'], value: 0}, {title: '已使用时长', option: ['birth_time-asc', 'birth_time-desc'], value: 0}],
        dataNav: {'transfer_price': {title: '转让每T算力价格', unit: '元'}, 'transfer_amount': {title: '转让数量', unit: 'T'}, 'transfer_time': {title: '转让时长', unit: '天'}, 'original_price': {title: '原始算力价格', unit: '元'}, 'birth_time': {title: '已使用时长', unit: '天'}}
      }
    },
    methods: {
      fetchData () {
        var self = this
        this.now = this.$route.params.type
        this.show = false
        var obj = {}
        if (this.$route.params.sort === 'all') {
          obj = {token: this.token, product_hash_type: this.$route.params.type, page: 1}
        } else {
          obj = {token: this.token, product_hash_type: this.$route.params.type, order_type: this.$route.params.sort, page: 1}
        }
        util.post('getHashrates', {sign: api.serialize(obj)}).then(function (res) {
          console.log(res)
          self.computeDate = res.list
        })
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
  .transfer_list{
    .bg_box{
      @include bg(1920,420px,#12161d)
      z-index: -1;
      .bg{
        background:url(../../assets/images/cloudCompute.jpg) no-repeat;
      }
    }
  }
</style>
