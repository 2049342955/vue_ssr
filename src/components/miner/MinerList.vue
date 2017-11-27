<template>
  <section class="miner_shop">
    <div class="bg_box">
      <div class="bg"></div>
    </div>
    <div class="miner_pics">
      <div class="miner_pic pic1">
        <img :src="require('@/assets/images/miner_shop/bdc.jpg')" alt="">
        <div class="btn">
          <router-link to="/bdc">前往申请</router-link>
          <router-link to="/minerShop/mining">了解挖矿</router-link>
        </div>
      </div>
      <div class="miner_pic pic2">
        <img :src="require('@/assets/images/miner_shop/miner_top1.jpg')" alt="">
        <router-link to="/minerShop/activity" class="btn">立即抢购</router-link>
      </div>
      <div class="miner_pic pic3">
        <img :src="require('@/assets/images/miner_shop/miner.jpg')" alt="">
        <div class="text">
          <span>矿机</span>
          <span>品牌矿机，质量保证</span>
        </div>
        <router-link to="/minerShop/miner/1/all" class="btn">即刻前往>></router-link>
      </div>
      <div class="miner_pic pic4">
        <img :src="require('@/assets/images/miner_shop/cloud_miner.jpg')" alt="">
        <div class="text">
          <span>云矿机</span>
          <span>专人维护，无忧挖矿</span>
        </div>
        <router-link to="/minerShop/miner/2/all" class="btn">即刻前往>></router-link>
      </div>
    </div>
    <MyCloud :items="items">
      <h2>
        <div>
          <span>矿机推荐</span>
          <span>保全网提供全流程区块链存证、保全服务</span>
        </div>
        <router-link to="/minerShop/miner/1/all">更多矿机 ></router-link>
      </h2>
    </MyCloud>
    <MyData :dataNav="dataNav" page="minerShop">
      <h2>
        <div>
          <span>云矿机推荐</span>
          <span>国家电网 算力保证 无忧挖矿</span>
        </div>
        <router-link to="/minerShop/miner/2/all">更多云矿机 ></router-link>
      </h2>
    </MyData>
    <SideBar></SideBar>
  </section>
</template>

<script>
  import util from '@/util'
  import api from '@/util/function'
  import { mapState } from 'vuex'
  import MyData from '@/components/common/ProductList'
  import MyCloud from '@/components/miner/CloudMiner'
  import SideBar from '@/components/home/SideBar'
  export default {
    components: {
      MyData, SideBar, MyCloud
    },
    data () {
      return {
        computeDate: [],
        dataNav: {'one_amount_value': {title: '每台服务器价格', unit: '元'}, 'hash': {title: '每台服务器算力', unit: 'T'}, 'buyed_amount': {title: '出售服务器总数', unit: '台'}, 'leftNum': {title: '剩余可售服务器', unit: '台'}},
        itemDetail: [],
        items: {'one_amount_value': {title: '服务器单价', unit: '元'}, 'hash': {title: '算力', unit: 'T'}, 'buyed_amount': {title: '出售总数', unit: '台'}},
        nav: ['矿机超市', '云矿机商城']
      }
    },
    methods: {
      fetchData () {
        var self = this
        var obj = {token: this.token}
        var url = 'showMinerList'
        var url2 = 'showproductList'
        util.post(url2, {sign: api.serialize(obj)}).then(function (res) {
          api.checkAjax(self, res, () => {
            self.computeDate = res.data
          })
        })
        util.post(url, {sign: api.serialize(obj)}).then(function (res) {
          api.checkAjax(self, res, () => {
            self.itemDetail = res.data
          })
        })
      }
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
  .miner_shop{
    .bg_box{
      @include bg(1920,650px,#1863f0)
      .bg{
        background:url(../../assets/images/miner_shop/miner_list.jpg) no-repeat;
      }
      @include mobile_hide
    }
    .miner_pics{
      @include position(130)
      left: calc(50% - 590px);
      right: calc(50% - 590px);
      bottom:auto;
      .miner_pic{
        position: relative;
        float:left;
        img{
          position: relative;
          left:auto;
          width:auto;
          height:auto
        }
        .btn,.text{
          @include position
          top:auto;
          left:80px;
          bottom:60px;
          width:290px;
          line-height: 2;
          text-align: center;
          color:#eee;
        }
        .btn{
          display: block;
          cursor: pointer;
        }
        &.pic1{
          .btn{
            text-align: center;
            a{
              padding:0 20px;
              color:#eee;
              &:first-child{
                padding-right:0;
                &:after{
                  color:#999;
                  margin-left:30px;
                  content:'/'
                }
              }
            }
          }
        }
        &.pic2{
          .btn{
            left:120px;
            width:200px;
            font-size: 18px;
            font-weight: bold;
            @include button(#FE5038)
            border-radius:20px;
          }
        }
        &.pic2,&.pic3,&.pic4{
          margin-left:20px;
        }
        &.pic3,&.pic4{
          margin-top:20px;
          .btn{
            left:75px;
            width:200px;
          }
          .text{
            bottom:100px;
            left:0;
            width:100%;
            font-size: 16px;
            span:first-child{
              color:#B2884E;
              &:before,&:after{
                color:#eee;
              }
              &:before{
                content:'[';
                padding-right:3px
              }
              &:after{
                content:']';
                padding-left:3px
              }
            }
          }
        }
        @include mobile_hide
      }
    }
    .millsList{
      padding-top: 120px;
    }
  }
</style>
