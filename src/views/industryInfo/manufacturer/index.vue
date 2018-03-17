<template>
  <pageFrame>
    <div class="right_content manufacture_right" v-if="isMobile === 0">
      <h1>算力服务器制造商<span class="icon iconfont icon-jiantou"></span></h1>
      <div class="manufacture_item" v-for="n, k in list" :key="k">
        <div class="manufacture_img"><img :src="n.image"/></div>
        <div class="manufacture_content">
          <h6>{{n.title}}</h6>
          <p>{{n.resume}}</p>
          <router-link class="go_detail" :to="'manufacturer/detail/' + n.id">查看详情</router-link>
        </div>
      </div>
      <Pager :len="len" :now="now" @setPage="setPage"></Pager>
    </div>
    <scroll-list class="mobile_manufacture" :noData="noData" :loading="loading" @loadMore="loadMore" v-else-if="isMobile === 1">
      <h1 slot="title">主流算力服务器制造商</h1>
      <div class="item" v-for="item, k in list" :key="k" @click="$router.push({path: 'manufacturer/detail/' + item.id})">
        <img :src="item.image"/>
        <p>{{ item.title}}</p>
      </div>
    </scroll-list>
  </pageFrame>
</template>

<script>
  import { mapState } from 'vuex'
  import { getList, setPage, loadMore } from '@/service/article'
  import Pager from '@/components/common/Pager'
  import pageFrame from '@/components/common/PageFrame'
  import ScrollList from '@/components/common/ScrollList'
  export default {
    components: {
      Pager, pageFrame, ScrollList
    },
    data () {
      return {
        dataUrl: 'NewsManfacturerList',
        loading: false,
        perNum: 6,
        len: 0,
        now: 1,
        list: [],
        noData: false
      }
    },
    methods: {
      getList,
      setPage,
      loadMore
    },
    mounted () {
      this.getList()
    },
    computed: {
      ...mapState({
        token: state => state.info.token,
        isMobile: state => state.isMobile
      })
    }
  }
</script>

<style lang="scss">
  .manufacture_right{
    .manufacture_item{
      height: 232px;
      box-shadow: 0 0 10px #c2c2c2;
      margin-top: 20px;
      border-radius: 8px;
      display: flex;
      align-items: center;
      .manufacture_img{
        width: 30%;
        height: 170px;
        border-right: 1px solid #999999;
        text-align: center;
        float: left;
        img{
          width: 191px;
          margin-top: 8%;
          height: 80%;
          object-fit: contain;
        }
      }
      .manufacture_content{
        width: 70%;
        float: left;
        padding-left: 58px;
        h6{
          color: #333333;
          font-size: 22px;
          margin-bottom: 12px;
        }
        p{
          line-height: 22px;
          color: #666666;
          height: 42px;
          padding-right: 45px;
          @include ellipsis(2)
        }
        .go_detail{
          width: 172px;
          height: 38px;
          border:1px solid #bfbfbf;
          background:#fff;
          color: #a9a9a9;
          margin-top: 27px;
          float: right;
          margin-right: 37px;
          text-align: center;
          line-height: 38px;
          border-radius: 5px;
          cursor: pointer;
          &:hover{
            background:#fe5039;
            color: #fff;
            border:0;
          }
        }
      }
    }
  }
  .scroll_list.mobile_manufacture .list_box{
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    padding: 0;
    .item{
      display: block;
      width: 50%;
      border-bottom: 1px solid #dcdcdc;
      border-right: 1px solid #dcdcdc;
      box-sizing: border-box;
      height: 2.36rem;
      text-align: center;
      padding: 0 0.5rem;
      img{
        width: 1.78rem;
        height: 0.48rem;
        object-fit: contain;
        margin-top: 0.56rem;
      }
      p{
        color:#666666;
        font-weight: 800;
        widows: 100%;
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
        margin-top: 0.42rem;
        font-size: 0.3rem;
      }
    }
    :nth-of-type(even){
      border-right: 0;
    }
  }
</style>
