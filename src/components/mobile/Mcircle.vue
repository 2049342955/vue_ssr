<template>
<div class="v-circle" v-bind:style="circleStyle" >
  <div class="mask full" v-bind:style="[maskStyle, transitionStyle, rotateStyle]">
    <div class="fill" v-bind:style="[fillStyle, transitionStyle, rotateStyle]"></div>
  </div>
  <div class="mask half" v-bind:style="[maskStyle]">
    <div class="fill" v-bind:style="[fillStyle, transitionStyle, rotateStyle]"></div>
    <div class="fill fix" :class="{}" v-bind:style="[fillStyle, fixStyle, transitionStyle]"></div>
  </div>
  <div class="pv" v-bind:style="pvStyle">
    <span class="progress" v-bind:style="progressTextStyle">
      {{ pv || 0 }}%
    </span>
  </div>
</div>
</template>

<style lang="scss" scoped>
  .v-circle {
    border-radius: 50%;
    position: relative;

    .mask, .fill {
      position: absolute;
      border-radius: 50%;
      backface-visibility: hidden;
    }

    .pv {
      position: absolute;
      top: 0;
      left: 0;
      bottom: 0;
      right: 0;
      margin: auto;
      z-index: 1;
      border-radius: 50%;
      text-align: center;

      .progress {
        margin: 0;
        padding: 0;
      }
    }
  }
</style>

<script>
  export default {
    methods: {
      setClip (t, r, b, l) {
        return `rect(${t}px, ${r}px, ${b}px, ${l}px)`
      },
      setTransformStyle (pv, type) {
        let deg = Math.floor((pv / 100) * 180)
        if (type === 'fix') {
          // remove the gap between two half circles
          return `rotate(${deg * 2}deg)`
        }
        return `rotate(${deg}deg)`
      },
      setTransitionStyle (t) {
        return `transform ${t}s`
      },
      setPv (n) {
        this.pv = n
        let types = ['fix', 'rotate']
        // map styles
        types.map((type) => {
          this[type + 'Style'] = {
            transform: this.setTransformStyle(this.pv, type)
          }
        })
      }
    },
    props: [
      'color',
      'width',
      'fontSize',
      'pv',
      'textColor',
      'bold',
      'textBgColor',
      'borderColor',
      'during',
      'bgColor'
    ],
    data () {
      var transformStyleValue = this.setTransformStyle(0)
      var innerCircleWidth = ((this.width || 150) - 2 * (this.bold || 5)) + 'px'
      var fixTransformStyleValue = this.setTransformStyle(0, 'fix') // 初始化让进度为 0
      var transitionStyleValue = this.setTransitionStyle(this.during || 0.8)
      return {
        pvs: 0,
        // 环形样式
        circleStyle: {
          width: (this.width || 150) + 'px',
          height: (this.width || 150) + 'px',
          backgroundColor: (this.bgColor || '#f9f9f9')
        },
      // 进度文字样式
        progressTextStyle: {
          fontSize: (this.fontSize || 64) + 'px',
          color: this.textColor || '#bdc3c7'
        },
        fillStyle: {
          backgroundColor: this.color || '#2ecc71',
          width: (this.width || 150) + 'px',
          height: (this.width || 150) + 'px',
          clip: this.setClip(0, this.width / 2, this.width, 0)
        },
        rotateStyle: {
          transform: transformStyleValue,
          webkitTransform: transformStyleValue,
          msTransform: transformStyleValue,
          oTransform: transformStyleValue,
          mozTransform: transformStyleValue
        },
        transitionStyle: {
          transition: transitionStyleValue,
          webkitTransition: transitionStyleValue,
          mozTransition: transitionStyleValue,
          oTransition: transitionStyleValue,
          msTransition: transitionStyleValue
        },
        maskStyle: {
          width: (this.width || 150) + 'px',
          height: (this.width || 150) + 'px',
          clip: this.setClip(0, this.width, this.width, this.width / 2)
        },
        pvStyle: {
          backgroundColor: this.textBgColor || '#fff',
          width: innerCircleWidth,
          height: innerCircleWidth,
          lineHeight: innerCircleWidth
        },
        fixStyle: {
          transform: fixTransformStyleValue,
          webkitTransform: fixTransformStyleValue,
          mozTransform: fixTransformStyleValue,
          oTransform: fixTransformStyleValue,
          msTransform: fixTransformStyleValue
        }
      }
    },
    mounted () {
      this.setPv(this.pv)
    }
  }
</script>
