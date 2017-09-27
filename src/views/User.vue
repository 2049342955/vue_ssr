<template>
  <article class="user">
    <div class="info">
      <div class="box">
        <div class="welcome">
          <h2>早上好，188****9654</h2>
          <div class="line"></div>
          <div class="icons">
            <span class="iconfont"></span>
            <span class="iconfont"></span>
            <span class="iconfont"></span>
            <span>上次登录时间：2017-09-26 09:19:24</span>
          </div>
        </div>
        <div class="message">
          <span class="iconfont"></span>
          <span>未读信息：12</span>
        </div>
      </div>
    </div>
    <section class="main">
      <div class="box">
        <aside>
          <router-link class="item" :to="n" v-for="n,k in nav" :key="k">{{k}}</router-link>
        </aside>
        <router-view class="content"></router-view>
      </div>
    </section>
  </article>
</template>

<script>
export default {
  data () {
    return {
      titleBg: require('@/assets/images/user_bg1.jpg'),
      nav: {'个人中心': '/user/index', '账户管理': '/user/account', '订单管理': '/user/order', 'LP中心': '/user/lpCenter'}
    }
  }
}
</script>

<style type="text/css" lang="scss">
  @import '../assets/css/style.scss';
  @import '../assets/fonts/iconfont.css';
  .user{
    overflow:hidden;
    .info{
      width:100%;
      height:140px;
      background: url('../assets/images/user_bg1.jpg');
      .box{
        @include main
        @include flex(space-between)
        height:100%;
        .welcome{
          flex:1;
          h2{
            color:$white
          }
          .line{
            border-bottom:1px solid #5c6474;
            margin:15px 0
          }
          .icons{
            .iconfont{
              text-align: center;
              @include block(22,5px)
              & + .iconfont{
                margin-left:10px
              }
              &:before{
                color:$white;
              }
              &:first-child{
                background: #4d83dd;
                &:before{
                  content:'\e675'
                }
              }
              &:nth-child(2){
                background: #ffbc38;
                &:before{
                  content:'\e601'
                }
              }
              &:nth-child(3){
                background: #93cd38;
                &:before{
                  content:'\e699'
                }
              }
            }
            span:last-child{
              padding-left:25px;
              color: $light_text;
            }
          }
        }
        .message{
          width:155px;
          background: #efe9cf;
          border-radius:8px;
          padding:5px 15px;
          margin-left:10px;
          color:#74620e;
          .iconfont{
            font-size: 24px;
            color: #cec6a6;
            vertical-align: sub;
            padding-right: 5px;
            &:before{
              content:'\e699'
            }
          }
        }
      }
    }
    .main{
      background: #f7f8fa;
      padding:35px 0;
      .box{
        @include flex(flex-start,flex-start)
        @include main
        aside{
          width:210px;
          height: 500px;
          background: $white;
          margin-right:25px;
          border-radius:5px;
          overflow: hidden;
          a{
            display: block;
            line-height: 48px;
            text-align: center;
            border-top:1px solid #eaf1f5;
            border-left:2px solid transparent;
            border-radius:5px;
            &:hover,&.router-link-active{
              position: relative;
              background: #f5f8ff;
              border-left-color:$blue;
              color: $blue;
              &:after{
                content:'';
                @include position(20,auto,auto,35)
                @include triangle(right,$blue)
              }
            }
          }
        }
        .content{
          background: $white;
          flex:1;
          height: 500px;
          border-radius:5px;
        }
      }
    }
    h2{
      font-size: 18px;
    }
  }
</style>
