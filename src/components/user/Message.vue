<template>
  <section class="message">
    <h2>消息中心</h2>
    <h3>通知消息<span class="read" v-if="data.length">全部标为已读</span></h3>
    <div class="data">
      <div :class="['item', {isread: d.is_read}]" v-for="d,k in data" @click="setRead(k)">
        <div class="title">{{d.title}}</div>
        <div class="text">{{d.dealtContent}}</div>
        <div class="time">{{d.created_at}}</div>
      </div>
      <Pager type="message"></Pager>
    </div>
  </section>
</template>

<script>
  import util from '@/util'
  import api from '@/util/function'
  import { mapState } from 'vuex'
  import Pager from '@/components/common/Pager'
  export default {
    components: {
      Pager
    },
    data () {
      return {
        data: [],
        now: 1,
        leftSibling: 0,
        rightSibling: 0,
        len: 0
      }
    },
    methods: {
      setRead (i) {
        this.data[i].isread = true
      },
      fetchData () {
        var self = this
        util.post('MessageList', {sign: api.serialize({token: this.token, user_id: this.user_id})}).then(function (res) {
          console.log(res)
          self.data = res
          self.len = Math.ceil(res.length / 3)
        })
      }
    },
    watch: {
      '$route': 'fetchData'
    },
    mounted () {
      this.fetchData()
    },
    computed: {
      ...mapState({
        token: state => state.info.token,
        user_id: state => state.info.user_id
      })
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
