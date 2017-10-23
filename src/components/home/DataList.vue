<template>
  <div class="cloud_list">
    <h2>
      <span>云矿机推荐</span>
      <span>由保全网提供存证、保全服务</span>
      <router-link to="/cloudCompute/list/1/all">更多云矿机 ></router-link>
    </h2>
    <table>
      <tr>
        <th v-for="n in nav">{{n.title}}</th>
        <th>操作</th>
      </tr>
      <tr v-for="l,i in list">
        <td v-for="v,k in nav">
          <template v-if="k==='name'"><i class="iconfont">&#xe605;</i>{{l[k]}}</template>
          <template v-else>{{l[k]+[v.unit]}}</template>
        </td>
        <td><a href="javascript:;" @click="goPay(l.product_id)">申购</a></td>
      </tr>
    </table>
    <div class="web_tips" ref="tips"></div>
  </div>
</template>

<script>
  import api from '../../util/function'
  import util from '../../util'
  import { mapState } from 'vuex'
  export default {
    name: 'chart',
    data () {
      return {
        nav: {'name': {title: '矿机名称', unit: ''}, 'amount': {title: '总数量', unit: '台'}, 'one_amount_value': {title: '单价', unit: '元'}, 'buy_step_amount': {title: '最小购买单位', unit: '台'}, 'hash': {title: '算力', unit: 'T'}, 'type_name': {title: '算力类型', unit: ''}, 'plan': {title: '项目进度', unit: ''}},
        list: []
      }
    },
    methods: {
      goPay (id) {
        if (this.token === 0) {
          api.tips(this.$refs.tips, '请先登录', () => {
            this.$router.push({name: 'login'})
          })
          return false
        }
        if (!(this.true_name && this.true_name.status === 1)) {
          api.tips(this.$refs.tips, '请先实名认证', () => {
            this.$router.push({name: 'account'})
          })
          return false
        }
        if (this.risk.user_risk_score < 0) {
          api.tips(this.$refs.tips, '请先进行风险测评', () => {
            this.$router.push({name: 'account'})
          })
          return false
        }
        this.$router.push({path: '/cloudCompute/detail/' + id})
      }
    },
    mounted () {
      var self = this
      util.post('product_top_list', {sign: api.serialize({token: this.token, user_id: this.user_id})}).then(function (res) {
        console.log(res)
        self.list = res
      })
    },
    filters: {
      format: api.readable
    },
    computed: {
      ...mapState({
        token: state => state.info.token,
        true_name: state => state.info.true_name,
        risk: state => state.info.risk
      })
    }
  }
</script>

<style type="text/css" lang="scss">
  @import '../../assets/css/style.scss';
  .cloud_list{
    margin-bottom:60px;
    overflow: hidden;
    h2{
      @include flex
      @include gap(15,v,margin);
      @include main
      margin:0 auto;
      span:nth-child(1){
        font-size: 24px;
        font-weight: bold;
      }
      span:nth-child(2){
        margin-left:20px;
        font-size: 16px;
        background: linear-gradient(to right, #b28850, #cfa972);
        color:$white;
        padding:3px 10px
      }
      a{
        font-size: 16px;
        flex:1;
        text-align: right;
        color:#999;
        &:hover{
          color:$blue
        }
      }
    }
    table{
      @include table;
      @include main;
      margin:0 auto;
      th{
        font-size: 18px;
        line-height: 65px;
        background: #ecf3ff
      }
      td{
        font-size: 16px;
        color:$light_text;
        line-height: 75px;
        border-bottom: 1px solid $border;
        .iconfont{
          color:$orange;
          font-size: 24px
        }
      }
      tr:not(:first-child){
        &:hover{
          background: #f4f4f4
        }
        td:nth-child(3),a{
          color:$orange
        }
        td:last-child{
          a{
            width:130px;
            padding:5px 25px;
            border-radius:5px
          }
        }
        &:hover a{
          background:$orange;
          color:$white
        }
      }
    }
  }
</style>