<template>
  <div class="mobile_box">
    <h2>一 矿机抢购 一 <router-link to="#">更多矿机 ></router-link></h2>
    <div class="mobile_list_box">
      <mt-swipe :auto="0" :show-indicators="false">
        <mt-swipe-item v-for="d,i in list" @click="goPay(d.product_id||d.id)" :key="i">
          <img :src="d.minerPicture"/>
          <h3>{{d.name}}</h3>
          <h4><b>¥ {{d.one_amount_value}}</b><span class="icon iconfont icon-jinrong"></span></h4>
        </mt-swipe-item>
      </mt-swipe>
      <!-- <div class="item"  @click="goPay(d.product_id||d.id)">
          
          <div class="mobile_info_box">
            <div class="mobile_info">
              
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
        </div> -->
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
  .mobile_box{
    width: 100%;
    height: 410px;
    background: white;
    h2{
      width: 100%;
      position: relative;
      text-align: center;
      font-size: 0.55rem;
      font-weight: 800;
      color: #1b1b1b;
      padding-top: .5rem;
      padding-bottom: 0.5rem;
      a{
        position: absolute;
        right: 0.5rem;
        font-size: 0.4rem;
        color: #999;
        font-weight: 100;
        padding-top: .2rem;
      }
    }
    .mobile_list_box{
      width: 100%;
      height: 308px;
      .mint-swipe-item{
        width: 6rem;
        height: 6.7rem;
        border:1px solid #dddddd;
        float: left;
        margin-right: 20px;
        img{
          width: 100%;
          max-height: 3.8rem;
          object-fit: cover;
        }
        h3{
          width: 100%;
          padding:0 .4rem;
          white-space: nowrap;
          text-overflow: ellipsis;
          overflow: hidden;
          padding-top: 0.4rem;
          box-sizing: border-box;
          font-size: 0.7rem;
        }
        h4{
          color: #fe5039;
          width: 100%;
          padding:0 .4rem;
          box-sizing: border-box;
          font-size: 0.6rem;
          margin-top: 0.3rem;
          span{
            display:inline-block;
            float: right;
            width: 0.9rem;
            height: 0.9rem;
            background: #fe5039;
            color:white;
            border-radius: .1rem;
            font-size: .7rem;
            line-height: 1rem;
            text-align: center;
          }
        }
      }
    }
  }
</style>