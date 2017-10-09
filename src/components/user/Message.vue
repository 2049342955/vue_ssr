<template>
  <section class="message">
    <h2>消息中心</h2>
    <h3>通知消息<span class="read">全部标为已读</span></h3>
    <div class="data">
      <div :class="['item', {isread: d.isread}]" v-for="d,k in data" @click="setRead(k)">
        <div class="title">{{d.title}}</div>
        <div class="text">{{d.content}}</div>
        <div class="time">{{d.time}}</div>
      </div>
      <Pager type="message"></Pager>
    </div>
  </section>
</template>

<script>
  import Pager from '@/components/common/Pager'
  export default {
    components: {
      Pager
    },
    data () {
      return {
        data: [{title: '认证审核已经通过', content: '如果你无法通过上面按钮验证电子邮箱，请点击下面的链接', time: '2017-02-03 18:00', isread: false}, {title: '认证审核已经通过', content: '如果你无法通过上面按钮验证电子邮箱，请点击下面的链接', time: '2017-02-03 18:00', isread: false}, {title: '认证审核已经通过', content: '如果你无法通过上面按钮验证电子邮箱，请点击下面的链接', time: '2017-02-03 18:00', isread: false}, {title: '认证审核已经通过', content: '如果你无法通过上面按钮验证电子邮箱，请点击下面的链接', time: '2017-02-03 18:00', isread: false}],
        len: 0,
        now: 0
      }
    },
    methods: {
      setRead (i) {
        this.data[i].isread = true
      }
    },
    mounted () {
      this.len = Math.ceil(this.data.length / 3)
    }
  }
</script>

<style type="text/css" lang="scss">
  @import '../../assets/css/style.scss';
  .message{
    padding:0 15px;
    h2{
      padding:0 15px !important;
    }
    h3{
      .read{
        float: right;
        color: $blue;
        cursor: pointer;
        font-size: 14px;
      }
    }
    .data{
      .item{
        line-height: 50px;
        border-bottom:1px solid $border;
        @include flex(space-between)
        @include gap(15,h)
        cursor: pointer;
        .title,.time{
          width:160px;
          font-weight: bold;
        }
        .time{
          text-align: right;
        }
        .text{
          width:leave(320);
          @include ellipsis
          color:#bfbfbf
        }
        &.isread{
          .title,.time{
            color:$light_text;
            font-weight: normal;
          }
          .text{
            color: $light_black;
          }
        }
      }
    }
  }
</style>
