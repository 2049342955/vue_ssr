<template>
  <section class="swiper" :class="[direction?'horizontal':'vertical',{'dragging':dragging}]" @touchstart="onTouchStart" @mousedown="onTouchStart" @wheel="onWheel" ref="swiper-wrap">
    <div class="swiper-wrap" :style="{'transform':'translate3d('+translateX+'px,'+translateY+'px,0','transition-duration':transitionDuration+'ms'}" @transitionend="onTransitionEnd">
      <img class="swiper_one" :src="n.image" v-for="n,k in slideEls">
    </div>
    <div class="swiper-pagination" v-show="paginationVisiable">
      <span class="swiper-pagination-bullet" :class="{'active':k+1===currentPage}" v-for="(slide,k) in banners" @click="paginationClickable && setPage(k+1)"></span>
    </div>
  </section>
</template>

<script>
  import api from '../../util'
  export default {
    name: 'swiper',
    props: {
      direction: {
        type: Number,
        default: 1,
        validator: (value) => {
          return [1, 0].indexOf(value) > -1
        }
      },
      mouseWheelControl: {
        type: Boolean,
        default: false
      },
      paginationVisiable: {
        type: Boolean,
        default: true
      },
      paginationClickable: {
        type: Boolean,
        default: false
      },
      loop: {
        type: Boolean,
        default: false
      },
      speed: {
        type: Number,
        default: 200
      }
    },
    data () {
      return {
        banners: [],
        slideEls: [],
        currentPage: 1,
        lastPage: 1,
        delta: 0,
        dragging: false,
        transitioning: false,
        startPos: null,
        startTranslate: 0,
        translateOffset: 0,
        translateX: 0,
        translateY: 0,
        transitionDuration: 0,
        offset: 0
      }
    },
    mounted () {
      var self = this
      api.post('/banner', {sign: 'token=0'}).then(function (data) {
        self.banners = data
        self.offset = self.$refs['swiper-wrap'][self.direction ? 'offsetWidth' : 'offsetHeight']
        self.onTouchMove = self.onTouchMove.bind(self)
        self.onTouchEnd = self.onTouchEnd.bind(self)
        var arr = self.banners
        self.slideEls = [arr[arr.length - 1], ...arr, arr[0]]
        self.translateOffset = -self.offset
        if (self.loop) {
          self.setTranslate(self.getTranslateOfPage(self.currentPage))
        }
      })
    },
    methods: {
      onTouchStart (e) {
        this.startPos = this.getTouchPos(e)
        this.delta = 0
        this.startTranslate = this.getTranslateOfPage(this.currentPage)
        this.startTime = new Date().getTime()
        this.dragging = true
        this.transitionDuration = 0
        document.addEventListener('touchmove', this.onTouchMove, false)
        document.addEventListener('mousemove', this.onTouchMove, false)
        document.addEventListener('touchend', this.onTouchEnd, false)
        document.addEventListener('mouseup', this.onTouchEnd, false)
      },
      onWheel (e) {
        if (this.mouseWheelControl) {
          e.preventDefault()
          if (!this.transitioning) {
            if (e.deltaY > 0) {
              this.next()
            } else {
              this.prev()
            }
          }
        }
      },
      onTransitionEnd () {
        this.transitioning = false
        this.transitionDuration = 0
        this.delta = 0
        if (this.lastPage !== this.currentPage) {
          this.$emit('slide-change-end', this.currentPage)
        } else {
          this.$emit('slide-revert-end', this.currentPage)
        }
      },
      onTouchMove (e) {
        e.preventDefault()
        this.delta = this.getTouchPos(e) - this.startPos
        this.setTranslate(this.startTranslate + this.delta)
      },
      onTouchEnd (e) {
        document.removeEventListener('touchmove', this.onTouchMove)
        document.removeEventListener('touchend', this.onTouchEnd)
        document.removeEventListener('mousemove', this.onTouchMove)
        document.removeEventListener('mouseup', this.onTouchEnd)
        if (this.delta === 0) return false
        this.dragging = false
        this.transitionDuration = this.speed
        var isQuickAction = new Date().getTime() - this.startTime < 1000
        if (this.delta < -100 || (isQuickAction && this.delta < 50)) {
          this.next()
        } else if (this.delta > 100 || (isQuickAction && this.delta > 50)) {
          this.prev()
        } else {
          this.setPage(this.currentPage)
        }
      },
      setPage (page, e) {
        this.lastPage = this.currentPage
        if (page === 0) {
          this.currentPage = this.banners.length
        } else if (page === this.banners.length + 1) {
          this.currentPage = 1
        } else {
          this.currentPage = page
        }
        this.setTranslate(this.getTranslateOfPage(page))
        this.onTransitionStart()
      },
      next () {
        var page = this.currentPage
        if (page < this.banners.length || this.loop) {
          this.setPage(page + 1)
        } else {
          this.setPage(this.currentPage)
        }
      },
      prev () {
        var page = this.currentPage
        if (page > 1 || this.loop) {
          this.setPage(page - 1)
        } else {
          this.setPage(this.currentPage)
        }
      },
      onTransitionStart () {
        this.transitioning = false
        this.transitionDuration = this.speed
        if (this.lastPage !== this.currentPage) {
          this.$emit('slide-change-start', this.currentPage)
        } else {
          this.$emit('slide-revert-start', this.currentPage)
        }
      },
      setTranslate (value) {
        var translateName = this.direction ? 'translateX' : 'translateY'
        this[translateName] = value
      },
      getTouchPos (e) {
        var key = this.direction ? 'pageX' : 'pageY'
        return e.changedTouches ? e.changedTouches[0][key] : e[key]
      },
      getTranslateOfPage (page) {
        if (page === 0) return 0
        return -[].reduce.call(this.banners, (total, el, i) => {
          return i > page - 2 ? total : total + this.offset
        }, 0) + this.translateOffset
      }
    }
  }
</script>

<style type="text/css">
  .swiper {
    position: relative;
    height: 550px;
    overflow: hidden
  }
  .swiper-wrap {
    display: flex;
    width: 100%;
    height: 100%;
    transition: all 0ms ease;
  }
  .swiper-wrap > .swiper_one{
    display: flex;
    flex-shrink: 0;
    width: 100%;
    height: 100%;
  }
  img.swiper_one{
    object-fit: cover;
  }
  .horizontal .swiper-wrap {
    flex-direction: row;
  }
  .vertical .swiper-wrap {
    flex-direction: column;
  }
  .swiper-pagination {
    position: absolute;
  }
  .swiper-pagination .swiper-pagination-bullet {
    display: inline-block;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background-color: #000000;
    opacity: .2;
    transition: all .5s ease;
  }
  .swiper-pagination .swiper-pagination-bullet.active {
    background: #fff;
    opacity: 1;
  }
  .vertical .swiper-pagination {
    right: 10px;
    top: 50%;
    transform: translate3d(0, -50%, 0);
  }
  .vertical .swiper-pagination .swiper-pagination-bullet{
    margin: 6px 0;
  }
  .horizontal .swiper-pagination {
    bottom: 80px;
    width: 100%;
    text-align: center;
  }
  .horizontal .swiper-pagination .swiper-pagination-bullet{
    margin: 0 3px;
  }
</style>
