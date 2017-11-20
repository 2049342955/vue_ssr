<template>
  <section class="admin">
    <div class="list">
      <div class="item" v-for="k in 2" @click="setInfo(list[k-1].name,menu[k-1].status)">
        <span>{{list[k-1].title}}</span>
        <i v-if="k===1">{{mobile|format}}</i>
        <i v-else>{{!menu[k-1].status?'去认证':true_name.truename+'：'+true_name.idcard|cardformat}}</i>
      </div>
    </div>
    <div class="list">
      <div class="item" v-for="k in 4" @click="setInfo(list[k+1].name,menu[k+1].status)">
        <span>{{list[k+1].title}}</span>
        <i v-if="list[k+1].name==='card'&&bank_card.open_bank">{{bank_card.card_no|cardformat}}</i>
        <i v-else-if="list[k+1].name==='trade'&&trade_password">已设置<em style="margin-left:.3rem;"><img src="../../assets/images/leftjian.png" style="width:0.3rem;height:0.4rem;margin-left:0.5rem;position:relative;top:-0.8rem;"/></em></i>
        <i v-else>设置<em style="margin-left:.3rem;"><img src="../../assets/images/leftjian.png" style="width:0.3rem;height:0.4rem;margin-left:0.5rem;position:relative;top:-0.8rem;"/></em></i>
      </div>
    </div>
    <mt-popup position="bottom" v-model="showModal" :closeOnClickModal="false">
      <div class="close" @click="closeEdit()">
        <span class="icon"></span>
      </div>
      <form class="form" @submit.prevent="submit" novalidate style="box-sizing:border-box;margin-top:1rem;">
        <FormField :form="form[edit]"></FormField>
        <button name="btn">提交</button>
      </form>
    </mt-popup>
  </section>
</template>

<script>
  import { Toast } from 'mint-ui'
  import util from '@/util'
  import api from '@/util/function'
  import { mapState, mapGetters } from 'vuex'
  import FormField from '@/components/common/FormField'
  import md5 from 'js-md5'
  export default {
    components: {
      FormField
    },
    data () {
      return {
        list: [{name: 'tel', title: '用户名'}, {name: 'auth', title: '实名认证'}, {name: 'card', title: '银行卡'}, {name: 'trade', title: '交易密码'}, {name: 'login', title: '登录密码'}, {name: 'address', title: '算力收益地址'}],
        form: {
          auth: [{name: 'truename', type: 'text', title: '姓名', placeholder: '请输入姓名', isChange: true}, {name: 'card_type', type: 'text', title: '证件类型', edit: 'card_type', isChange: true}, {name: 'idcard', type: 'text', title: '证件号码', placeholder: '请输入您的证件号码', pattern: 'idCard'}, {name: 'mobile', type: 'text', title: '手机号码', edit: 'mobile'}, {name: 'code', type: 'text', title: '短信验证', placeholder: '请输入短信验证码', addon: 2, pattern: 'telCode'}],
          card: [{name: 'card_no', type: 'text', title: '银行卡号', placeholder: '请输入银行卡号', pattern: 'bankCard', changeEvent: true}, {name: 'open_bank', type: 'text', title: '开户银行', placeholder: '根据卡号可识别，若否，请手动输入', isChange: true}, {name: 'bank_branch', type: 'text', title: '开户支行', placeholder: '请输入开户支行名称', isChange: true}, {name: 'bank', type: 'select', title: '开户行地址', isChange: true}, {name: 'mobile', type: 'text', title: '银行预留手机号', placeholder: '请输入银行预留手机号', pattern: 'tel'}, {name: 'code', type: 'text', title: '手机验证码', placeholder: '请输入短信验证码', addon: 2, pattern: 'telCode'}],
          address: [{name: 'product_hash_type', type: 'select', title: '算力类型', option: []}, {name: 'address', type: 'text', title: '算力地址', placeholder: '请输入对应算力地址', pattern: 'computeAddress'}, {name: 'mobile', type: 'text', title: '手机号码', edit: 'mobile'}, {name: 'code', type: 'text', title: '短信验证', placeholder: '请输入短信验证码', addon: 2, pattern: 'telCode'}],
          login: [{name: 'mobile', type: 'text', title: '手机号码', edit: 'mobile'}, {name: 'code', type: 'text', title: '短信验证', placeholder: '请输入短信验证码', addon: 2, pattern: 'telCode'}, {name: 'password', type: 'password', title: '设置密码', placeholder: '请输入密码', pattern: 'password'}, {name: 'password1', type: 'password', title: '确认密码', placeholder: '请再次输入密码', pattern: 'password', error: '两次密码不一致'}],
          trade: [{name: 'mobile', type: 'text', title: '手机号码', edit: 'mobile'}, {name: 'code', type: 'text', title: '短信验证', placeholder: '请输入短信验证码', addon: 2, pattern: 'telCode'}, {name: 'trade_password', type: 'password', title: '设置密码', placeholder: '请输入密码', pattern: 'telCode'}, {name: 'trade_password1', type: 'password', title: '确认密码', placeholder: '请再次输入密码', pattern: 'telCode', error: '两次密码不一致'}]
        },
        showModal: false,
        edit: -1,
        card_type: '中国大陆身份证'
      }
    },
    methods: {
      setInfo (k, s) {
        if (k === 'tel' || (k === 'auth' && s)) return false
        this.showModal = true
        this.edit = k
      },
      submit () {
        var form = document.querySelector('.form')
        var data = api.checkFrom(form, this, true)
        var url = ''
        var callbackUrl = ''
        var val = ''
        var sendData = {token: this.token, user_id: this.user_id}
        var tipsStr = ''
        var tipsStr2 = ''
        switch (this.edit) {
          case 'tel':
            break
          case 'auth':
            url = 'user_truename'
            callbackUrl = 'show_user_truename'
            val = 'true_name'
            tipsStr = '已提交，请您等待几秒查看结果'
            tipsStr2 = '恭喜您实名认证成功'
            break
          case 'card':
            url = 'BankCard'
            callbackUrl = 'show_bankcard'
            val = 'bank_card'
            tipsStr = '已提交，请您等待几秒查看结果'
            tipsStr2 = '恭喜您银行卡绑定成功'
            break
          case 'address':
            url = 'bindAddress'
            callbackUrl = 'show_Address'
            val = 'address'
            tipsStr = '设置成功'
            break
          case 'login':
            url = 'changeLoginPassword'
            tipsStr = '修改成功'
            break
          case 'trade':
            url = 'tradePassword'
            data.trade_password = md5(data.trade_password)
            data.trade_password1 = md5(data.trade_password1)
            tipsStr = '设置成功'
            break
        }
        if (!data) return false
        var self = this
        util.post(url, {sign: api.serialize(Object.assign(data, sendData))}).then(function (res) {
          api.checkAjax(self, res, () => {
            self.myToast(tipsStr)
            if (self.edit === 'auth' || self.edit === 'card') {
              self.$store.commit('SET_INFO', {[val]: {status: 0}})
              setTimeout(() => {
                self.requestData(callbackUrl, sendData, val, () => {
                  self.myToast(tipsStr2)
                })
              }, 7000)
            } else if (self.edit === 'address') {
              self.requestData(callbackUrl, sendData, val)
            }
            self.showModal = false
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
      },
      myToast (str) {
        Toast({
          message: str,
          position: 'middle',
          duration: 3000
        })
      },
      closeEdit () {
        this.showModal = false
      }
    },
    computed: {
      ...mapState({
        token: state => state.info.token,
        user_id: state => state.info.user_id,
        mobile: state => state.info.mobile,
        true_name: state => state.info.true_name,
        bank_card: state => state.info.bank_card,
        trade_password: state => state.info.trade_password
      }),
      ...mapGetters([
        'menu'
      ])
    },
    filters: {
      format: api.telReadable,
      cardformat: api.cardReadable
    }
  }
</script>

<style lang="scss">
  @import '../../assets/css/style.scss';
  .admin{
    width: 100%;
    height: 100%;
    background: #f5f5f9;
    .list{
      width: 100%;
      overflow: hidden;
      background: white;
      padding:0 .5rem;
      box-sizing: border-box;
      .item{
        width: 100%;
        height: 2rem;
        display: flex;
        justify-content: space-between;
        line-height: 2rem;
        span{
          color: #121212;
          font-size: 0.6rem;
        }
        i{
          color: #999999;
          font-size: 0.6rem;
          em{
            font-family: "宋体";
            font-style: normal;
          }
        }
        &:not(:last-child){
          border-bottom:1px solid #ddd;
        }
      }
      & + .list{
        margin-top: .5rem;
      }
    }
    .mint-popup{
      @include popup
      .form{
        height:auto
      }
    }
  }
</style>
