<template>
  <section class="mask">
    <div class="mobile_header">
      <span class="left">< <em>我的</em></span>
      <span>我的消息</span>
    </div>
    <ul>
      <li v-for="d,k in data" :key="k">
        <span>{{d.title}}</span>
        <i>{{d.created_at.split(" ")[0]}}</i>
      </li>
      <Pager :len="len"></Pager>
    </ul>
    <div class="nodata" v-if="show">
      <img :src="img" alt="">
      <p>暂无列表信息</p>
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
        len: 0,
        img: require('@/assets/images/no_data.jpg'),
        show: false
      }
    },
    methods: {
      fetchData () {
        var self = this
        util.post('MessageList', {sign: api.serialize({token: this.token, user_id: this.user_id, page: this.now})}).then(function (res) {
          api.checkAjax(self, res, () => {
            self.$store.commit('SET_INFO', {unread_num: res.unread_num})
            self.data = res.list
            self.show = !res.list.length
            if (self.now > 1) return false
            self.len = Math.ceil(res.total_num / 1)
          })
        })
      }
    },
    mounted () {
      this.fetchData()
    },
    computed: {
      ...mapState({
        token: state => state.info.token,
        user_id: state => state.info.user_id,
        unread_num: state => state.info.unread_num
      })
    }
  }
</script>

<style type="text/css" lang="scss">
.mask{
  width: 100%;
  height: 100vh;
  background: #f5f5f9;
}
 ul{
   width: 100%;
   overflow: hidden;
   li{
     width: 100%;
     border-bottom:1px solid #dddddd;
     display: flex;
     justify-content: space-between;
     height: 2rem;
     line-height: 2rem;
     background:white;
     padding:0 .5rem;
     span{
       width: 70%;
       columns: #121212;
     }
     i{
       color: #a9a9a9;
       font-size: 0.45rem;
     }
   }
 }
</style>
