<template>
  <section class="order">
    <div class="order_title">
      <div class="text">
        <span class="text_title">订单管理</span>
        <div class="title_content">
          <span class="title_now" @click="openList">{{title[edit]}}</span>
          <div class="title_list" v-if="show">
            <router-link :to="'/user/order/'+k+'/0'" v-for="n,k in title" :key="k">{{n}}</router-link>
          </div>
        </div>
      </div>
      <nav>
        <router-link :to="'/user/order/'+edit+'/'+k" v-for="n,k in nav[edit]" :key="k">{{n}}</router-link>
      </nav>
    </div>
    <div class="order_box">
      <table>
        <tr>
          <th>算力服务器</th>
          <th>总算力</th>
          <th>购买数量</th>
          <th>购买金额</th>
          <th>购买时间</th>
          <template v-if="edit==0">
            <th>剩余可出售</th>
            <th>剩余可出租</th>
          </template>
          <template v-if="edit==2">
            <th>剩余可出租</th>
          </template>
          <th>操作</th>
        </tr>
        <tr v-for="d,k in data">
          <td>{{d.product_name}}<i></i></td>
          <td>{{d.remain_hash}}</td>
          <td>{{d.buy_amount}}</td>
          <td>{{d.total_price}}</td>
          <td>{{d.create_time}}</td>
          <template v-if="edit==0">
            <td>{{d.buy_amount}}</td>
            <td>{{d.buy_amount}}</td>
          </template>
          <template v-if="edit==2">
            <td>{{d.buy_amount}}</td>
          </template>
          <td>
            <template v-if="edit==0">
              <button class="sold">出售云矿机</button>
              <button>出租算力</button>
            </template>
            <template v-if="edit==2">
              <button>转租算力</button>
            </template>
            <router-link :to="'/user/orderDetail/'+d.id">查看详情</router-link>
          </td>
        </tr>
      </table>
    </div>
  </section>
</template>

<script>
  import util from '@/util'
  import api from '@/util/function'
  import { mapState } from 'vuex'
  export default {
    data () {
      return {
        title: ['云矿机', '算力', '基金'],
        nav: [{'0': '已购买', '1': '转让中', '2': '已转让', '3': '已结束'}, {'0': '已租赁', '1': '出租中', '2': '已出租', '3': '已结束'}, {'0': '预收订单', '1': '运行中', '2': '待运行', '3': '已结束'}],
        data: [],
        edit: 0,
        show: false
      }
    },
    methods: {
      fetchData () {
        var self = this
        this.edit = this.$route.params.type
        this.show = false
        // console.log(this.$route.params.type)
        // console.log(this.$route.params.status)
        util.post('fundOrder', {sign: api.serialize({token: this.token, user_id: this.user_id})}).then(function (res) {
          self.data = res
          console.log(self.data)
        })
      },
      openList () {
        this.show = !this.show
      }
    },
    computed: {
      ...mapState({
        token: state => state.info.token,
        user_id: state => state.info.user_id
      })
    },
    watch: {
      '$route': 'fetchData'
    },
    mounted () {
      this.fetchData()
    }
  }
</script>
<style type="text/css" lang="scss">
  @import '../../assets/css/style.scss';
  .order{
    .order_title{
      @include gap(25,h)
      padding-top:15px;
      border-bottom: 1px solid $border;
      .text{
        @include flex
        margin-bottom:30px;
        .text_title{
          font-size: 18px;
          padding-right:35px
        }
        .title_content{
          position: relative;
          width:80px;
          @include gap(10,h)
          .title_now{
            font-size: 16px;
            font-weight: bold;
            height: 27px;
            line-height: 27px;
            color:$blue;
            cursor: pointer;
            &:after{
              content:'';
              @include position(10,auto,auto,0)
              @include triangle(bottom,$light_black)
            }
          }
          .title_list{
            @include position(27)
            height:84px;
            z-index: 2;
            background: #fff;
            border:1px solid $blue_border;
            border-top:0;
            a{
              display: block;
              line-height: 2;
              @include gap(10,h)
            }
          }
        }
      }
      nav{
        a{
          @include gap(10,h)
          display: inline-block;
          padding-bottom:10px;
          border-bottom: 3px solid transparent;
          color:#6b7d90;
          & + a{
            margin-left:30px
          }
          &:hover,&.router-link-active{
            border-color:#7e92a8
          }
        }
      }
    }
    .order_box{
      padding:20px 25px;
      table{
        width: 100%;
        text-align: center;
        tr{
          // line-height: 55px;
          border-bottom:1px solid $border;
          &:first-child{
            background: #f7f8fa;
            color: $light_text;
            border-top:1px solid $border;
            border-bottom:0;
            th{
              font-size: 12px;
              font-weight: normal;
              line-height: 50px;
            }
          }
          td{
            i{
              @include block(18)
              background: url('../../assets/images/css_sprites.png') -152px -209px;
              vertical-align: sub;
              margin-left:5px
            }
            &:last-child{
              width:186px;
              @include gap(10,v)
              button,a{
                line-height: 32px;
                border-color: $blue;
                @include gap(15,h)
              }
              button{
                background: $blue;
                color:$white;
                margin-right:5px;
                &.sold{
                  margin-bottom:8px
                }
              }
              a{
                display: inline-block;
                color: $blue;
                border:1px solid;
                border-radius: 5px;
              }
            }
          }
        }
      }
    }
  }
</style>
