<template>
  <section class="issues">
    <div class="mobile_header">
      <span class="left">< <em>返回</em></span>
      <span>帮助中心</span>
    </div>
    <div class="issues_box" v-show="show">
      <div class="issues_lists">
        <div class="item" v-for="n,k in nav" @click="fetchData(n.help_class_id,k)">
          <p class="titleall">{{n.name}}<em>></em></p>
          <div class="issues_list" v-if="num===k">
            <a class="item" v-for="l,k in list" @click="detailcontent(l.id)">
              <span>{{l.title}}</span>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="content" v-show="!show" v-html="nowItem.content">
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
        list: [],
        nowItem: [],
        show: true
      }
    },
    methods: {
      fetchData (id, k) {
        if (k === this.num) {
          this.$store.commit('SET_NUM', -1)
          return false
        }
        var eles = document.querySelector('.issues_lists').children
        for (var key = 0; key < eles.length; key++) {
          eles[key].className = 'item'
        }
        this.list = []
        var self = this
        util.post('getHelp', {sign: api.serialize({token: this.token, help_class_id: id})}).then(function (res) {
          self.list = res
        })
        setTimeout(() => {
          this.$store.commit('SET_NUM', k)
          eles[k].className = 'item active'
        }, 0)
      },
      detailcontent (id) {
        var self = this
        var helpid = id
        this.show = false
        util.post('getHelpContent', {sign: api.serialize({token: this.token, help_id: helpid})}).then(function (res) {
          self.nowItem = res
        })
      }
    },
    mounted () {
      var self = this
      util.post('getHelpClass', {sign: api.serialize({token: this.token})}).then(function (res) {
        self.nav = res
        self.fetchData(res[self.num || 0].help_class_id, self.num || 0)
      })
    },
    computed: {
      ...mapState({
        token: state => state.info.token,
        num: state => state.num
      })
    }
  }
</script>

<style type="text/css" lang="scss">
.mobile_header{
  margin:0;
}
  .issues{
    .content{
            width: 100%;
            overflow: hidden;
            height: 100vh;
            padding:0.5rem;
            background: #f5f5f9;
            box-sizing: border-box;
            text-indent:0rem !important;
            img{
              width: 100%;
              height: auto;
            }
            span{
              text-indent:0rem !important;
            }
          }
    .issues_box{
      background: #f5f5f9;
      width: 100%;
      height: 100vh;
      .issues_lists{
        width:100%;
        padding:0;
        .item{
          cursor: pointer;
          width: 100%;
          text-align: left;
          color:#121212;
          // border-bottom:1px solid #ddd;
          line-height: 3;
          .titleall{
            width: 100%;
            height: 2rem;
            padding:0 .5rem;
            line-height: 2rem;
            box-sizing: border-box;
            background: white;
            border-bottom:1px solid #ddd;
            em{
              font-family: "宋体";
              font-style: normal;
              transform: rotate(90deg);
              float:right;
            }
            .active em{
              transform: rotate(-90deg);
              transform-style: 4s;
            }
          }
          &:hover{
              color:#327fff;
          }
          &.active{
              color:#327fff;
          }
        }
      }
      .issues_list{
        width:100%;
        line-height: 2;
        .item{
          border-top:1px solid #ddd;
          overflow: hidden;
          line-height: 1.5rem;
          cursor: pointer;
          width: 100%;
          display: block;
          span{
            width: 100%;
            display:flex;
            justify-content: space-between;
            height: 1.5rem;
            padding:0 .5rem;
          }
          &:hover{
            color:#327fff;
          }
        }
      }
    }
  }
</style>
