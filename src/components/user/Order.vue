<template>
  <section class="order">
    <div class="order_title">
      <div class="text">
        <span class="text_title">订单管理</span>
        <div class="title_content">
          <span class="title_now" @click="openList">{{title[nowEdit]}}</span>
          <div class="title_list" v-show="show">
            <template v-if="scode">
              <router-link :to="'/user/order/'+k+'/1'" v-for="n,k in title2" :key="k">{{n}}</router-link>
            </template>
            <template v-else>
              <router-link :to="'/user/order/'+k+'/1'" v-for="n,k in title" :key="k">{{n}}</router-link>
            </template>
          </div>
        </div>
      </div>
      <nav>
        <router-link :to="'/user/order/'+nowEdit+'/'+(+k+1)" v-for="n,k in nav[nowEdit]" :key="k">{{n}}</router-link>
      </nav>
    </div>
    <div class="order_box">
      <table>
        <tr>
          <th>算力服务器</th>
          <template v-if="nowEdit==0&&(status==2||status==3)">
            <th>总算力</th>
            <th>出售数量</th>
            <th>出售金额</th>
            <th>出售时间</th>
          </template>
          <template v-if="nowEdit!=0&&(status==2||status==3)">
            <th>转让金额</th>
            <th>转让数量</th>
            <th>转让单价</th>
            <th>转让时间</th>
          </template>
          <template v-if="status!=2&&status!=3">
            <th>总算力</th>
            <th v-if="nowEdit!=1">购买数量</th>
            <th>购买金额</th>
            <th>购买时间</th>
          </template>
          <template v-if="nowEdit==0&&(status==1||status==4)">
            <th>剩余可出售</th>
            <th>剩余可出租</th>
          </template>
          <template v-if="nowEdit==2&&status==1">
            <th>剩余可出租</th>
          </template>
          <th>操作</th>
        </tr>
        <tr v-for="d,k in data">
          <td>{{d.product_name}}<i :class="'icon_currency '+d.hash_type_name"></i></td>
          <template v-if="nowEdit==0&&(status==2||status==3)">
            <td>{{d.total_hash|format}}T</td>
            <td>{{d.selling_amount}}台</td>
            <td>{{d.total_price}}元</td>
          </template>
          <template v-else-if="(nowEdit==1||nowEdit==2)&&(status==2||status==3)">
            <td>{{d.total_price}}元</td>
            <td>{{d.transfer_amount|format}}T</td>
            <td>{{d.transfer_price}}元</td>
          </template>
          <template v-else>
            <td>{{d.total_hash|format}}T</td>
            <td v-if="nowEdit!=1">{{d.buy_amount}}台</td>
            <td>{{d.total_price}}元</td>
          </template>
          <td>{{d.create_time}}</td>
          <template v-if="nowEdit==0&&(status==1||status==4)">
            <td>{{d.remain_miner}}台</td>
            <td>{{d.remain_hash|format}}T</td>
          </template>
          <template v-if="nowEdit==2&&status==1">
            <td>{{d.remain_hash|format}}T</td>
          </template>
          <td>
            <template v-if="nowEdit==0&&status==1">
              <button class="sold" @click="openMask('sold', '出售云矿机', d.id)" :disabled="!d.remain_miner">出售云矿机</button>
              <button @click="openMask('rent', '出租算力', d.id)" :disabled="!d.remain_hash">出租算力</button>
            </template>
            <template v-if="nowEdit==0&&status==2">
              <button class="sold" @click="quit('sold', d.id)">撤销出售</button>
            </template>
            <template v-if="nowEdit==1&&status==1">
              <button @click="openMask('againRent', '转租算力', d.id)" :disabled="!d.remain_hash">转租算力</button>
            </template>
            <template v-if="(nowEdit==1||nowEdit==2)&&status==2">
              <button @click="quit('rent', d.id)">撤销出租</button>
            </template>
            <template v-if="nowEdit==2&&status==1">
              <button @click="openMask('rent', '出租算力', d.id)">出租算力</button>
            </template>
            <router-link :to="'/user/orderDetail/'+nowEdit+'/'+d.id"  v-if="status!=2&&status!=3">查看详情</router-link>
          </td>
        </tr>
      </table>
      <div class="nodata" v-if="showImg">
        <img :src="img" alt="">
        <p>暂无列表信息</p>
      </div>
      <Pager :len="len"></Pager>
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
  import Pager from '@/components/common/Pager'
  import md5 from 'js-md5'
  export default {
    components: {
      MyMask, Pager
    },
    data () {
      return {
        title: ['云矿机', '算力'],
        title2: ['云矿机', '算力', '基金'],
        nav: [{'0': '已购买', '1': '出售中', '2': '已出售', '3': '已结束'}, {'0': '已租赁', '1': '出租中', '2': '已出租', '3': '已结束'}, {'0': '持有', '1': '出租中', '2': '已出租', '3': '已结束'}],
        data: [],
        nowEdit: 0,
        status: 1,
        show: false,
        edit: '',
        form: {
          sold: [{name: 'amount', type: 'text', title: '出售数量', placeholder: '请输入出售数量', changeEvent: true, tipsInfo: '最大可出售数量', tipsUnit: '台'}, {name: 'one_amount_value', type: 'text', title: '出售单价', placeholder: '请输入出售单价', changeEvent: true, tipsInfo: '购入价格', tipsUnit: '元'}, {name: 'total_price', type: 'text', title: '出售总价', edit: 'price', tipsInfo: 'show', tipsUnit: '元'}, {name: 'trade_password', type: 'password', title: '交易密码', placeholder: '请输入交易密码'}],
          rent: [{name: 'amount', type: 'text', title: '出租数量', placeholder: '请输入出租数量', changeEvent: true, tipsInfo: '最大可出租数量', tipsUnit: 'T'}, {name: 'transfer_time', type: 'select', title: '出租时长', option: ['30', '90', '180', '360'], unit: '天'}, {name: 'transfer_price', type: 'text', title: '出租单价', placeholder: '请输入出租单价', changeEvent: true, tipsInfo: 'show', tipsUnit: '元'}, {name: 'total_price', type: 'text', title: '出租总价', edit: 'price', tipsInfo: 'show', tipsUnit: '元'}, {name: 'trade_password', type: 'password', title: '交易密码', placeholder: '请输入交易密码'}],
          againRent: [{name: 'amount', type: 'text', title: '转租数量', placeholder: '请输入出租数量', edit: 'price', tipsInfo: true, tipsUnit: 'T'}, {name: 'transfer_time', type: 'text', title: '转租时长', edit: 'price', tipsInfo: '已使用时长', tipsUnit: '天', showUse: true}, {name: 'transfer_price', type: 'text', title: '转租单价', placeholder: '请输入出租单价', edit: 'price', tipsInfo: true, tipsUnit: '元'}, {name: 'total_price', type: 'text', title: '转租总价', placeholder: '请输入转租总价', changeEvent: true, tipsInfo: 'show', tipsUnit: '元'}, {name: 'trade_password', type: 'password', title: '交易密码', placeholder: '请输入交易密码'}]
        },
        editText: '',
        amount: 0,
        inputAmount: 0,
        transfer_price: 0,
        one_amount_value: 0,
        total_price: 0,
        transfer_time: 0,
        have_use_time: 0,
        order_id: '',
        len: 0,
        now: 1,
        fee: 0,
        img: require('@/assets/images/no_data.jpg'),
        showImg: false
      }
    },
    methods: {
      fetchData () {
        var self = this
        this.data = []
        this.nowEdit = this.$route.params.type
        this.status = this.$route.params.status
        this.show = false
        util.post('fundOrder', {sign: api.serialize({token: this.token, user_id: this.user_id, type: this.$route.params.type, status: this.$route.params.status, page: this.now})}).then(function (res) {
          self.data = res.list
          self.showImg = !res.list.length
          if (self.now > 1) return false
          self.len = Math.ceil(res.total_num / 15)
        })
      },
      getList () {
        this.fetchData()
      },
      openList () {
        this.show = !this.show
      },
      openMask (str, title, id) {
        this.total_price = 0
        this.order_id = id
        window.scroll(0, 0)
        document.body.style.overflow = 'hidden'
        this.editText = title
        this.edit = str
        var data = {}
        var requestUrl = ''
        if (str === 'rent') {
          requestUrl = 'showRentHash'
          data = {order_id: id}
        } else if (str === 'againRent') {
          requestUrl = 'showSubletHash'
          data = {transfer_record_id: id}
        } else {
          requestUrl = 'showSellMiner'
          data = {order_id: id}
        }
        var self = this
        util.post(requestUrl, {sign: api.serialize(Object.assign({token: this.token, user_id: this.user_id}, data))}).then(function (res) {
          console.log(res)
          if (str === 'sold') {
            self.one_amount_value = res.one_amount_value
            self.amount = res.show_miner
            self.fee = res.sell_miner_fee
          } else if (str === 'againRent') {
            self.amount = res.show_hash
            self.transfer_time = res.rent_time - res.have_use_time
            self.fee = res.rent_fee
            self.have_use_time = res.have_use_time
          } else {
            self.amount = res.show_hash
            self.fee = res.rent_fee
          }
        })
      },
      quit (str, id) {
        var requestUrl = ''
        if (str === 'rent') {
          requestUrl = 'backOutRentHash'
        } else {
          requestUrl = 'backOutSellMiner'
        }
        var self = this
        util.post(requestUrl, {sign: api.serialize({token: this.token, user_id: this.user_id, order_id: id})}).then(function (res) {
          if (!res.code) {
            api.tips(self.$refs.tips, '操作成功', () => {
              self.fetchData()
            })
          }
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
          case 'againRent':
            url = 'saveSubletHash'
            tipsStr = '转租成功'
            sendData = {token: this.token, user_id: this.user_id, transfer_record_id: this.order_id}
            break
        }
        if (!data) return false
        data.trade_password = md5(data.trade_password)
        var self = this
        console.log(data)
        util.post(url, {sign: api.serialize(Object.assign(data, sendData))}).then(function (back) {
          if (back) {
            self.closeEdit()
            api.tips(self.$refs.tips, tipsStr, () => {
              self.fetchData()
            })
          }
        })
      },
      onChange (e, i) {
        if (i === 'total_price') {
          this.total_price = e.target.value
          this.transfer_price = api.decimal(this.total_price / this.amount)
        } else {
          if (i === 'amount') {
            e.target.value = (+e.target.value > this.amount) ? api.decimal(this.amount, 2) : e.target.value
            this.inputAmount = e.target.value
          } else {
            this[i] = e.target.value
            this.total_price = api.decimal(this.inputAmount * this[i])
          }
        }
      }
    },
    computed: {
      ...mapState({
        token: state => state.info.token,
        user_id: state => state.info.user_id,
        scode: state => state.info.scode
      })
    },
    watch: {
      '$route': 'fetchData'
    },
    mounted () {
      this.fetchData()
    },
    filters: {
      format: api.decimal
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
        @include select_list
        margin-bottom:30px;
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
            line-height:54px;
            i.icon_currency{
              vertical-align: sub;
              margin-left:5px
            }
            &:last-child{
              width:186px;
              button,a{
                line-height: 34px;
                @include gap(15,h)
              }
              button{
                @include button($blue)
                margin-right:5px;
                &.sold{
                  margin-bottom:8px
                }
                &:disabled{
                  background: #759fe4;
                  border-color:#759fe4;
                  cursor: no-drop;
                }
              }
              a{
                display: inline-block;
                @include button($blue,border)
                border-radius: 5px;
                .btn:not(:disabled){
                  @include button($orange)
                  cursor: pointer;
                }
              }
            }
          }
        }
      }
      @include nodata
    }
  }
</style>
