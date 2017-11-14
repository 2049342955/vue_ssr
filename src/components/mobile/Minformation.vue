<template>
  <section class="information">
    <div class="list">
       <div class="infor-detail" v-for="n,k in lists" @click="detailcli(n.id)" v-show="status">
           <template v-if="n.image">
               <img :src="n.image"/>
            </template>
            <template v-else>
               <img :src="img1"/>
            </template>
            <div class="right">
                <h4>{{n.resume?n.resume:'暂无简介'}}</h4>
                <p>{{n.dateline}}</p>
            </div>
        </div>
        <div class="detail" v-show="!status" v-html="content.content"></div>
    </div>
  </section>
</template>

<script>
  import util from '../../util'
  import api from '../../util/function'
  export default {
    data () {
      return {
        lists: [],
        img1: require('@/assets/images/zx.jpg'),
        content: '',
        status: true
      }
    },
    methods: {
      judge () {
        var self = this
        util.post('suanliMessage', {sign: 'token=0'}).then(function (res) {
          api.checkAjax(self, res, () => {
            self.lists = res
          })
        })
      },
      detailcli (id) {
        var self = this
        var newsid = id
        this.status = false
        util.post('content', {sign: 'token=0&news_id=' + newsid}).then(function (res) {
          api.checkAjax(self, res, () => {
            self.content = res
          })
        })
      }
    },
    mounted () {
      this.judge()
    }
  }
</script>
<style scoped lang="scss">
 .mobile_header{
     margin:0;
 }
 .button{
     width: 60px;
    height: 30px;
    text-align: center;
    float: right;
    background: #f5f8ff;
    color: #327fff;
    border: 0;
    border-radius: 3px;
    margin-bottom: 20px;
    }
  .information{
    width: 100%;
    height: 100vh;
    background: #f5f5f9;
    .list{
        width: 100%;
        overflow: hidden;
        background:white;
        padding:0 .5rem;
    }
    .infor-detail{
        width: 100%;
        display: flex;
        overflow: hidden;
        border-bottom:1px solid #ddd;
        box-sizing: border-box;
        justify-content: space-between;
        padding:0.5rem 0;
        img{
            width: 30% !important;
            height: 3rem;
        }
        .right{
            margin-left:0.8rem;
            width: 63%;
            h4{
                font-size: 0.55rem;
                color: #121212;
                height: 1.77rem;
                width: 100%;
                overflow: hidden;
                text-align: left;
            }
            p{
               padding-top: 0.5rem;
               color: #999999;
               text-align: left;
            }
        }
    }
  }
</style>
