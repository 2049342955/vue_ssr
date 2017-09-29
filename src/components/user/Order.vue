<template>
  <section class="order">
    <div class="order_title">
      <div class="text">
        <span>订单管理</span>
        <select name="" id="">
          <option value="">基金</option>
        </select>
      </div>
      <nav>
        <router-link :to="'/user/order/'+k" v-for="n,k in nav" :key="k">{{n}}</router-link>
      </nav>
    </div>
    <div class="order_box">
      <table>
        <tr>
          <th v-for="t,k in th">{{t}}</th>
        </tr>
        <tr v-for="d,k in data">
          <td>{{d.hash_miner.name}}<i></i></td>
          <td>{{d.hash_miner.hash}}</td>
          <td>{{d.hold_amount}}</td>
          <td>{{d.pay_value}}</td>
          <td>{{d.hash_miner.price}}</td>
          <td>{{d.hold_amount}}</td>
          <td>
            <button>出租算力</button>
            <router-link :to="'/user/orderDetail/'+d.hash_miner.id">查看详情</router-link>
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
        nav: {'8': '运行中', '7': '待运行', '6': '已结束', '9': '预收订单'},
        th: ['算力服务器', '每台算力', '购买数量', '购买金额', '购买时间', '剩余可出租', '操作'],
        data: []
      }
    },
    methods: {
      fetchData () {
        var self = this
        util.post('fundOrder', {sign: api.serialize({token: this.token, user_id: this.user_id, staus: this.$route.params.status})}).then(function (res) {
          self.data = res
          console.log(self.data)
        })
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
        span{
          font-size: 18px;
          padding-right:35px
        }
        select{
          width:auto;
          font-size: 16px;
          font-weight: bold;
          height: 27px;
          line-height: 27px;
          color:$blue
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
          line-height: 55px;
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
              button,a{
                line-height: 32px;
                border-color: $blue;
                @include gap(15,h)
              }
              button{
                background: $blue;
                color:$white;
                margin-right:5px
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
