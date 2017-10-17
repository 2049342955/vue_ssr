<template>
  <article class="user">
    <div class="info">
      <div class="box">
        <div class="welcome">
          <h2>早上好，{{mobile|format}}</h2>
          <div class="line"></div>
          <div class="icons">
            <span class="iconfont"></span>
            <span class="iconfont"></span>
            <span class="iconfont"></span>
            <span>上次登录时间：2017-09-26 09:19:24</span>
          </div>
        </div>
        <router-link class="message" to="/user/message" v-if="message_len">
          <span class="iconfont"></span>
          <span>未读信息：{{message_len}}</span>
        </router-link>
      </div>
    </div>
    <section class="main">
      <div class="box">
        <aside class="con">
          <router-link :class="['item', {active:$route.path.includes(n.name)}]" :to="n.path" v-for="n,k in nav" :key="k">{{n.title}}</router-link>
        </aside>
        <router-view class="content"></router-view>
      </div>
    </section>
  </article>
</template>

<script>
  import { mapState } from 'vuex'
  import api from '../util/function'
  export default {
    data () {
      return {
        titleBg: require('@/assets/images/user_bg1.jpg'),
        nav: [{name: 'computeProperty', title: '算力资产', path: '/user/computeProperty'}, {name: 'account', title: '账户管理', path: '/user/account'}, {name: 'password', title: '密码管理', path: '/user/password'}, {name: 'order', title: '订单管理', path: '/user/order/0/1'}, {name: 'virtualCurrencyFlow', title: '币流水', path: '/user/virtualCurrencyFlow'}, {name: 'moneyFlow', title: '资金流水', path: '/user/moneyFlow'}, {name: 'lp', title: 'LP中心', path: '/user/lpCenter'}, {name: 'message', title: '消息中心', path: '/user/message'}]
      }
    },
    computed: {
      ...mapState({
        mobile: state => state.info.mobile,
        message_len: state => state.info.message_len
      })
    },
    filters: {
      format: api.telReadable
    }
  }
</script>

<style type="text/css" lang="scss">
  @import '../assets/css/style.scss';
  @import '../assets/fonts/iconfont.css';
  .user{
    overflow:hidden;
    .info{
      width: 100%;
      height: 140px;
      background: #1d2433 url('../assets/images/user_bg1.jpg') repeat-x 50%;
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
            height: 1px;
            background: linear-gradient(to right, #5c6474 40%, transparent 80%);
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
              color: #aaaaaa;
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
        @include flex(flex-start,stretch)
        @include main
        .con{
          width:210px;
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
            &:hover,&.router-link-active,&.active{
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
          width:leave(235);
          min-height: 600px;
          border-radius:5px;
          h2{
            line-height: 52px;
            padding:0 28px;
            border-bottom: 1px solid $border;
          }
          h3{
            background: #f7f8fa;
            padding: 12px 15px;
            &:before{
              content:'|';
              padding-right:10px;
              color:#000;
              font-weight: bold;
            }
          }
        }
      }
    }
    h2{
      font-size: 18px
    }
  }
</style>
