<template>
  <section class="issues">
    <div class="issues_box">
      <div class="issues_lists">
        <div class="item" v-for="n,k in nav" @click="fetchData(n.help_class_id)">{{n.name}}</div>
      </div>
      <div class="issues_list" v-show="!show">
        <div class="item" v-for="l,k in list" @click="getContent(k)">{{l.title}}</div>
      </div>
      <div class="issues_content" v-show="show">
        <h3>{{nowItem.title}}</h3>
        <div v-html="nowItem.content"></div>
      </div>
    </div>
  </section>
</template>

<script>
  import util from '@/util'
  import api from '@/util/function'
  import { mapState } from 'vuex'
  export default {
    name: 'Issues',
    data () {
      return {
        nav: [],
        nowClass: -1,
        list: [],
        nowItem: {title: '', content: ''},
        show: false
      }
    },
    methods: {
      fetchData (id) {
        this.show = false
        if (id === this.nowClass) return false
        this.nowClass = id
        this.list = []
        var self = this
        util.post('getHelp', {sign: api.serialize({token: this.token, help_class_id: this.nowClass})}).then(function (res) {
          self.list = res
        })
      },
      getContent (n) {
        this.show = true
        this.nowItem = this.list[n]
      }
    },
    mounted () {
      var self = this
      util.post('getHelpClass', {sign: api.serialize({token: this.token})}).then(function (res) {
        self.nav = res
        self.fetchData(res[0].help_class_id)
      })
    },
    computed: {
      ...mapState({
        token: state => state.info.token
      })
    }
  }
</script>

<style type="text/css" lang="scss">
  @import '../../assets/css/style.scss';
  .issues{
    .issues_box{
      background: #fff;
      min-height:calc(100vh - 536px);
      @include flex(flex-start,stretch)
      padding:40px;
      .issues_lists{
        width:210px;
        border-right:1px solid $border;
        padding:15px;
        .item{
          cursor: pointer;
          width:100px;
          background: $border;
          text-align: center;
          color:$text;
          line-height: 2.4;
          & + .item{
            margin-top:15px
          }
        }
      }
      .issues_content,.issues_list{
        flex:1;
        padding:15px 30px;
        line-height: 2;
        .item{
          cursor: pointer;
        }
        h3{
          margin-bottom:30px
        }
        p{
          text-indent: 2em;
        }
      }
    }
  }
</style>
