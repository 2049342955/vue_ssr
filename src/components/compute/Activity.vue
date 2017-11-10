<template>
  <div class="activity_box">
    <div class="bg_box">
      <img :src="data.activity_picture" alt="">
    </div>
    <div class="buy_form">
      <div class="form_bg">
        <img :src="require('@/assets/images/buy_bg.png')" alt="">
        <div class="buy_title">
          <b>{{data.name}}</b>
          <span class="title_key">批次所在区域：</span>
          <span class="title_val">{{data.area}}</span>
        </div>
        <div class="buy_desc">
          <div class="item" v-for="t,k in text">
            <div class="item_num">
              <b>{{data[k]}}</b>
              <span>{{t.unit}}</span>
            </div>
            <div class="item_desc">{{t.title}}</div>
          </div>
        </div>
        <div class="buy_input">
          <p>购买数量（台）</p>
          <div class="input_box">
            <span @click="changeNum(+number-1)">-</span>
            <input type="text" v-model="number" name="number" placeholder="请输入购买数量，1台起售" @blur="changeNum(number)">
            <span @click="changeNum(+number+1)">+</span>
          </div>
          <p>总算力：<span>{{totalHash}}T</span></p>
          <p>需支付：<span>{{totalPrice}}元</span></p>
          <button @click="gobuy()">立即支付</button>
          <label for="accept">
            <input type="checkbox" :value="accept" id="accept" name="accept">
            <span @click="openContract(1)">阅读并接受<a href="javascript:;">《云矿机购买协议》</a>和<a href="javascript:;">《矿机托管协议》</a></span>
            <span class="select_accept">{{tips}}</span>
          </label>
        </div>
      </div>
    </div>
    <List></List>
    <MyMask :form="auth" :title="title" :contract="contract" v-if="edit"></MyMask>
  </div>
</template>

<script>
  import util from '@/util'
  import api from '@/util/function'
  import List from './List'
  import MyMask from '@/components/common/Mask'
  import { mapState } from 'vuex'
  export default {
    components: {
      List, MyMask
    },
    data () {
      return {
        text: {one_amount_value: {unit: '元/台', title: '算力服务器价格'}, hash: {unit: 'T/台', title: '服务器算力'}, amount: {unit: '台', title: '出售总量'}},
        data: {},
        auth: [{name: 'truename', type: 'text', title: '姓名', placeholder: '请输入姓名', isChange: true}, {name: 'card_type', type: 'text', title: '证件类型', edit: 'card_type', isChange: true}, {name: 'idcard', type: 'text', title: '证件号码', placeholder: '请输入您的证件号码', pattern: 'idCard'}, {name: 'mobile', type: 'text', title: '手机号码', edit: 'mobile'}, {name: 'code', type: 'text', title: '短信验证', placeholder: '请输入短信验证码', addon: 2, pattern: 'telCode'}],
        totalHash: '0.00',
        totalPrice: '0.00',
        number: '',
        tips: '',
        accept: false,
        edit: 0,
        title: '',
        contract: '',
        content: '',
        card_type: '中国大陆身份证'
      }
    },
    methods: {
      changeNum (n) {
        var maxNum = +this.data.amount - (+this.data.sell_amount)
        this.number = n < 1 ? 1 : n > this.data.num ? this.data.num : n > maxNum ? maxNum : n
        this.totalHash = this.number * this.data.hash
        this.totalPrice = this.number * this.data.one_amount_value
      },
      openContract (n) {
        this.accept = true
        window.scroll(0, 0)
        document.body.style.overflow = 'hidden'
        this.edit = n
        if (n === 1) {
          this.contract = this.content
          this.title = '协议详情'
        } else if (n === 2) {
          this.contract = ''
          this.title = '实名认证'
        }
      },
      gobuy () {
        if (!this.true_name) {
          this.openContract(2)
          return false
        }
        var ele = document.querySelector('#accept')
        if (!this.number) {
          this.check(ele, '请填写数量')
          return false
        }
        if (!ele.checked) {
          this.check(ele, '请同意服务条款')
          return false
        }
        // var data = {product_id: this.data.product, number: this.number, mode: '1', token: this.token}
        // var callbackUrl = location.protocol + '//' + location.host + '/user/order/0/1'
        // var self = this
        // util.post('showProduct', {sign: api.serialize(data)}).then(function (res) {
        //   api.checkAjax(self, res, () => {
        //     self.data = res
        //     self.content = self.format(res.content) + '<hr>' + self.format(res.content1)
        //   })
        // })
      },
      closeEdit () {
        this.edit = ''
        document.body.style.overflow = 'auto'
      },
      format (s) {
        s = s.replace('\\s', '')
        s = s.replace('\\n', '')
        s = s.replace('\\r', '')
        s = s.replace('\\t', '')
        return s
      },
      check (ele, str) {
        this.tips = str
        ele.setAttribute('data-status', 'invalid')
        setTimeout(() => {
          ele.setAttribute('data-status', '')
        }, 2000)
      },
      submit () {
        var form = document.querySelector('.form_content')
        var data = api.checkFrom(form)
        var val = 'true_name'
        var sendData = {token: this.token, user_id: this.user_id}
        var tipsStr = '实名认证已提交，请您耐心等待几秒即可看到认证结果'
        var tipsStr2 = '恭喜您实名认证成功'
        if (!data) return false
        var self = this
        util.post('user_truename', {sign: api.serialize(Object.assign(data, sendData))}).then(function (res) {
          api.checkAjax(self, res, () => {
            api.tips(tipsStr)
            self.$store.commit('SET_INFO', {[val]: {status: 0}})
            setTimeout(() => {
              self.requestData('show_user_truename', sendData, val, () => {
                api.tips(tipsStr2)
              })
            }, 7000)
            self.closeEdit()
          })
        })
      },
      requestData (url, sendData, val, callback) {
        var self = this
        util.post(url, {sign: api.serialize(sendData)}).then(function (res) {
          api.checkAjax(self, res, () => {
            self.$store.commit('SET_INFO', {[val]: res})
            if (callback) {
              callback()
            }
          }, '', () => {
            self.$store.commit('SET_INFO', {[val]: ''})
          })
        })
      }
    },
    computed: {
      ...mapState({
        token: state => state.info.token,
        user_id: state => state.info.user_id,
        mobile: state => state.info.mobile,
        true_name: state => state.info.true_name
      })
    },
    mounted () {
      if (!this.token) {
        this.$store.commit('SET_URL', this.$route.path)
        this.$router.push({name: 'login'})
        self.$store.commit('LOGOUT')
        return false
      }
      var self = this
      util.post('showProduct', {sign: api.serialize({token: this.token})}).then(function (res) {
        api.checkAjax(self, res, () => {
          self.data = res
          self.content = self.format(res.content) + '<hr>' + self.format(res.content1)
        })
      })
    }
  }
</script>

<style lang="scss">
  @import '../../assets/css/style.scss';
  .activity_box{
    width: 100%;
    min-height:700px;
    overflow: hidden;
    background: #151136;
    .bg_box{
      @include bg(1920,445px,#110d30)
    }
    .buy_form{
      height:530px;
      padding-top:40px;
      background: #151136;
      color:$white;
      background: linear-gradient(to bottom, #151136 20%, #2f006d);
      filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#151136', endColorstr='#2f006d',GradientType=0 );
      .form_bg{
        @include bg(1213,424px,transparent)
      }
      .buy_title,.buy_desc,.buy_input{
        position: absolute;
        left:50%;
        top:110px;
      }
      .buy_title{
        margin-left:-500px;
        top:0;
        b{
          color:#f8b551;
          font-size: 30px;
          font-weight: normal;
        }
        .title_key{
          margin-left:100px;
          font-size: 16px;
        }
        .title_val{
          color:#f8b551;
          font-size: 16px;
        }
      }
      .buy_desc{
        margin-left:-75px;
        .item{
          &:not(:last-child){
            margin-bottom:30px
          }
          .item_num{
            color:#fede00;
            line-height: 1.2;
          }
          b{
            font-size: 36px;
            margin-right:10px;
          }
        }
      }
      .buy_input{
        width:280px;
        margin-left:200px;
        .input_box{
          background: #fff;
          line-height: 2.4;
          @include number_box
          border-radius:5px;
          overflow:hidden;
          margin:10px 0;
        }
        p{
          line-height: 2;
          span{
            color:#ff9f00;
          }
        }
        button{
          width:280px;
          height:45px;
          line-height: 45px;
          border:0;
          color:$white;
          background: linear-gradient(to right, #ffaf01 20%, #f9580d);
          filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffaf01', endColorstr='#f9580d',GradientType=1 );
          margin:10px 0;
        }
        label{
          display: block;
          width:360px;
          @include accept_label
          &, & a{
            color:#fff;
          }
          input{
            @include checkbox(18,2px)
            background: #fff;
            &:checked{
              background: #fff;
              border-color: #fff;
              &:before{
                border-color: $text;
              }
            }
          }
        }
      }
    }
    .mask{
      h2{
        line-height: 52px;
        padding:0 28px;
        border-bottom: 1px solid $border;
      }
    }
  }
</style>
