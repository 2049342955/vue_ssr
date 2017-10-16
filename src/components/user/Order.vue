<template>
  <section class="order">
    <div class="order_title">
      <div class="text">
        <span class="text_title">订单管理</span>
        <div class="title_content">
          <span class="title_now" @click="openList">{{title[now]}}</span>
          <div class="title_list" v-if="show">
            <router-link :to="'/user/order/'+k+'/1'" v-for="n,k in title" :key="k">{{n}}</router-link>
          </div>
        </div>
      </div>
      <nav>
        <router-link :to="'/user/order/'+now+'/'+(+k+1)" v-for="n,k in nav[now]" :key="k">{{n}}</router-link>
      </nav>
    </div>
    <div class="order_box">
      <table>
        <tr>
          <th>算力服务器</th>
          <th>总算力</th>
          <template v-if="now==0&&(status==2||status==3)">
            <th>出售数量</th>
            <th>出售金额</th>
            <th>出售时间</th>
          </template>
          <template v-if="now!=0&&(status==2||status==3)">
            <th>转让数量</th>
            <th>转让金额</th>
            <th>转让时间</th>
          </template>
          <template v-if="status!=2&&status!=3">
            <th>购买数量</th>
            <th>购买金额</th>
            <th>购买时间</th>
          </template>
          <template v-if="now==0&&(status==1||status==4)">
            <th>剩余可出售</th>
            <th>剩余可出租</th>
          </template>
          <template v-if="now==2&&status==1">
            <th>剩余可出租</th>
          </template>
          <th>操作</th>
        </tr>
        <tr v-for="d,k in data">
          <td>{{d.product_name}}<i :class="'icon_currency '+d.hash_type_name"></i></td>
          <template v-if="now==0&&(status==2||status==3)">
            <td>{{d.total_hash}}T</td>
            <td>{{d.selling_amount}}台</td>
            <td>{{d.total_price}}元</td>
          </template>
          <template v-else-if="(now==1||now==2)&&(status==2||status==3)">
            <td>{{d.total_price}}元</td>
            <td>{{d.transfer_amount}}T</td>
            <td>{{d.transfer_price}}元</td>
          </template>
          <template v-else>
            <td>{{d.total_hash}}T</td>
            <td>{{d.buy_amount}}台</td>
            <td>{{d.total_price}}元</td>
          </template>
          <td>{{d.create_time}}</td>
          <template v-if="now==0&&(status==1||status==4)">
            <td>{{d.remain_miner}}台</td>
            <td>{{d.remain_hash}}T</td>
          </template>
          <template v-if="now==2&&status==1">
            <td>{{d.remain_hash}}T</td>
          </template>
          <td>
            <template v-if="now==0&&status==1">
              <button class="sold" @click="openMask('sold', '出售云矿机', d.id)">出售云矿机</button>
              <button @click="openMask('rent', '出租算力', d.id)">出租算力</button>
            </template>
            <template v-if="now==0&&status==2">
              <button class="sold" @click="quit('sold')">撤销出售</button>
            </template>
            <template v-if="now==1&&status==1">
              <button @click="openMask('rent', '转租算力', d.id)">转租算力</button>
            </template>
            <template v-if="(now==1||now==2)&&status==2">
              <button @click="quit('rent')">撤销转让</button>
            </template>
            <template v-if="now==2&&status==1">
              <button @click="openMask('rent', '出租算力', d.id)">出租算力</button>
            </template>
            <router-link :to="'/user/orderDetail/'+now+'/'+d.id">查看详情</router-link>
          </td>
        </tr>
      </table>
    </div>
    <MyMask :form="form[edit]" :title="editText" v-if="edit"></MyMask>
    <div class="web_tips" ref="tips"></div>
  </section>
</template>

<script>
  import util from '@/util'
  import api from '@/util/function'
  import { mapState } from 'vuex'
  import MyMask from '@/components/common/Mask'
  import md5 from 'js-md5'
  export default {
    components: {
      MyMask
    },
    data () {
      return {
        title: ['云矿机', '算力', '基金'],
        nav: [{'0': '已购买', '1': '出售中', '2': '已出售', '3': '已结束'}, {'0': '已租赁', '1': '出租中', '2': '已出租', '3': '已结束'}, {'0': '持有', '1': '出租中', '2': '已出租', '3': '已结束'}],
        data: [],
        now: 0,
        status: 1,
        show: false,
        edit: '',
        form: {
          sold: [{name: 'amount', type: 'text', title: '出售数量', placeholder: '请输入出售数量'}, {name: 'one_amount_value', type: 'text', title: '出售价格', placeholder: '请输入出售价格'}, {name: 'trade_password', type: 'password', title: '交易密码', placeholder: '请输入交易密码'}],
          rent: [{name: 'amount', type: 'text', title: '出租数量', placeholder: '请输入出租数量', changeEvent: true}, {name: 'transfer_time', type: 'select', title: '出租时长', option: ['30', '90', '180', '360']}, {name: 'transfer_price', type: 'text', title: '出租单价', placeholder: '请输入出租单价', changeEvent: true}, {name: 'total_price', type: 'text', title: '出租总价', edit: 'price'}, {name: 'trade_password', type: 'password', title: '交易密码', placeholder: '请输入交易密码'}]
        },
        editText: '',
        amount: 0,
        transfer_price: 0,
        total_price: 0,
        order_id: ''
      }
    },
    methods: {
      fetchData () {
        var self = this
        this.now = this.$route.params.type
        this.status = this.$route.params.status
        this.show = false
        util.post('fundOrder', {sign: api.serialize({token: this.token, user_id: this.user_id, type: this.$route.params.type, status: this.$route.params.status, page: 1})}).then(function (res) {
          self.data = res.list
        })
      },
      openList () {
        this.show = !this.show
      },
      openMask (str, title, id) {
        this.order_id = id
        window.scroll(0, 0)
        document.body.style.overflow = 'hidden'
        this.editText = title
        this.edit = str
        var requestUrl = ''
        if (str === 'rent') {
          requestUrl = 'showRentHash'
        } else {
          requestUrl = 'showSellMiner'
        }
        util.post(requestUrl, {sign: api.serialize({token: this.token, user_id: this.user_id, order_id: id})}).then(function (res) {
          console.log(res)
        })
      },
      quit (str, id) {
        var requestUrl = ''
        if (str === 'rent') {
          requestUrl = 'backOutRentHash'
        } else {
          requestUrl = 'backOutSellMiner'
        }
        util.post(requestUrl, {sign: api.serialize({token: this.token, user_id: this.user_id, order_id: id})}).then(function (res) {
          console.log(res)
        })
      },
      closeEdit () {
        this.edit = ''
        document.body.style.overflow = 'auto'
      },
      submit () {
        var form = document.querySelector('.form_content')
        var data = api.checkFrom(form)
        var url = ''
        var sendData = {token: this.token, user_id: this.user_id, order_id: this.order_id}
        var tipsStr = ''
        switch (this.edit) {
          case 'sold':
            url = 'saveSellMiner'
            tipsStr = '出售成功'
            break
          case 'rent':
            url = 'saveRentHash'
            tipsStr = '出租成功'
            break
        }
        if (!data) return false
        data.trade_password = md5(data.trade_password)
        var self = this
        console.log(data)
        util.post(url, {sign: api.serialize(Object.assign(data, sendData))}).then(function (back) {
          if (back) {
            self.closeEdit()
            api.tips(self.$refs.tips, tipsStr)
          }
        })
      },
      onChange (e) {
        this[e.target.name] = e.target.value
        this.total_price = this.amount * this.transfer_price
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
            i.icon_currency{
              vertical-align: sub;
              margin-left:5px
            }
            &:last-child{
              width:186px;
              @include gap(10,v)
              button,a{
                line-height: 32px;
                @include gap(15,h)
              }
              button{
                @include button($blue)
                margin-right:5px;
                &.sold{
                  margin-bottom:8px
                }
              }
              a{
                display: inline-block;
                @include button($blue,border)
                border-radius: 5px;
              }
            }
          }
        }
      }
    }
  }
</style>
