<template>
  <div class="cloud_list">
    <div class="box">
      <h2>
        <div>
          <span>矿机推荐</span>
          <span>全球算力输出服务由保全网提供全流程区块链存证、保全服务</span>
        </div>
        <router-link to="/minerShop/list">更多矿机 ></router-link>
      </h2>
      <table>
        <tr>
          <th v-for="n in nav">{{n.title}}</th>
          <th>操作</th>
        </tr>
        <tr v-for="l,i in list" @click="goPay(l.product_id||l.id)">
          <td v-for="v,k in nav">
            <template v-if="k==='name'"><i class="iconfont">&#xe605;</i>{{l[k]}}</template>
            <!-- <template v-else-if="k==='one_amount_value'">{{+l[k]||'????'}}</template> -->
            <template v-else-if="k==='left_num'">{{l.amount-(l.sell_amount||l.buyed_amount)+v.unit}}</template>
            <template v-else>{{l[k]+[v.unit]}}</template>
          </td>
          <td>
            <!-- <a href="javascript:;">购买</a> -->
             <a class="btn" v-if="l.status===4">预热</a> 
             <a class="btn" v-else-if="l.amount-(l.sell_amount||l.buyed_amount)>0">立即购买</a> 
            <button class="btn" disabled v-else>已售罄</button>
          </td>
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
            <div class="circle sell_progress">
              <template v-if="(((d.amount-d.buyed_amount)/d.amount*100).toFixed(1))<=180">
                  <div class="pie_left"><div class="left"></div></div> 
                 <div class="pie_right"><div class="right"  :style="{transform:'rotate(-'+(((d.amount-d.buyed_amount)/d.amount*100).toFixed(1) * 3.6)+'deg)'}"></div></div> 
              </template>
              <template v-else>
                  <div class="pie_left"><div class="left" :style="{transform:'rotate(-'+((((d.amount-d.buyed_amount)/d.amount*100).toFixed(1) - 180) * 3.6)+'deg)'}"></div></div>   
                  <div class="pie_right"><div class="right" :style="{transform:'rotate('+180+'deg)'}"></div></div>  
              </template>
              <div class="mask"><span>{{((d.amount-d.buyed_amount)/d.amount*100).toFixed(1)}}</span>%</div>
            </div>
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
        list: [],
        index: ''
      }
    },
    methods: {
      goPay (id) {
        this.$router.push({path: '/minerShop/detail/' + id + '/1'})
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
      }).catch(res => {
        console.log(res)
      })
    },
    filters: {
      format: api.readable
    },
    computed: {
      ...mapState({
        token: state => state.info.token,
        true_name: state => state.info.true_name,
        bank_card: state => state.info.bank_card,
        isMobile: state => state.isMobile
      })
    }
  }
</script>

<style type="text/css" lang="scss">
  @import '../../assets/css/style.scss';
  .cloud_list{
    margin:60px 0;
    overflow: hidden;
    .btn{
      border:0;
      width:145px;
      color: $orange;
      text-align: center;
      line-height: 48px;
      border-radius:5px;
      background: transparent;
      &:disabled{
        cursor: no-drop;
        color:$light_black
      }
    }
    .box{
      h2{
        @include data_title
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
        }
      }
    }
    .circle {
			width: 70px;
			height: 70px;
			position: absolute;
			border-radius: 50%;
			background: #e5e5e5;
      text-align:  center;
      box-sizing: border-box;
      border:0;
      border: 2px solid #e5e5e5;
      right: 0.5rem;
      box-sizing: border-box;
      overflow: hidden;
		}
		.pie_left, .pie_right {
			width:70px; 
			height:70px;
			position: absolute;
			top: 0;left: 0;
		}
		.left, .right {
			width:70px; 
			height:70px;
			background:#ffb386;
			border-radius: 50%;
			position: absolute;
			top: 0;
			left: 0;
      box-sizing: border-box;
		}
		.pie_right, .right {
			clip:rect(0,auto,auto,35px);
		}
		.pie_left, .left {
			clip:rect(0,35px,auto,0);
		}
		.mask {
			width: 66px;
			height: 66px;
			border-radius: 50%;
			background: #FFF;
			position: absolute;
			text-align: center;
      left:2px;
      top:2px;
			line-height: 70px;
			font-size: 0.7rem;
      margin: 0 auto;
			color: #ffb386;
      box-sizing: border-box;
		}
    @media screen and (max-width: $mobile) {
      margin:0;
    }
  }
  .cloud_list .mobile_box .mobile_list_box .item .mobile_info_box .sell_progress{
    border:0;
  }
</style>