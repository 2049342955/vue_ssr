<template>
  <section class="order">
    <div class="order_title">
      <div class="text">
        <span>订单管理</span>
        <select name="" id="">
          <option value="">云矿机</option>
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
        <tr v-for="i in 6">
          <td v-for="d,k in data[0]" v-if="k!=='type'&&k!=='id'">
            <template v-if="k==='name'">{{d}}<i></i></template>
            <template v-else-if="k!=='opr'">{{d}}</template>
            <template v-else>
              <button>出售矿机</button>
              <router-link :to="'/user/orderDetail/'+data[0].id">查看详情</router-link>
            </template>
          </td>
        </tr>
      </table>
    </div>
  </section>
</template>

<script>
  export default {
    data () {
      return {
        nav: ['已购买', '转让中', '已转让', '已结束'],
        th: ['算力服务器', '总算力', '购买数量', '购买金额', '购买时间', '剩余可售', '剩余可出租', '操作'],
        data: [{id: 0, name: '阿瓦隆', type: 'bit', compute: '9T', num: '1台', pay: '10000元', time: '2017-09-21', leftSell: '1台', leftRent: '9T', opr: ''}]
      }
    },
    methods: {
      test (e) {
        console.log(11)
      }
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
