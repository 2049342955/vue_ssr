<template>
  <section class="cloud_compute_module">
    <Sort :sortNav="sortNav2" :status="status" @setStatus="setStatus" @fetchData="fetchData"></Sort>
    <section class="product_list">
      <div class="box">
        <div class="data">
          <template v-if="isMobile===0">
            <CloudMinerItem v-for="d,k in cloudMinerData" :d="d" :key="k"></CloudMinerItem>
          </template>
          <ScrollList v-if="isMobile===1" :data="cloudMinerData" :len="len" :now="now" @getMobileData="getMobileData"></ScrollList>
          <div class="nodata" v-if="$parent.show">
            <div class="nodata_img"></div>
            <p>即将上线，敬请期待</p>
          </div>
        </div>
      </div>
    </section>
    <Pager :len="len" v-if="!isMobile" :now="now" @setPage="setPage"></Pager>
  </section>
</template>

<script>
  import { fetchApiData } from '@/util'
  import { mapState } from 'vuex'
  import CloudMinerItem from '@/components/cloudCompute/CloudMinerItem'
  import ScrollList from '@/components/product/ScrollList'
  import Pager from '@/components/common/Pager'
  import Sort from '@/components/common/Sort'
  export default {
    components: {
      CloudMinerItem, ScrollList, Pager, Sort
    },
    data () {
      return {
        sortNav2: [
          {
            name: 'status',
            title: '商品状态',
            options: [
              {code: 0, title: '综合推荐'},
              {code: 5, title: '热销'},
              {code: 4, title: '预热'},
              {code: 10, title: '活动'},
              {code: 1000, title: '转售'},
              {code: 7, title: '已售罄'}
            ]
          }
        ],
        cloudMinerData: [],
        len: 0,
        now: 1,
        show: false,
        status: 0
      }
    },
    methods: {
      fetchData (sort, more) {
        var obj = {token: this.token, page: this.now, product_type: '1'}
        if (sort) {
          obj = Object.assign({sort}, obj)
        }
        if (this.status) {
          obj = Object.assign({status: this.status}, obj)
        }
        fetchApiData(this, 'productList', obj, (res) => {
          this.setData(more, res.data, 'cloudMinerData')
          this.show = !res.data.length
          if (this.now > 1) return false
          this.len = res.page.total_page
        })
      },
      setStatus (n) {
        this.now = 1
        this.status = n
        this.fetchData()
      },
      getMobileData (isMore) {
        if (isMore) {
          this.now++
          this.fetchData('', 1)
        }
      },
      setPage (n) {
        this.now = n
        if (!this.isMobile) {
          this.fetchData()
        }
      },
      setData (more, data, dataText) {
        if (more) {
          for (let i = 0, len = data.length; i < len; i++) {
            this[dataText].push(data[i])
          }
        } else {
          this[dataText] = data
        }
      }
    },
    watch: {
      '$route': 'fetchData',
      'status': function () {
        this.getMobileData()
      }
    },
    mounted () {
      if (!this.isMobile) {
        this.fetchData('')
      } else {
        this.fetchData('', 1)
      }
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
  .cloud_compute_module {
    background: #f7f8fa;
    .product_list{
      padding-top:20px;
      padding-bottom:30px;
      background: #f6f7f9;
      .box{
        @include main
        .data{
          .item.MobileCloudMinerItem{
            @include cloud_miner_box
          }
        }
      }
      .loadmore{
        text-align: center;
      }
      .nodata{
        background: #fff;
        min-height:500px;
        padding-top:100px;
        text-align: center;
        .nodata_img{
          display: inline-block;
          width: 305px;
          height: 234px;
          background: url('~@/assets/images/css_sprites.png') -10px -10px;
        }
        p{
          color:$light_black;
          margin-top:15px
        }
      }
      @media screen and (max-width: $mobile) {
        padding-top:0;
        padding-bottom: 0.2rem;
        .box .data .item{
          h3{
            margin-bottom:0;
          }
        }
      }
    }
    .pager {
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
  }
</style>
