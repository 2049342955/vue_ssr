<template>
  <section class="compute_shop">
    <div class="bg_box">
      <div class="bg">
        <h1>您最新的挖矿设备已经在运行！</h1>
        <router-link to="/cloudCompute/mining" class="button">了解挖矿</router-link>
      </div>
    </div>
    <div class="mobile_header">
      <span class="left">< <em>返回</em></span>
      <span>算力商城</span>
    </div>
    <ProductNav page="cloudCompute"></ProductNav>
    <ProductList :sort="sort" :dataNav="dataNav" page="cloudCompute"></ProductList>
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
  export default {
    components: {
      ProductList, ProductNav, Pager, SideBar
    },
    data () {
      return {
        computeDate: [],
        sort: [{title: '价格', option: ['price_asc', 'price_desc'], value: 0}, {title: '算力', option: ['base_asc', 'base_desc'], value: 0}, {title: '出售总数', option: ['num_asc', 'num_desc'], value: 0}],
        dataNav: {'one_amount_value': {title: '每台服务器价格', unit: '元'}, 'hash': {title: '每台服务器算力', unit: 'T'}, 'buyed_amount': {title: '出售服务器总数', unit: '台'}, 'leftNum': {title: '剩余可售服务器', unit: '台'}},
        len: 0,
        now: 1,
        show: false
      }
    },
    methods: {
      fetchData () {
        var self = this
        var obj = {}
        if (this.$route.params.sort === 'all') {
          obj = {token: this.token, product_type: this.$route.params.type, page: this.now}
        } else {
          obj = {token: this.token, product_type: this.$route.params.type, sort: this.$route.params.sort, page: this.now}
        }
        util.post('productList', {sign: api.serialize(obj)}).then(function (res) {
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
      @include bg(1920,420px,#1863f0)
      .bg{
        background:url(../../assets/images/cloudCompute.jpg) no-repeat;
        h1{
          width: 100%;
          text-align: center;
          font-size: 35px;
          color: white;
          margin-top:163px;
          margin-bottom: 30px;
        }
        .button{
          width: 190px;
          height: 45px;
          display: block;
          text-align: center;
          line-height: 45px;
          border-radius: 5px;
          background: white;
          border:0;
          position: absolute;
          left: 50%;
          margin-left: -95px;
          color: #327fff;
          font-size: 16px;
          z-index: 9999;
          cursor: pointer !important;
        }
        .button:hover{
          cursor: pointer !important;
        }
      }
      @include mobile_hide
    }
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
    }
    .sort{
      border:0;
      border-bottom: 1px solid #e8e8e8;
    }
  }
</style>
