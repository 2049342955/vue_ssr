<template>
  <section class="compute_shop">
    <!-- <ProductNav page="minerShop" v-if="active"></ProductNav> -->
    <Sort :sort="sort" page="minerShop"></Sort>
    <ProductList :dataNav="dataNav" page="minerShop"></ProductList>
    <Pager :len="len"></Pager>
    <SideBar></SideBar>
  </section>
</template>

<script>
  import util from '@/util'
  import api from '@/util/function'
  import { mapState } from 'vuex'
  import ProductList from '../common/ProductList'
  import ProductNav from '../common/ProductNav'
  import Pager from '@/components/common/Pager'
  import SideBar from '@/components/home/SideBar'
  import Sort from '@/components/common/Sort'
  export default {
    components: {
      ProductList, ProductNav, Pager, SideBar, Sort
    },
    data () {
      return {
        computeDate: [],
        sort: [{title: '价格', option: ['price_asc', 'price_desc'], value: 0}, {title: '算力', option: ['base_asc', 'base_desc'], value: 0}, {title: '出售总数', option: ['num_asc', 'num_desc'], value: 0}],
        dataNav: {'one_amount_value': {title: '每台服务器价格', unit: '元'}, 'hash': {title: '每台服务器算力', unit: 'T'}, 'buyed_amount': {title: '出售服务器总数', unit: '台'}, 'leftNum': {title: '剩余可售服务器', unit: '台'}},
        len: 0,
        now: 1,
        show: false,
        active: 0,
        nav: ['矿机超市', '云矿机商城']
      }
    },
    methods: {
      fetchData () {
        var self = this
        var obj = {token: this.token, page: this.now}
        var url = ''
        if (this.$route.params.sort !== 'all') {
          obj = Object.assign({sort: this.$route.params.sort}, obj)
        }
        if (this.$route.params.type === '1') {
          url = 'showList'
        } else {
          url = 'productList'
        }
        util.post(url, {sign: api.serialize(obj)}).then(function (res) {
          api.checkAjax(self, res, () => {
            self.computeDate = res.data
            self.show = !res.data.length
            if (self.now > 1) return false
            self.len = res.page.total_page
          })
        })
      },
      getList () {
        this.fetchData()
      },
      changeType (k) {
        this.active = k
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
    background: #f7f8fa;
    .pager{
      background: #f7f8fa;
      padding-top:0;
      padding-bottom:30px;
      .pager_box{
        border:0;
        @include main
        background: #fff;
        padding:30px 15px;
      }
      @include mobile_hide
    }
    .sort{
      @include mobile_hide
    }
  }
</style>
