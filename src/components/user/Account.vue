<template>
  <section class="account">
    <h2>账户管理</h2>
    <div class="con">
      <div :class="['item', {fail: !n.status}, {success: n.status}]" v-for="n,k in nav">
        <div class="icon"></div>
        <div class="title">{{n.title}}</div>
        <div class="desc">{{n.desc}}</div>
        <div class="val">
          <template v-if="n.text">{{n.text}}:<span>{{n.value}}</span></template>
        </div>
        <div class="opr" @click="setEdit(n.name,n.title)" v-if="n.name!=='test'">{{n.opr}}</div>
        <router-link class="opr" to="" v-else>{{n.opr}}</router-link>
      </div>
    </div>
    <div class="mask" v-if="edit">
      <div class="form_box">
        <div class="close" @click="closeEdit()">
          <span class="icon"></span>
          <span>关闭</span>
        </div>
        <h2>{{title}}</h2>
        <form class="form_content">
          <div :class="['input', {addon: f.addon}]" v-for="f in form[edit]">
            <span>{{f.title}}</span>
            <span>*</span>
            <input :type="f.type" :name="f.name" autocomplete="off" :placeholder="f.placeholder" @blur="test" :pattern="f.pattern" data-status="">
            <template v-if="f.addon">
              <div class="btn" @click="getCode">发送验证码</div>
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
  export default {
    data () {
      return {
        nav: [
          {title: '手机认证', desc: '手机号码是在算力网进行操作的重要凭证。', text: '手机号码', value: '188****9665', opr: '修改', status: 1, name: 'tel'},
          {title: '实名认证', desc: '完成实名认证，认证后可以获得更多权限', text: '身份证号', value: '610524********1234', opr: '修改', status: 1, name: 'auth'},
          {title: '风险测评', desc: '完成风险测评才可以充值、交易等操作。', text: '', value: '', opr: '测评', status: 0, name: 'test'},
          {title: '绑定银行卡', desc: '绑定银行卡才能进行提现。', text: '', value: '', opr: '绑定', status: 0, name: 'card'},
          {title: '计算算力地址', desc: '请选择算力类型并设置算力地址', text: '', value: '', opr: '设置', status: 0, name: 'address'}
        ],
        form: {
          tel: [{name: 'tel', type: 'text', title: '手机号码', placeholder: '请输入手机号', pattern: '^1[3578][0-9]{9}$', tips: '请输入11位手机号'}, {name: 'code', type: 'text', title: '短信验证', placeholder: '请输入短信验证码', addon: 2, con: '发送验证码', pattern: '^.{6}$', tips: '短信验证码应是6位', error: '短信验证码有误，请重新获取'}],
          auth: [{name: 'tel', type: 'text', title: '手机号码', placeholder: '请输入手机号', pattern: '^1[3578][0-9]{9}$', tips: '请输入11位手机号'}, {name: 'code', type: 'text', title: '短信验证', placeholder: '请输入短信验证码', addon: 2, con: '发送验证码', pattern: '^.{6}$', tips: '短信验证码应是6位', error: '短信验证码有误，请重新获取'}],
          card: [{name: 'tel', type: 'text', title: '手机号码', placeholder: '请输入手机号', pattern: '^1[3578][0-9]{9}$', tips: '请输入11位手机号'}, {name: 'code', type: 'text', title: '短信验证', placeholder: '请输入短信验证码', addon: 2, con: '发送验证码', pattern: '^.{6}$', tips: '短信验证码应是6位', error: '短信验证码有误，请重新获取'}],
          address: [{name: 'type', type: 'select', title: '算力类型'}, {name: 'imgCode', type: 'text', title: '算力地址', placeholder: '请输入对应算力地址'}, {name: 'tel', type: 'text', title: '手机号码', placeholder: '请输入手机号', pattern: '^1[3578][0-9]{9}$', tips: '请输入11位手机号'}, {name: 'code', type: 'text', title: '短信验证', placeholder: '请输入短信验证码', addon: 2, con: '发送验证码', pattern: '^.{6}$', tips: '短信验证码应是6位', error: '短信验证码有误，请重新获取'}]
        },
        edit: '',
        title: ''
      }
    },
    methods: {
      test (e) {
        console.log(11)
      },
      check (ele) {
        var ff = document.querySelector('.regist')
        if (!ele.checkValidity()) {
          ele.setAttribute('data-status', 'invalid')
        } else {
          if (ele.value && (ele.name === 'imgCode' && ele.value !== this.code) || (ele.name === 'repwd' && ele.value !== ff[3].value)) {
            ele.setAttribute('data-status', 'error')
          } else {
            ele.setAttribute('data-status', 'valid')
            return true
          }
        }
      },
      getCode () {
        var ff = document.querySelector('.regist')
        var c = true
        for (var i = 0; i <= 1; i++) {
          if (ff[i].value) {
            if (!this.check(ff[i])) {
              c = false
            }
          } else {
            ff[i].setAttribute('data-status', 'null')
            c = false
          }
        }
        if (!c) return false
      },
      setEdit (str, title) {
        this.edit = str
        this.title = title
      },
      closeEdit () {
        this.edit = ''
      }
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
          .title{
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
          .title{
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
        .title{
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
      @include position
      @include flex(center)
      background: rgba(0,0,0,.5);
      z-index: 10;
      .form_box{
        position: relative;
        background: $white;
        .close{
          color: $white;
          @include position(-30,auto,auto,10)
          .icon{
            @include block(20,50%)
            background: $white;
            vertical-align: sub;
            &:before,&:after{
              @include position(10,3)
              display: inline-block;
              content:'';
              width:14px;
              height:1px;
              background:$text;
            }
            &:before{
              // top:10px
              transform:rotate(45deg)
            }
            &:after{
              // top:10px
              transform:rotate(-45deg)
            }
          }
          cursor: pointer;
        }
        h2{
          text-align: center;
          background: #f3f9ff;
        }
        .form_content{
          padding:40px 130px;
          @include form
        }
      }
    }
  }
</style>
