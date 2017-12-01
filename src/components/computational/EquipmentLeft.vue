<template>
  <div class="leftnav">
    <div class="leftnav_ol" v-for="n, k in leftnav">
      <router-link :to="n.path">
        <span :class="['icon', 'iconfont', n.big]"></span>
        <i>{{n.title}}</i>
      </router-link>
    </div>
  </div>
</template>

<script>
  export default {
    data () {
      return {
        leftnav: [{big: 'icon-zixun1', title: '快讯', path: '/computational/NewsFlash'}, {big: 'icon-kuangji', title: '测评', path: ''}, {big: 'icon-zixun', title: '行业', path: ''}, {big: 'icon-bitebi', title: '币种', path: ''}, {big: 'icon-bowuguan', title: '博物馆', path: ''}, {big: 'icon-zhizaohangye', title: '厂商', path: ''}, {big: 'icon-dianlishebei', title: '电厂', path: ''}]
      }
    }
  }
</script>

<style lang="scss" scoped>
  .leftnav{
    width: 70px;
    height: 1424px;
    background: #1c202a;
    float: left;
    .leftnav_ol{
      width: 100%;
      height: 68px;
      text-align: center;
      padding-top: 10px;
      box-sizing: border-box;
      span{
        font-size:22px;
        height: 22px;
        margin-bottom: 9px;
        color:#999999;
        display:block;
      }
      i{
        font-size: 12px;
        color:#999;
      }
      &:hover{
        background: #327fff;
        span{
          color:white;
        }
        i{
          color:white;
        }
      }
    }
  }
</style>
