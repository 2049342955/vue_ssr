<template>
  <section class="mask">
    <ul v-show="contentshow">
      <li v-for="d,k in data" :key="k" @click="detailcli(d.id)">
        <span>{{d.title}}</span>
        <i>{{d.created_at.split(" ")[0]}}</i>
      </li>
      <Pager :len="len"></Pager>
    </ul>
    <div class="nodata" v-if="show">
      <img :src="img" alt="">
      <p>暂无列表信息</p>
    </div>
    <div class="mask_content" v-show="!contentshow">
      <h3>{{content.title}}</h3>
      <p style="color:#999;">{{content.created_at}}</p>
      <p v-html="content.msg"></p>
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
        content: '',
        leftSibling: 0,
        rightSibling: 0,
        len: 0,
        img: require('@/assets/images/no_data.jpg'),
        show: false,
        contentshow: true
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
            self.len = Math.ceil(res.total_num / 15)
          })
        })
      },
      detailcli (id) {
        var self = this
        var messageid = id
        this.contentshow = false
        util.post('Messagecontent', {sign: api.serialize({token: this.token, user_id: this.user_id, message_id: messageid})}).then(function (res) {
          api.checkAjax(self, res, () => {
            self.content = res
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
.nodata{
  width: 100%;
  text-align: center;
  height: 100%;
  background:white;
}
.nodata img{
  width: 130px;
  display: block;
  margin:0 auto;
  margin-top: 140px;
  margin-bottom: 20px;
}
.nodata p{
  text-align: center !important;
  width: 40% !important;
  margin-left:30%;
}
.pager .pager_box{
  border-top: 1px solid #ddd !important;
}
.pager{
  padding-top: 20px;
  padding-bottom: 20px;
  box-sizing: border-box;
  text-align: center !important;
}
.mask{
  width: 100%;
  height: 100vh;
  background: white;
  padding-bottom: 60px;
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
 .mask_content{
   width: 100%;
   height: 100%;
   background:white;
   padding:0 .5rem;
   h3{
     color:#121212;
     font-size: 0.7rem;
   }
 }
</style>
