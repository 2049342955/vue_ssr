<template>
  <section class="transfer_list">
    <div class="bg_box">
      <div class="bg"></div>
    </div>
    <ProductNav page="compute"></ProductNav>
    <CloudMinerList :sort="sort" :dataNav="dataNav" page="compute"></CloudMinerList>
    <Pager :len="len"></Pager>
    <SideBar></SideBar>
  </section>
</template>

<script>
  // import util from '@/util'
  // import api from '@/util/function'
  import { mapState } from 'vuex'
  import CloudMinerList from '@/components/common/CloudMinerList'
  import ProductNav from '@/components/common/ProductNav'
  import Pager from '@/components/common/Pager'
  import SideBar from '@/components/home/SideBar'
  export default {
    components: {
      CloudMinerList, ProductNav, Pager, SideBar
    },
    data () {
      return {
        computeDate: [],
        sort: [{title: '价格', option: ['transfer_price-asc', 'transfer_price-desc'], value: 0}, {title: '数量', option: ['transfer_amount-asc', 'transfer_amount-desc'], value: 0}, {title: '期限', option: ['transfer_time-asc', 'transfer_time-desc'], value: 0}, {title: '已使用时长', option: ['birth_time-asc', 'birth_time-desc'], value: 0}],
        dataNav: {'transfer_price': {title: '转让每T算力价格', unit: '元'}, 'transfer_amount': {title: '转让数量', unit: 'T'}, 'transfer_time': {title: '转让时长', unit: '天'}, 'original_price': {title: '原始算力价格', unit: '元'}, 'birth_time': {title: '已使用时长', unit: '天'}},
        len: 0,
        now: 1,
        show: false
      }
    },
    methods: {
      fetchData () {
        // var self = this
        this.show = true
        // var obj = {}
        // if (this.$route.params.sort === 'all') {
        //   obj = {token: this.token, product_hash_type: this.$route.params.type, page: this.now}
        // } else {
        //   obj = {token: this.token, product_hash_type: this.$route.params.type, order_type: this.$route.params.sort, page: this.now}
        // }
        // util.post('getHashrates', {sign: api.serialize(obj)}).then(function (res) {
        //   api.checkAjax(self, res, () => {
        //     self.computeDate = res.list
        //     self.show = !res.list.length
        //     if (self.now > 1) return false
        //     self.len = res.total_page
        //   })
        // })
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
  .transfer_list{
    .bg_box{
      @include bg(1920,420px,#1863f0)
      z-index: -1;
      .bg{
        background:url(../../assets/images/minerShop.jpg) no-repeat;
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
      @include mobile_hide
    }
    .sort{
      border:0;
      border-bottom: 1px solid #e8e8e8;
    }
  }
</style>
