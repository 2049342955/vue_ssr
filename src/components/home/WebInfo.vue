<template>
  <div class="web_info">
    <div class="main">
      <div class="box">
        <h3>
          <span class="icon"></span>
          <span class="text">网站动态</span>
          <router-link to="">查看更多 ></router-link>
        </h3>
        <div class="list">
          <router-link to="" class="item" v-for="a,k in activity" :key="k">
            <span class="icon"></span>
            <span class="line"></span>
            <span class="text">{{a.title}}</span>
            <span class="date">{{a.dateline}}</span>
          </router-link>
        </div>
      </div>
      <div class="box">
        <h3>
          <span class="icon"></span>
          <span class="text">产品公告</span>
          <router-link to="">查看更多 ></router-link>
        </h3>
        <div class="list">
          <router-link to="" class="item" v-for="a,k in notice" :key="k">
            <span class="icon"></span>
            <span class="line"></span>
            <span class="text">{{a.title}}</span>
            <span class="date">{{a.date}}</span>
          </router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import api from '../../util'
  export default {
    name: 'chart',
    data () {
      return {
        activity: [],
        notice: [{title: '算力网新产品云矿机第一期产品即将上线.', date: '2017-07-19'}, {title: '算力网新产品云矿机第一期产品即将上线.', date: '2017-07-19'}, {title: '算力网新产品云矿机第一期产品即将上线.', date: '2017-07-19'}, {title: '算力网新产品云矿机第一期产品即将上线.', date: '2017-07-19'}, {title: '算力网新产品云矿机第一期产品即将上线.', date: '2017-07-19'}]
      }
    },
    mounted () {
      var self = this
      api.post('/webDynamic', {sign: 'token=0'}).then(function (data) {
        self.activity = data
      })
    }
  }
</script>

<style type="text/css" lang="scss">
  @import '../../assets/css/style.scss';
  .web_info{
    border-top:1px solid $border;
    border-bottom:1px solid $border;
    margin-bottom:60px;
    .main{
      @include flex(flex-start,flex-start)
      @include main
      .box{
        flex:1;
        padding-bottom:5px;
        &:first-child{
          padding-right:60px;
          border-right: 1px solid $border;
        }
        &:last-child{
          padding-left:60px;
        }
        h3{
          @include flex(space-between,center)
          padding-top:25px;
          margin-bottom:20px;
          .icon{
            width:3px;
            height:20px;
            background: $blue;
          }
          .text{
            flex:1;
            font-size: 24px;
            padding-left:20px;
          }
          a{
            color:#999;
            font-size: 14px;
            &:hover{
              color:$blue
            }
          }
        }
        .list{
          .item{
            position: relative;
            color:$light_text;
            padding-bottom:25px;
            @include flex(space-between)
            .icon{
              @include block(10,50%)
              border:1px solid #e8e8e8;
              background:#f2f2f2
            }
            .line{
              @include position(15,5,-6,auto)
              width:1px;
              background:#eaeaea;
              z-index: -1;
            }
            .text{
              flex:1;
              padding-left:14px;
            }
            .date{
              color:#999
            }
            &:hover{
              .icon{
                border-color:$orange;
                background:$white
              }
              .text{
                color:$orange
              }
            }
          }
        }
      }
    }
  }
</style>