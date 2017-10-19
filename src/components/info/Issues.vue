<template>
  <section class="issues">
    <div class="issues_box">
      <div class="issues_lists">
        <router-link v-for="n,k in nav" :to="'/webInfo/issues/list/'+k" :key="k">{{n}}</router-link>
      </div>
      <router-view class="issues_content"></router-view>
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
        nav: ['详解我们', '账户管理', '交易管理', '充值提现', '费用标准']
      }
    },
    methods: {
      fetchData () {
        var self = this
        this.nowEdit = this.$route.params.type
        this.status = this.$route.params.status
        this.show = false
        util.post('getHelpClass', {sign: api.serialize({token: this.token})}).then(function (res) {
          self.data = res.list
          if (self.now > 1) return false
          self.len = Math.ceil(res.total_num / 15)
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
        a{
          display: block;
          width:100px;
          background: $border;
          text-align: center;
          color:$text;
          line-height: 2.4;
          & + a{
            margin-top:15px
          }
        }
      }
      .issues_content{
        flex:1;
        padding:15px 30px;
        line-height: 2;
      }
    }
  }
</style>
