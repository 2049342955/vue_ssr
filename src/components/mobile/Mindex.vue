<template>
  <article class="m_home">
    <Swiper :pagination-visible="true" :loop="true" :autoPlay="5000" :data="data"></Swiper>
    <div class="nav_box">
      <router-link class="item" :to="n.url" v-for="n,k in nav" :key="k">
        <div class="item_img">
          <img :src="require('@/assets/images/nav'+(k+1)+'.png')" alt="">
        </div>
        <div class="item_text">
          <h3>{{n.title}}</h3>
          <p>{{n.desc}}</p>
        </div>
      </router-link>
    </div>
    <MyData></MyData>
  </article>
</template>

<script>
  import Swiper from '@/components/common/Swipe'
  import MyData from '@/components/home/DataList'
  export default {
    components: {
      Swiper, MyData
    },
    data () {
      return {
        nav: [{title: '算力托管', desc: '优质合规', url: '/bdc'}, {title: '算力商城', desc: '优质合规', url: '/cloudCompute/list/1/all'}, {title: '算力转让', desc: '优质合规', url: '/computeTransfer/list/1/all'}, {title: '算力资讯', desc: '优质合规', url: '/mobile/information'}],
        data: [1, 1, 1]
      }
    }
  }
</script>

<style type="text/css" lang="scss">
  @import '../../assets/css/style.scss';
  .m_home{
    min-height:100vh;
    padding-bottom:15px;
    background: #f4f4f4;
    .swiper{
      .swiper_wrap{
        .swiper_one{
          height:48vw;
          & > a > img{
            width:100vw
          }
        }
      }
    }
    .nav_box{
      padding:15px;
      @include row(2,5%)
      .item{
        background: #fbfbfb;
        padding:10px;
        &:nth-child(1),&:nth-child(2){
          margin-bottom:5%;
        }
        @include flex
        .item_img{
          width:60px;
        }
        .item_text{
          margin-left:10px;
          h3{
            font-weight: bold;
          }
          p{
            color:$light_black
          }
        }
      }
    }
  }
</style>
