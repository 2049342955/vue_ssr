<template>
  <div class="mobile_computehome">
    <div class="mobile_navcompute">
      <router-link :to="n.path" v-for="n, k in navcompute" :key="k">
        <em>{{n.title}}</em>
        <span>|</span>
      </router-link>
    </div>
    <router-view class="currency_right"></router-view>
  </div>
</template>

<script>
export default {
  data () {
    return {
      navcompute: [{title: '快讯', path: '/quickNews/list'}, {title: '资讯', path: '/computeNews/list'}, {title: '测评', path: '/equipmentEvaluate/list'}, {title: '币种', path: '/digitalCurrency/list'}, {title: '厂商', path: '/manufacturer/list'}]
    }
  }
}
</script>

<style lang="scss" scoped>
.mobile_computehome{
    width: 100%;
    height: 100%;
    .mobile_navcompute{
      width: 100%;
      height: 2rem;
      background: white;
      display: flex;
      justify-content: space-between;
      border-bottom:1px solid #bfbfbf;
      box-sizing: border-box;
      :last-child span{
        display:none;
      }
      a{
        width: 20%;
        height: 2rem;
        display:inline-block;
        line-height: 2rem;
        text-align: center;
        span{
            float: right;
            font-size: 0.6rem;
            color:#1b1b1b;
        }
        em{
            font-style:normal;
            font-size: 0.6rem;
            color:#1b1b1b;
        }
        &:hover{
            em{
                display:inline-block;
                border-bottom:2px solid #fe5039;
                box-sizing: border-box;
                width: 1.9rem;
                height: 1.95rem;
                color:#fe5039;
            }
        }
        &.active{
            em{
                display:inline-block;
                border-bottom:2px solid #fe5039;
                box-sizing: border-box;
                width: 1.9rem;
                height: 1.95rem;
                color:#fe5039;
          }
        }
        &.router-link-active{
            em{
                display:inline-block;
                border-bottom:2px solid #fe5039;
                box-sizing: border-box;
                width: 1.9rem;
                height: 1.95rem;
                color:#fe5039;
          }
        }
      }
    }
  }
</style>

