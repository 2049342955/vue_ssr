<template>
  <article class="home">
    <Swiper :pagination-visible="true" :loop="true" :paginationClickable="true"></Swiper>
    <Chart></Chart>
    <div class="ad">
      <div class="main">
        <h1>{{ad.title}}</h1>
        <p>{{ad.desc}}</p>
        <div class="list">
          <div class="item" v-for="a,k in ad.items">
            <span :class="['iconfont', 'icon'+k]"></span>
            <h3>{{a.title}}</h3>
            <div class="line"></div>
            <p v-html="a.desc"></p>
          </div>
        </div>
      </div>
    </div>
    <MyData></MyData>
    <div class="ad_img">
      <img :src="adImg" alt="">
      <div class="text">
        <h2>算力服务器一站式服务平台</h2>
        <p>通过设备集群式部署，为用户提供一站式算力服务器挖矿服务<br>包括矿场投资，算力服务器托管，算力服务器采购、算力租赁等，让用户轻松体验挖矿乐趣</p>
      </div>
    </div>
    <WebInfo></WebInfo>
    <div class="partner">
      <div class="box">
        <h3>战略合作伙伴</h3>
        <div class="list">
          <div class="item" v-for="i in 12">
            <div class="img"></div>
            <div class="img_hover"></div>
          </div>
        </div>
      </div>
    </div>
  </article>
</template>

<script>
  import api from '../util'
  import Swiper from '../components/common/Swipe'
  import Chart from '../components/home/Chart'
  import MyData from '../components/home/DataList'
  import WebInfo from '../components/home/WebInfo'
  export default {
    components: {
      Swiper, Chart, MyData, WebInfo
    },
    data () {
      return {
        ad: {title: '全国首家算力产业链综合服务平台', desc: '算力网是中国信息化推进联盟区块链实验室的推进项目，为区块链算力产业链提供全系列服务', items: [{title: '项目合规', desc: '所有项目出具法律意见书<br>并公开法律意见书'}, {title: '用电合规', desc: '项目为政府招商引资项目<br>全部国网供电，电力稳定持久'}, {title: '透明收益', desc: '全流程产业链对接，信息透明<br>避免踩坑'}, {title: '全程存证', desc: '对接保全网区块链电子凭证技术<br>实现全部在线协议的合规有效'}, {title: '算力管家', desc: '为用户投资的每一份算力<br>提供贴心的远程管家服务'}]},
        adImg: require('@/assets/images/ad.jpg')
      }
    },
    mounted () {
      // var self = this
      api.post('/partner', {sign: 'token=0'}).then(function (data) {
        console.log(data)
        // self.activity = data
      })
    }
  }
</script>

<style type="text/css" lang="scss">
  @import '../assets/css/style.scss';
  @import '../assets/fonts/iconfont.css';
  .ad{
    background:#f7f8fa;
    border-bottom:1px solid $border;
    margin-bottom:65px;
    .main{
      @include gap(20,v)
      @include main
      height:293px;
      line-height: 2;
      h1,p{
        text-align: center
      }
      h1{
        font-size: 30px
      }
      p{
        font-size: 16px
      }
      .list{
        @include flex
        border:1px solid $border;
        border-bottom:0;
        margin-top:30px;
        .item{
          position: relative;
          height: 150px;
          flex:1;
          padding:20px;
          padding-right:18px;
          &:not(:last-child){
            border-right:1px solid $border;
          }
          h3{
            font-size: 20px;
          }
          .line{
            width:45px;
            border-bottom:2px solid $blue;
            margin-top:5px;
            margin-bottom:7px;
          }
          p{
            position: relative;
            text-align: left;
            line-height: 1.5;
            font-size: 14px;
            color:$light_text;
            z-index: 2;
          }
          span{
            position: absolute;
            top:calc(50% - 35px);
            right:20px;
            @include block(70)
            &:before{
              font-size: 70px;
              color:#e6e6e6
            }
          }
          .icon0:before{
            content: "\e60a"
          }
          .icon1:before{
            content: "\e60b"
          }
          .icon2:before{
            content: "\e606"
          }
          .icon3:before{
            content: "\e604"
          }
          .icon4:before{
            content: "\e608"
          }
          &:hover{
            background: $white;
            h3{
              color:$blue
            }
          }
        }
      }
    }
  }
  .ad_img{
    position: relative;
    height:315px;
    margin-bottom:60px;
    @include flex(flex-start,center)
    img{
      @include position
      height:100%;
      object-fit:cover;
      z-index: -1;
    }
    .text{
      @include main
      h2{
        font-size: 30px;
        font-weight: bold;
        margin-bottom:20px;
        color:$white
      }
      p{
        font-size: 16px;
        color:#d7d8d9
      }
    }
  }
  .partner{
    .box{
      @include main
      text-align: center;
      margin-bottom:60px;
      h3{
        font-size: 24px;
        margin-bottom:30px
      }
      .list{
        @include row(6,0)
        border-left:1px solid $border;
        border-top:1px solid $border;
        .item{
          height:70px;
          border-right:1px solid $border;
          border-bottom:1px solid $border;
          @include flex(center)
          img{
            width:81px;
            height:32px
          }
          .img,.img_hover{
            width: 81px; height: 32px;
          }
          .img{
            background: url('../assets/images/partner.png') -111px -10px;
          }
          .img_hover{
            background: url('../assets/images/partner.png') -10px -10px;
          }
          .img,&:hover .img_hover{
            display: block;
          }
          .img_hover,&:hover .img{
            display: none;
          }
        }
      }
    }
  }
</style>
