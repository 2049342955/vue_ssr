<template>
  <div class="sort">
    <div class="box">
      <div class="sort_title">
        <h1>项目列表</h1>
      </div>
      <div class="sort_body">
        <div class="item">
          <span>行业列表</span>
          <router-link to="/minerShop/miner/1/all">矿机</router-link>
          <router-link to="/minerShop/miner/2/all">云矿机</router-link>
        </div>
        <div class="item">
          <span>项目状态</span>
          <router-link class="active" to="/fb">不限</router-link>
          <router-link to="/fb">预热中</router-link>
          <router-link to="/fb">抢购中</router-link>
          <router-link to="/fb">已售罄</router-link>
        </div>
      </div>
      <div class="sort_items">
        <div :class="['item', 'next', {active1: activeOne==true}]" @click="setSort('all')">默认</div>
        <div :class="['item', {active: edit==k}, {up: !s.value},{active1: activeOne==false}]" v-for="s,k in sort" @click="setSort(k)">{{s.title}}<span class="iconfont"></span></div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    props: {
      sort: {
        type: Array
      },
      page: {
        type: String
      }
    },
    data () {
      return {
        edit: -1,
        activeOne: true
      }
    },
    methods: {
      setSort (n) {
        this.activeOne = false
        this.edit = n
        var obj = this.sort[n]
        var str = ''
        for (let ele of this.sort) {
          if (obj !== ele) {
            ele.value = 0
          }
        }
        if (obj) {
          obj.value = +(!obj.value)
          str = obj.option[obj.value]
        } else {
          this.activeOne = true
          str = n
        }
        if (this.page === 'compute' || this.page === 'minerShop') {
          this.$router.push({path: '/' + this.page + '/list/' + this.$route.params.type + '/' + str})
        } else {
          this.$router.push({path: '/user/' + this.page + '/' + str})
        }
      }
    }
  }
</script>

<style type="text/css" lang="scss">
  @import '../../assets/css/style.scss';
  .sort{
    @include main
    padding-top:25px;
    color:$light_text;
    .box{
      background: $white;
      box-shadow:0px 0px 15px 0px rgba(63, 71, 84, 0.37);
      .sort_title{
        padding:15px 20px;
        border-bottom: 1px dashed #eee;
      }
      .sort_body{
        padding:15px 20px;
        .item{
          span{
            color:$light_black;
            margin-right:30px;
          }
          a{
            display: inline-block;
            padding:0 15px;
            border-radius:5px;
            line-height: 1.8;
            &.router-link-active,&.active{
              @include button($blue)
            }
          }
          & + .item{
            margin-top:15px;
          }
        }
      }
      .sort_items{
        @include flex
        background: #F5F5F5;
        .item{
          cursor: pointer;
          padding:0 30px;
          line-height: 40px;
          color:#999;
          & + .item{
            margin-left:50px
          }
          .iconfont{
            @include block(24)
            vertical-align: middle;
            transition:all .3s;
            
            &:before{
              font-size: 18px;
              content:'\e84b';
            }
          }
          &.active{
            color:$blue
          }
          &.up{
            .iconfont{
              transform:rotate(180deg)
            }
          }
        }
        .next{
          &.active1{
            color:$blue;
          }
        }
      }
    }
    @include mobile_hide
  }
</style>
