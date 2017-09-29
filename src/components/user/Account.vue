<template>
  <section class="account">
    <h2>账户管理</h2>
    <div class="con">
      <div :class="['item', {fail: !n.status}, {success: n.status}]" v-for="n,k in nav">
        <div class="icon"></div>
        <div class="con_title">{{n.title}}</div>
        <div class="desc">{{n.desc}}</div>
        <div class="val">
          <template v-if="n.status&&n.name==='tel'">{{n.text}}:<span>{{mobile|format}}</span></template>
          <template v-if="n.status&&n.name==='auth'">{{n.text}}:<span>{{idcard|format}}</span></template>
          <template v-if="n.status&&n.name==='test'">{{n.text}}:<span>{{testResult}}</span></template>
          <template v-if="n.status&&n.name==='card'">{{n.text}}:<span>{{cardNo}}</span></template>
          <template v-if="n.status&&n.name==='address'">{{n.text}}:<span>{{mobile|format}}</span></template>
        </div>
        <div class="opr" @click="setEdit(n.name,n.title)" v-if="n.name!=='test'">{{n.opr}}</div>
        <router-link class="opr" to="/accountEvaluate" v-else>{{n.opr}}</router-link>
      </div>
    </div>
    <div class="mask" v-if="edit">
      <div class="form_box">
        <div class="close" @click="closeEdit()">
          <span class="icon"></span>
          <span>关闭</span>
        </div>
        <h2>{{title}}</h2>
        <form class="form_content" @submit.prevent="submit" novalidate>
          <div :class="['input', {addon: f.addon}]" v-for="f in form[edit]">
            <span>{{f.title}}</span>
            <span>*</span>
            <input :type="f.type" :name="f.name" autocomplete="off" :placeholder="f.placeholder" @blur="test" :pattern="f.pattern" data-status="" v-if="f.type!=='select'" :isChange="f.isChange">
            <select name="" id="" v-else-if="f.option">
              <option :value="k" v-for="v,k in f.option">{{v}}</option>
            </select>
            <div class="select" v-else>
              <select name="province_name" id="" @change="changeCity">
                <option :value="v.name" v-for="v,k in province" :selected="p===v.name">{{v.name}}</option>
              </select>
              <select name="city_name" id="" @change="changeCounty">
                <option :value="v.name" v-for="v,k in city" :selected="c===v.name">{{v.name}}</option>
              </select>
              <select name="area_name" id="">
                <option :value="v.name" v-for="v,k in county" :selected="n===v.name">{{v.name}}</option>
              </select>
            </div>
            <template v-if="f.addon">
              <div class="btn" @click="getCode">{{f.con}}</div>
            </template>
            <span :title="f.tips" :tips="f.placeholder" :error="f.error"></span>
          </div>
          <button>确认提交</button>
        </form>
      </div>
    </div>
  </section>
</template>
<script>
  import api from '@/util/function'
  import city from '@/util/city'
  import util from '@/util'
  import { mapState } from 'vuex'
  export default {
    data () {
      return {
        nav: [
          {title: '手机认证', desc: '手机号码是在算力网进行操作的重要凭证。', text: '手机号码', opr: '修改', status: 1, name: 'tel'},
          {title: '实名认证', desc: '完成实名认证，认证后可以获得更多权限', text: '身份证号', opr: '认证', status: 0, name: 'auth'},
          {title: '风险测评', desc: '完成风险测评才可以充值、交易等操作。', text: '', opr: '测评', status: 0, name: 'test'},
          {title: '绑定银行卡', desc: '绑定银行卡才能进行提现。', text: '', opr: '绑定', status: 0, name: 'card'},
          {title: '计算算力地址', desc: '请选择算力类型并设置算力地址', text: '', opr: '设置', status: 0, name: 'address'}
        ],
        form: {
          tel: [{name: 'tel', type: 'text', title: '手机号码', placeholder: '请输入手机号', pattern: '^1[3578][0-9]{9}$', tips: '请输入11位手机号'}, {name: 'code', type: 'text', title: '短信验证', placeholder: '请输入短信验证码', addon: 2, con: '发送验证码', pattern: '^.{6}$', tips: '短信验证码应是6位', error: '短信验证码有误，请重新获取'}],
          auth: [{name: 'truename', type: 'text', title: '姓名', placeholder: '请输入姓名', isChange: true}, {name: 'idcard', type: 'text', title: '证件号码', placeholder: '请输入您的证件号码', pattern: '^([0-9]{15}$|^[0-9]{18}$|^[0-9]{17}([0-9]|X|x))$', tips: '身份证号应是18位'}],
          card: [{name: 'card_no', type: 'text', title: '银行卡号', placeholder: '请输入银行卡号', pattern: '^([1-9]{1})([0-9]{14}|[0-9]{18})$', tips: '请输入19位的银行卡号'}, {name: 'open_bank', type: 'text', title: '开户银行', placeholder: '请输入开户银行名称', isChange: true}, {name: 'bank_branch', type: 'text', title: '开户支行', placeholder: '请输入开户支行名称', isChange: true}, {name: 'bank', type: 'select', title: '开户行地址', isChange: true}, {name: 'mobile', type: 'text', title: '银行预留手机号', placeholder: '请输入银行预留手机号', pattern: '^1[3578][0-9]{9}$', tips: '请输入11位手机号'}, {name: 'code', type: 'text', title: '手机验证码', placeholder: '请输入短信验证码', addon: 2, con: '获取验证码', pattern: '^.{6}$', tips: '短信验证码应是6位', error: '短信验证码有误，请重新获取'}],
          address: [{name: 'type', type: 'select', title: '算力类型', option: ['BIT', 'ETH', 'ETC', 'BCC']}, {name: 'imgCode', type: 'text', title: '算力地址', placeholder: '请输入对应算力地址'}, {name: 'tel', type: 'text', title: '手机号码', placeholder: '请输入手机号', pattern: '^1[3578][0-9]{9}$', tips: '请输入11位手机号'}, {name: 'code', type: 'text', title: '短信验证', placeholder: '请输入短信验证码', addon: 2, con: '发送验证码', pattern: '^.{6}$', tips: '短信验证码应是6位', error: '短信验证码有误，请重新获取'}]
        },
        edit: '',
        title: '',
        province: [],
        city: [],
        county: [],
        p: '',
        c: '',
        n: '',
        idcard: '',
        testResult: '',
        cardNo: ''
      }
    },
    methods: {
      submit () {
        var form = document.querySelector('.form_content')
        var data = api.checkFrom(form)
        var url = ''
        switch (this.edit) {
          case 'tel':
            url = '1'
            break
          case 'auth':
            url = 'user_truename'
            break
          case 'card':
            url = 'BankCard'
            break
          case 'address':
            url = '4'
            break
        }
        if (!data) return false
        util.post(url, {sign: api.serialize(Object.assign(data, {token: this.token, user_id: this.user_id}))}).then(function (data) {
          console.log(data)
        })
      },
      test (e) {
        api.checkFiled(e.target)
      },
      getCode () {
        if (api.checkCode(document.querySelector('.form_content'))) return false
      },
      setEdit (str, title) {
        this.edit = str
        this.title = title
        window.scroll(0, 0)
        document.body.style.overflow = 'hidden'
      },
      closeEdit () {
        this.edit = ''
        document.body.style.overflow = 'auto'
      },
      selectCity (arr, value) {
        return arr.filter((v) => v.name === value)
      },
      changeCity (e) {
        this.setCity(e.target.value)
        this.setCounty(this.city[0].name)
      },
      changeCounty (e) {
        this.setCounty(e.target.value)
      },
      setCity (v) {
        var cities = this.selectCity(city, v)
        cities = cities.length ? cities[0] : city[0]
        this.city = cities.city
      },
      setCounty (v) {
        var counties = this.selectCity(this.city, v)
        counties = counties.length ? counties[0] : this.city[0]
        this.county = counties.county
      }
    },
    computed: {
      ...mapState({
        token: state => state.info.token,
        user_id: state => state.info.user_id,
        mobile: state => state.info.mobile
      })
    },
    mounted () {
      this.province = city
      this.setCity(this.p)
      this.setCounty(this.c)
      util.post('show_user_truename', {sign: api.serialize({token: this.token, user_id: this.user_id})}).then(function (data) {
        console.log(data)
      })
      util.post('show_bankcard', {sign: api.serialize({token: this.token, user_id: this.user_id})}).then(function (data) {
        console.log(data)
      })
    },
    filters: {
      format: api.telReadable
    }
  }
</script>

<style type="text/css" lang="scss">
  @import '../../assets/css/style.scss';
  .account{
    h2{
      padding:10px 25px;
      border-bottom: 1px solid $border;
    }
    .con{
      padding:25px 30px;
      .item{
        @include flex
        border:1px solid;
        padding:15px;
        &.success{
          border-color:$green_border;
          background: $green_bg;
          .icon{
            position: relative;
            background: $green;
            &:before{
              content:'';
              @include right
            }
          }
          .con_title{
            color: $green;
          }
        }
        &.fail{
          border-color:$fail_border;
          background: $fail_bg;
          .icon{
            text-align: center;
            background: $fail;
            color: $white;
            &:before{
              content:'!'
            }
          }
          .con_title{
            color: $fail;
          }
        }
        &:not(:last-child){
          margin-bottom:25px;
        }
        .icon{
          @include block(18,50%)
          margin-right:10px
        }
        .con_title{
          width: 140px;
          font-size: 16px;
          font-weight: bold;
        }
        .desc{
          flex:1
        }
        .val{
          width: 280px;
          color: $light_text;
          span{
            color: $text;
          }
        }
        .opr{
          color: $blue;
          cursor: pointer;
        }
      }
    }
    .mask{
      @include mask
      .form_box{
        .form_content{
          padding:40px 130px;
          @include form(v)
          width:450px;
          .input{
            span{
              &:first-child {
                width: 115px;
                text-align: right;
              }
              &:nth-child(2) {
                left: 135px
              }
            }
            input,select{
              padding-left:185px
            }
            .select{
              padding-left:185px;
              @include flex
              select{
                flex:1;
                padding:6px 0;
                border:none;
                & + select{
                  margin-left:3px
                }
              }
            }
          }
        }
      }
    }
  }
</style>
