<template>
  <section class="message">
    <h2>消息中心</h2>
    <h3>通知消息<span class="read" v-if="data.length" @click="setRead()">全部标为已读</span></h3>
    <div class="data">
      <router-link :to="'/user/messageDetail/'+d.id" :class="['item', {isread: d.is_read}]" v-for="d,k in data" :key="k">
        <div class="title">{{d.title}}</div>
        <div class="text">{{d.dealtContent}}</div>
        <div class="time">{{d.created_at}}</div>
      </router-link>
      <Pager :len="len"></Pager>
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
        var self = this
        util.post('isRead', {sign: api.serialize({token: this.token, user_id: this.user_id, is_read: 0})}).then(function (res) {
          self.$router.push({name: 'message'})
        })
      },
      fetchData () {
        var self = this
        util.post('MessageList', {sign: api.serialize({token: this.token, user_id: this.user_id, page: this.now})}).then(function (res) {
          console.log(res)
          self.data = res.list
          if (self.now > 1) return false
          self.len = Math.ceil(res.total_num / 15)
        })
      },
      getList () {
        this.fetchData()
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
        color: $text;
        .title,.time{
          font-weight: bold
        }
        .time{
          width:160px;
        }
        .title{
          width:320px;
          @include ellipsis
        }
        .time{
          text-align: right;
        }
        .text{
          width:leave(480);
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
