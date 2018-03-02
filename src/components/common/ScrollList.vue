<template>
  <div class="scroll_list">
    <slot name="title"></slot>
    <div class="list_box" v-infinite-scroll="loadMore" infinite-scroll-disabled="loading" infinite-scroll-distance="10" v-if="!showContent">
      <slot></slot>
    </div>
    <p v-if="loading&&!showContent"  class="loading">加载中······</p>
    <p v-if="noData" class="no_data">暂无数据······</p>
    <div class="show_content"  v-if="showContent">
      <div class="content_title">
        <span class="title">{{content.title}}</span>
        <span class="back" @click="back">< 返回列表</span>
      </div>
      <div class="content_html" v-html="content.content"></div>
    </div>
  </div>
</template>

<script>
  import Vue from 'vue'
  import { InfiniteScroll } from 'mint-ui'
  Vue.use(InfiniteScroll)
  export default {
    props: {
      showContent: {
        type: Boolean
      },
      noData: {
        type: Boolean
      },
      loading: {
        type: Boolean
      },
      content: {
        type: Object
      },
      type: {
        type: Object,
        default: 'down'
      }
    },
    data () {
      return {
        touchYDelta: '',
        translateVal,
        firstTouchY: 0,
        initialScroll: 0,
        isLoading: false,
        isMoved: false
      }
    }
    methods: {
      loadMore () {
        this.$emit('loadMore')
      },
      back () {
        this.$emit('back')
      },
      touchStart (ev) {
        if (this.isLoading) return;
        this.isMoved = false
        this.touchYDelta = ''
        this.firstTouchY = parseInt(ev.changedTouches[0].clientY)
        this.initialScroll = this.scrollY()
      },
      touchMove (ev) {
        if (this.isLoading) {
          ev.preventDefault()
          return
        }
        let ele = document.querySelector('scroll_list')
        let moving = function() {
          let touchY = parseInt(ev.changedTouches[0].clientY);
          this.touchYDelta = touchY - firstTouchY;
          if ( this.scrollY() === 0 && this.touchYDelta > 0  ) {
            ev.preventDefault();
          }
          if(this.type =="up") {
            if ( initialScroll < 0 || self.scrollY() >= 0 && touchYDelta > 0) {
              firstTouchY = touchY;
              return;
            }
            $(".refresh_load").show()
            translateVal = Math.pow(-touchYDelta, 0.85);
            $(ele).css({"transform":'translate3d(0, -' + translateVal + 'px, 0)',"transition-duration":"0ms"})
            isMoved = true;
            if(touchYDelta < this.triggerDistance){
              $(ele).addClass("refresh_pull_up").removeClass("refresh_pull_down");
            }else{
              $(ele).addClass("refresh_pull_down").removeClass("refresh_pull_up");
            }
          }
          if(this.type =="down"){console.log(touchYDelta < 0)
            if ( initialScroll > 0 || self.scrollY() >= 0 && touchYDelta < 0) {
              firstTouchY = touchY;
              return;
            }
            translateVal = Math.pow(touchYDelta, 0.85);
            $(ele).css({"transform":'translate3d(0, ' + translateVal + 'px, 0)',"transition-duration":"0ms"})
            isMoved = true;
            if(touchYDelta > this.triggerDistance){
              $(ele).addClass("refresh_pull_up").removeClass("refresh_pull_down");
            }else{
              $(ele).addClass("refresh_pull_down").removeClass("refresh_pull_up");
            }
          }
        }
        this.throttle(moving(), 20);
      },
      touchEnd (ev,callback) {
        var ele = this.params.container;
        if (isLoading|| !isMoved) {
          isMoved = false;
          return;
        }
        if( touchYDelta <= this.params.triggerDistance && this.params.type =="up") {
          isLoading = true;
          ev.preventDefault();
          $(ele).css({"transform":'translate3d(0,-60px,0)',"transition-duration":"300ms"}).addClass("refreshing");
          $(".refresh_load").fadeOut(2000)
          callback();
        }
        if( touchYDelta >= this.params.triggerDistance && this.params.type =="down") {
          isLoading = true;
          ev.preventDefault();
          $(ele).css({"transform":'translate3d(0,60px,0)',"transition-duration":"300ms"}).addClass("refreshing");
          callback();
        }
        isMoved = false;
      },
      cancelLoading () {
        var ele = this.params.container;
        isLoading = false;
        $(ele).css("transform",'translate3d(0,0,0)').removeClass("refreshing refresh_pull_up");
      },
      scrollY () {
        return window.pageYOffset || window.document.documentElement.scrollTop;
      },
      throttle (fn, delay) {
        var allowSample = true;
        return function(e) {
          if (allowSample) {
            allowSample = false;
            setTimeout(function() { allowSample = true; }, delay);
            fn(e);
          }
        };
      }
    },
    mounted () {
      // let ele = document.querySelector('scroll_list')
      // ele.addEventListener('touchstart', function(ev){
      //   this.touchStart(ev)
      // });
      // ele.addEventListener('touchmove', function(ev){
      //   this.touchMove(ev)
      // });
      // ele.addEventListener('touchend', function(ev){
      //   this.touchEnd(ev,callback);
      // });
    }
  }
</script>

<style type="text/css" lang="scss">
  .scroll_list{
    width: 100%;
    overflow: hidden;
    background: white;
    h1{
      width: 100%;
      font-size: 0.3rem;
      color:#333333;
      padding: 0.3rem;
    }
    .list_box{
      width: 100%;
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
      padding:0 0.3rem 0.5rem;
    }
    .loading{
      width: 100%;
      height: 1.08rem;
      text-align: center;
      line-height: 1.08rem;
    }
    .show_content{
      width: 100%;
      padding-bottom: 20px;
      background: white;
      .content_title{
        padding: 0.3rem;
        padding-bottom: 0;
        .title{
          font-weight: 800;
          font-size: 0.3rem;
        }
        .back{
          float: right;
          color:#327fff;
          font-size: 0.3rem;
        }
      }
      .content_html{
        width: 100%;
        padding:0 0.3rem;
      }
    }
    .no_data{
      text-align: center;
      padding-top: 3rem;
      color:#666666;
    }
  }
</style>
