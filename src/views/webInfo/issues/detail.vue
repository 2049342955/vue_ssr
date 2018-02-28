<template>
  <section class="web_info_detail">
    <h3>{{content.title}}<a class="button" to="#" onclick="window.history.go(-1)">< 返回</a></h3>
    <div class="info_detail" v-html="content.content" style="padding:0 50px;"></div>
    <div class="next_prev">
      <button @click="clickcontent(-1)">上一篇：<span>{{prevTitle}}</span></button>
      <button @click="clickcontent(1)"> 下一篇：<span>{{nextTitle}}</span></button>
    </div>
  </section>
</template>

<script>
  import util from '@/util'
  export default {
    data () {
      return {
        content: {},
        params1: '',
        all_id: '',
        nextTitle: '',
        prevTitle: ''
      }
    },
    methods: {
      contentDetail () {
        util.post('getHelpContent', {token: 0, help_id: this.params1}).then((res) => {
          this.content = res.msg
        })
      },
      clickcontent (type) {
        let idLists = JSON.parse(localStorage.getItem('all_id'))
        for (let i = 0; i < idLists.length; i++) {
          if (this.params1 === idLists[i].id) {
            if (type === 1) {
              this.params1 = idLists[i + 1] ? idLists[i + 1].id : this.params1
              this.prevTitle = idLists[i] ? idLists[i].title : '没有上一篇了'
              this.nextTitle = idLists[i + 2] ? idLists[i + 2].title : '没有下一篇了'
            } else if (type === -1) {
              this.params1 = idLists[i - 1] ? idLists[i - 1].id : this.params1
              this.prevTitle = idLists[i - 2] ? idLists[i - 2].title : '没有上一篇了'
              this.nextTitle = idLists[i] ? idLists[i].title : '没有下一篇了'
            }
            break
          }
        }
        this.contentDetail()
      }
    },
    mounted () {
      let p = localStorage.getItem('icon_id')
      let idLists = JSON.parse(localStorage.getItem('all_id'))
      if (p) {
        p = JSON.parse(p)
        this.params1 = p[0]
      }
      for (var i = 0; i < idLists.length; i++) {
        if (this.params1 === idLists[i].id) {
          this.nextTitle = idLists[i + 1] ? idLists[i + 1].title : '没有下一篇了'
          this.prevTitle = idLists[i - 1] ? idLists[i - 1].title : '没有上一篇了'
        }
      }
      this.contentDetail()
    }
  }
</script>
<style type="text/css" lang="scss">
  .web_info_detail{
    min-height:500px;
    background: #fff;
    padding:15px 15px 45px 15px;
    line-height: 2;
    h3{
      text-align:left;
      font-size: 20px;
      line-height: 2;
      font-weight: bold;
      border-bottom: 1px solid #e5e5e5;
      margin-bottom: 20px;
      a{
        text-align: center;
        float: right;
        display:inline-block;
        border: 0;
        font-size: 14px;
        font-weight: 100;
        line-height: 38px;
        color:#327fff;
        cursor: pointer;
      }
    }
    .info_detail{
      img{
        width:auto;
        max-width:100%
      }
    }
    .next_prev{
      width: 100%;
      height: 30px;
      margin-bottom: 30px;
      margin-top: 30px;
      button{
        width: 40%;
        float: left;
        border:0;
        background: white;
        text-align: left;
        color: #327fff;
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
      }
      :nth-child(2){
        float: right;
        text-align: right;
      }
    }
  }
</style>
