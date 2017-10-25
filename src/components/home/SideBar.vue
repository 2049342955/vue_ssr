<template>
  <div ref="bar" class="side_bar">
    <div class="item" v-for="n,k in nav">
      <div :class="'iconfont icon_'+k" @click="openPopup(n)"></div>
      <div class="popup qq" v-if="n==='qq'">
        <span>QQ群</span>
        <span>3567894561</span>
      </div>
      <div class="popup tel" v-if="n==='tel'">
        <span>0571-</span>
        <span>28221076</span>
      </div>
      <div class="popup" v-if="n==='wechat'">
        <div class="wechat"></div>
      </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    name: 'chart',
    data () {
      return {
        nav: ['qq', 'tel', 'wechat', 'gotop'],
        show: ''
      }
    },
    created () {
      window.addEventListener('scroll', this.test, false)
    },
    methods: {
      openPopup (n) {
        if (n !== 'gotop') {
          this.show = n
        } else {
          window.scrollTo(0, 0)
        }
      },
      test (e) {
        var ele = document.querySelector('.frame_header')
        if (!ele || !this.$refs.bar) return false
        if (e.target.scrollingElement.scrollTop > 0) {
          this.$refs.bar.style.display = 'block'
        } else {
          this.$refs.bar.style.display = 'none'
        }
      }
    }
  }
</script>

<style type="text/css" lang="scss">
  @import '../../assets/css/style.scss';
  @import '../../assets/fonts/iconfont.css';
  .side_bar{
    position: fixed;
    top:calc(50vh - 120px);
    right:20px;
    width:60px;
    height:240px;
    border:1px solid $border;
    border-radius:5px;
    z-index: 3;
    background: #fff;
    box-shadow:0px 0px 6px 0px #bbb;
    display: none;
    .item{
      position: relative;
      cursor: pointer;
      &:not(:last-child){
        border-bottom:1px solid #e5e5e5
      }
      .iconfont{
        height:60px;
        line-height: 60px;
        text-align: center;
        font-size: 30px;
        &:not(:last-child):before{
          color:#bdbdbd
        }
        &:last-child:before{
          color:#999
        }
        &.icon_0:before{
          content:'\e68e'
        }
        &.icon_1:before{
          content:'\e697'
        }
        &.icon_2:before{
          content:'\e61d'
        }
        &.icon_3:before{
          content:'\e60c'
        }
      }
      .popup{
        position: absolute;
        top:3px;
        right:100%;
        background: #fff;
        padding:5px;
        box-shadow:0px 0px 4px 0px #bbb;
        border-radius:3px;
        display: none;
        span{
          color:$blue;
          &:last-child{
            font-weight: bold;
          }
        }
        .wechat{
          width: 80px;
          height: 80px;
          background: url('../../assets/images/css_sprites.png') -175px -10px;
        }
      }
      &:hover .popup{
        display: block;
      }
    }
  }
</style>