<template>
  <div class="cloud_list">
    <div class="box">
      <h2>
        <div>
          <span>矿机推荐</span>
          <span>全球算力输出服务由保全网提供全流程区块链存证、保全服务</span>
        </div>
        <router-link to="/cloudCompute/list/1/all">更多云矿机 ></router-link>
      </h2>
      <table>
        <tr>
          <th v-for="n in nav">{{n.title}}</th>
          <th>操作</th>
        </tr>
        <tr v-for="l,i in list" @click="goPay(l.product_id||l.id)">
          <td v-for="v,k in nav">
            <template v-if="k==='name'"><i class="iconfont">&#xe605;</i>{{l[k]}}</template>
            <template v-else-if="k==='left_num'">{{l.amount-(l.sell_amount||l.buyed_amount)+v.unit}}</template>
            <template v-else>{{l[k]+[v.unit]}}</template>
          </td>
          <td><a href="javascript:;">购买</a></td>
        </tr>
      </table>
    </div>
    <div class="mobile_box">
      <h2>矿机推荐</h2>
      <div class="mobile_list_box">
        <div class="item" v-for="d,i in list" @click="goPay(d.product_id||d.id)">
          <h3>{{d.name}}</h3>
          <div class="mobile_info_box">
            <div class="mobile_info">
              <h4>每台服务器价格<span><b>{{d.one_amount_value}}</b>元</span></h4>
              <div class="mobile_text">
                <div class="mobile_text_item">每台算力<b>{{d.hash}}T</b></div>
                <div class="mobile_text_item">剩余可售<b>{{d.amount-(d.sell_amount||d.buyed_amount)}}台</b></div>
              </div>
            </div>
            <div class="sell_progress">{{((d.amount-d.buyed_amount)/d.amount*100).toFixed(1)+"%"}}</div>
            <!-- <div id="progress"><span></span></div> -->
          </div>
        </div>
      </div>
    </div>
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
        // nav: {'name': {title: '矿机名称', unit: ''}, 'amount': {title: '总数量', unit: '台'}, 'one_amount_value': {title: '单价', unit: '元'}, 'buy_step_amount': {title: '最小购买单位', unit: '台'}, 'hash': {title: '算力', unit: 'T'}, 'type_name': {title: '算力类型', unit: ''}, 'plan': {title: '项目进度', unit: ''}},
        nav: {'name': {title: '矿机名称', unit: ''}, 'amount': {title: '总数量', unit: '台'}, 'one_amount_value': {title: '单价', unit: '元'}, 'hash': {title: '算力', unit: 'T'}, 'left_num': {title: '剩余数量', unit: '台'}},
        list: []
      }
    },
    methods: {
      goPay (id) {
        if (this.token === 0) {
          api.tips('请先登录', () => {
            this.$router.push({name: 'login'})
          })
          return false
        }
        if (!(this.true_name && this.true_name.status === 1)) {
          api.tips('请先实名认证', () => {
            // console.log(api.checkEquipment)
            if (this.$route.path.includes('mHome')) {
              this.$router.push({name: 'madministration'})
            } else {
              this.$router.push({name: 'account'})
            }
          })
          return false
        }
        if (!(this.bank_card && this.bank_card.status === 1)) {
          api.tips('请先绑定银行卡', () => {
            // console.log(api.checkEquipment)
            if (this.$route.path.includes('mHome')) {
              this.$router.push({name: 'madministration'})
            } else {
              this.$router.push({name: 'account'})
            }
          })
          return false
        }
        this.$router.push({path: '/cloudCompute/detail/' + id + '/1'})
        // this.$router.push({name: 'activity'})
      }
    },
    mounted () {
      var self = this
      // util.post('product_top_list', {sign: api.serialize({token: this.token})}).then(function (res) {
      //   api.checkAjax(self, res, () => {
      //     self.list = res
      //   })
      // })
      util.post('showTopMiner', {sign: api.serialize({token: this.token})}).then(function (res) {
        api.checkAjax(self, res, () => {
          self.list = res
        })
      })
    },
    filters: {
      format: api.readable
    },
    computed: {
      ...mapState({
        token: state => state.info.token,
        true_name: state => state.info.true_name,
        bank_card: state => state.info.bank_card
      })
    }
  }
</script>

<style type="text/css" lang="scss">
  @import '../../assets/css/style.scss';
  .cloud_list{
    margin:60px 0;
    overflow: hidden;
    .box{
      h2{
        @include flex(space-between)
        @include gap(15,v,margin);
        @include main
        position: relative;
        top: -20px;
        span:nth-child(1){
          font-size: 24px;
          font-weight: bold;
        }
        span:nth-child(2){
          width:452px;
          height:27px;
          margin-left:20px;
          font-size: 16px;
          background: linear-gradient(to right, #b28850, #cfa972);
          filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#b28850', endColorstr='#cfa972',GradientType=1 );
          color:$white;
          padding:3px 10px
        }
        a{
          font-size: 16px;
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
          cursor: pointer;
          &:hover{
            background: #ecf3ff;
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
      @include mobile_hide
    }
    .mobile_box{
      @include mobile_show
      h2{
        font-size: 18px;
        padding:10px 15px;
        background: #fff;
        &:before{
          content:'|';
          color:$blue;
          font-weight: bold;
          margin-right:5px
        }
      }
      .mobile_list_box{
        .item{
          background: #fff;
          @include mobile_data
          &:not(:last-child){
            margin-bottom:10px;
          }
          // #progress{
          //   width: 50%;
          //   height: 30px;
          //   border:1px solid #ccc;
          //   border-radius: 15px;
          //   margin: 50px 0 0 100px;
          //   overflow: hidden;
          //   box-shadow: 0 0 5px 0px #ddd inset;
          //   span{
          //     display: inline-block;
          //     width: 100%;
          //     height: 100%;
          //     background: #2989d8; /* Old browsers */
          //     background: -moz-linear-gradient(45deg, #2989d8 33%, #7db9e8 34%, #7db9e8 59%, #2989d8 60%); /* FF3.6+ */
          //     background: -webkit-gradient(linear, left bottom, right top, color-stop(33%,#2989d8), color-stop(34%,#7db9e8), color-stop(59%,#7db9e8), color-stop(60%,#2989d8)); /* Chrome,Safari4+ */
          //     background: -webkit-linear-gradient(45deg, #2989d8 33%,#7db9e8 34%,#7db9e8 59%,#2989d8 60%); /* Chrome10+,Safari5.1+ */
          //     background: -o-linear-gradient(45deg, #2989d8 33%,#7db9e8 34%,#7db9e8 59%,#2989d8 60%); /* Opera 11.10+ */
          //     background: -ms-linear-gradient(45deg, #2989d8 33%,#7db9e8 34%,#7db9e8 59%,#2989d8 60%); /* IE10+ */
          //     background: linear-gradient(45deg, #2989d8 33%,#7db9e8 34%,#7db9e8 59%,#2989d8 60%); /* W3C */
          //     filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#2989d8', endColorstr='#2989d8',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
          //     background-size: 60px 30px;
          //     text-align: center;
          //     color:#fff;
          //     -webkit-animation:load 3s ease-in;
          //   }
          //   @-webkit-keyframes load{
          //     0%{
          //       width: 0%;
          //     }
          //     100%{
          //       width:100%;
          //     }
          //   }
          // }
        }
      }
    }
    @media screen and (max-width: $mobile) {
      margin:0;
    }
  }
</style>