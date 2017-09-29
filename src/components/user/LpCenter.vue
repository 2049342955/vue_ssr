<template>
  <section class="lp_center">
    <h2>LP中心<button @click="open">添加基金</button></h2>
    <h3>电场基金</h3>
    <div class="detail_table">
      <div class="item" v-for="d,k in data">
        <div class="item_title">{{k}}</div>
        <div class="item_value">
          <template v-if="k!=='所在区域'">{{d}}</template>
          <template v-else>{{d}}<span>查看明细</span></template>
        </div>
      </div>
    </div>
    <h3>矿场基金</h3>
    <div class="detail_table">
      <div class="item" v-for="d,k in data">
        <div class="item_title">{{k}}</div>
        <div class="item_value">
          <template v-if="k!=='收益方式' && k!=='服务器类型'">{{d}}</template>
          <template v-else>{{d}}<span>查看明细</span></template>
        </div>
      </div>
    </div>
    <div class="mask" v-if="edit">
      <div class="form_box">
        <div class="close" @click="closeEdit()">
          <span class="icon"></span>
          <span>关闭</span>
        </div>
        <h2>验证S码</h2>
        <form class="form_content" @submit.prevent="submit" novalidate>
          <p>请输入S码绑定算力产业基金</p>
          <!-- <p>算力基金已经结束，请重新输入S码绑定其他基金</p> -->
          <div class="input">
            <span>S码</span>
            <span>*</span>
            <input type="text" name="sCode" autocomplete="off" placeholder="请输入S码" @blur="test" pattern="^[0-9]{9}$" data-status="">
            <span title="请输入11位手机号" tips="请输入S码"></span>
          </div>
          <button>确认提交</button>
        </form>
      </div>
    </div>
  </section>
</template>

<script>
  import doSubmit from '@/util/index'
  import api from '@/util/function'
  export default {
    data () {
      return {
        data: {'算力类型': 'BTC', '购买数量': '100*1台=10台', '购买日期': '2017-09-12 18:00', '购买金额': '10*9000.00=90000.00', '收益方式': '每日结算，次日发放', '总算力': '90T', '服务器类型': '阿瓦隆', '所在区域': ''},
        edit: false
      }
    },
    methods: {
      submit () {
        var data = api.checkFrom(document.querySelector('.form_content'))
        if (!data) return false
        doSubmit('', data).then(res => {
          alert(res)
        })
      },
      open () {
        this.edit = true
        document.body.style.overflow = 'hidden'
      },
      closeEdit () {
        this.edit = false
        document.body.style.overflow = 'auto'
      },
      test (e) {
        api.checkFiled(e.target)
      }
    }
  }
</script>
<style type="text/css" lang="scss">
  @import '../../assets/css/style.scss';
  .lp_center{
    padding:15px;
    h2{
      margin-bottom:15px;
      padding-left:15px;
      button{
        float: right;
        background: $blue;
        color: $white;
        padding:5px 15px;
      }
    }
    .detail_table{
      @include detail
    }
    .mask{
      @include mask
      .form_box{
        h2{
          padding: 10px 25px;
          border-bottom: 1px solid #e8e8e8;
          margin-bottom:0
        }
        .form_content{
          padding:20px 100px;
          @include form(v)
          p{
            margin-bottom:15px
          }
        }
      }
    }
  }
</style>
