<template>
  <section class="miner_module">
    <Sort :sortNav="sortNav" :status="status" @setStatus="setStatus" @fetchData="fetchData"></Sort>
    <div class="miner_list">
      <div class="miner_list_box">
        <div :class="['box', {mobile_list_box: isMobile}]">
          <template v-if="isMobile===0">
            <MinerItem v-for="n,k in minerData" :n="n" :key="k"></MinerItem>
          </template>
          <ScrollList v-if="isMobile===1" :data="minerData" :len="len" :now="now" @getMobileData="getMobileData"></ScrollList>
          <div class="nodata" v-if="!minerData.length">
            <div class="nodata_img"></div>
            <p>即将上线，敬请期待</p>
          </div>
        </div>
      </div>
    </div>
    <Pager :len="len" v-if="!isMobile" :now="now" @setPage="setPage"></Pager>
  </section>
</template>

<script>
  import { fetchApiData } from '@/util'
  import { mapState } from 'vuex'
  import MinerItem from '@/components/miner/MinerItem'
  import ScrollList from '@/components/product/ScrollList'
  import Pager from '@/components/common/Pager'
  import Sort from '@/components/common/Sort'
  export default {
    components: {
      Pager, Sort, MinerItem, ScrollList
    },
    data () {
      return {
        sortNav: [
          {
            name: 'status',
            title: '商品状态',
            options: [
              {code: 0, title: '综合推荐'},
              {code: 1, title: '热销'},
              {code: 4, title: '预热'},
              {code: 2, title: '已售罄'}
            ]
          }
        ],
        minerData: [],
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
        fetchApiData(this, 'showList', obj, (res) => {
          this.setData(more, res.data, 'minerData')
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
      '$route': 'fetchData'
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
  .miner_module {
    background: #f7f8fa;
    .miner_list{
      background: #f6f7f9;
      padding-top: 50px;
      .miner_list_box{
        @include main
        .loadmore{
          width: 100%;
          height: 0.89rem;
          line-height: 0.89rem;
          text-align: center;
        }
        .box:not(.mobile_list_box){
          @include row(4, 1%)
        }
        .box.mobile_list_box{
          padding: 0 0.3rem;
        }
        .box.mobile_list_box .item_box{
          @include row(2)
        }
        .nodata{
          width:100%;
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
      }
      @media  screen and (max-width: 600px) {
        padding-top:0;
        .miner_list_box .box{
          padding:.5rem .5rem 0 .5rem;
          background: #fff;
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
