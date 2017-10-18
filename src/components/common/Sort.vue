<template>
  <div class="sort">
    <div class="item" @click="setSort('default')">默认</div>
    <div :class="['item', {active: edit==k}, {up: !s.value}]" v-for="s,k in sort" @click="setSort(k)">{{s.title}}<span class="iconfont"></span></div>
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
        edit: -1
      }
    },
    methods: {
      setSort (n) {
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
          str = 'default'
        }
        if (this.page === 'computeTransfer' || this.page === 'cloudCompute') {
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
    background: $white;
    padding:10px 25px;
    color:$light_text;
    @include flex
    border: 1px solid $border;
    .item{
      cursor: pointer;
      padding:0 30px;
      line-height: 40px;
      background: #f7f8fa;
      & + .item{
        margin-left:50px
      }
      .iconfont{
        @include block(24)
        vertical-align: middle;
        transition:all .3s;
        &:before{
          font-size: 24px;
          content:'\e60e'
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
  }
</style>
