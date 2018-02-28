<template>
  <section class="product">
    <div class="pc_box" v-if="isMobile===0">
      <base-frame type="算力服务器" :name="detail.name">
        <base-info :detail="detail" :number="number" @changeNum="changeNum" @checkPay="checkPay"></base-info>
      </base-frame>
      <product-info :detail="detail" :nav="minerInfo"></product-info>
    </div>
    <div class="mobile_box" v-else-if="isMobile===1">
      <mobile-base :detail="detail" :mobileNav="mobileNav"></mobile-base>
      <mobile-product :detail="detail" :nav="minerInfo"></mobile-product>
      <div class="mobile_btn">
        <button disabled v-if="detail.status===7||detail.status===2">立即购买</button>
        <button disabled v-else-if="detail.status===3">产品撤销</button>
        <button disabled v-else-if="detail.status===4">立即购买</button>
        <button @click="checkPay" v-else>立即购买</button>
      </div>
      <mobile-buy :detail="detail" :number="number" @changeNum="changeNum" @goPay="goPay" @closeMask="closeMask" v-if="sheetVisible"></mobile-buy>
    </div>
    <my-mask title="立即认证" :position="maskPosition" @closeMask="closeMask" v-if="mask">
      <opr-select slot="select_opr" :no="0" @closeMask="closeMask"></opr-select>
    </my-mask>
  </section>
</template>

<script>
  import { fetchApiData } from '@/util'
  import api from '@/util/function'
  import { mapState } from 'vuex'
  import BaseFrame from '@/components/product/BaseFrame'
  import BaseInfo from '@/components/miner/BaseInfo'
  import ProductInfo from '@/components/product/ProductInfo'
  import MobileProduct from '@/components/product/MobileProduct'
  import MobileBase from '@/components/product/MobileBase'
  import MobileBuy from '@/components/product/MobileBuy'
  import MyMask from '@/components/common/Mask'
  import OprSelect from '@/components/common/OprSelect'
  export default {
    components: {
      BaseFrame, BaseInfo, ProductInfo, MobileProduct, MobileBase, MobileBuy, MyMask, OprSelect
    },
    data () {
      return {
        detail: {fee: '', product_name: '', name: '', status: 0},
        minerInfo: [
          {name: 'MInerBrief', title: '产品介绍'},
          {name: 'MinerAdvantage', title: '产品参数'},
          {name: 'prProtocolSpeciaification', title: '补充说明'}
        ],
        mobileNav: {
          hash: {title: '服务器算力', unit: 'T'},
          weight: {title: '服务器重量', unit: 'kg'},
          single_limit_amount: {title: '最少购买数量', unit: '台'}
        },
        status: {1: '热销', 2: '已售罄', 3: '产品撤销', 4: '预热'},
        number: 1,
        buyStatus: 0,
        sheetVisible: false,
        mask: false,
        maskPosition: ''
      }
    },
    methods: {
      checkPay () {
        if (!this.detail.amount) {
          api.tips('抱歉，库存不足')
          return false
        }
        var startTime = this.detail.sell_start_time
        var now = Date.parse(new Date()) / 1000
        if (now < startTime) {
          api.tips('暂未开售，开售时间为：' + api.date(new Date(startTime * 1000)))
          return false
        }
        if (!this.token) {
          this.$store.commit('SET_URL', this.$route.path)
          this.$router.push({name: 'auth-login'})
          this.$store.commit('LOGOUT')
          return false
        }
        if (!(this.true_name && this.true_name.status === 1)) {
          this.mask = true
          this.maskPosition = 'middle'
          return false
        }
        if (this.isMobile) {
          this.openMask()
        } else {
          this.goPay()
        }
      },
      openMask () {
        if (this.detail.status !== 1) {
          return false
        }
        document.body.style.overflow = 'hidden'
        window.scroll(0, 0)
        this.sheetVisible = true
      },
      closeMask (e) {
        document.body.style.overflow = 'auto'
        this.sheetVisible = false
        this.mask = false
      },
      goPay () {
        if (this.number < 1) {
          api.tips('请输入或添加至少1台算力服务器')
          return false
        }
        if (this.buyStatus !== 0) {
          return false
        }
        let data = {
          name: this.detail.product_name,
          one_amount_value: this.detail.one_amount_value || '',
          number: this.number || '',
          hash: this.detail.hash || '',
          hashType: this.detail.hashType || '',
          output: this.detail.output || '',
          total_electric_fee: this.detail.total_electric_fee || '',
          batch_area: this.detail.batch_area || '',
          img: this.detail.minerPicture
        }
        api.setStorge('info', data)
        this.$router.push({path: 'miner/pay'})
      },
      changeNum (n) {
        n = +n
        if (isNaN(n)) {
          this.buyStatus = 2
          api.tips('抱歉，输入有误', () => {
            this.buyStatus = 0
          })
        } else {
          if (this.detail.leftNum === 0) return false
          var minNum = +this.detail.single_limit_amount
          var isOver = n > this.detail.leftNum
          if (isOver) {
            this.buyStatus = 1
            api.tips('抱歉，您输入的数量超出库存', () => {
              this.buyStatus = 0
            })
          }
          this.number = n < minNum ? minNum : isOver ? this.detail.leftNum : n
        }
        document.querySelector('#number').value = this.number
      },
      getData () {
        let data = {token: this.token, miner_id: this.$route.params.id}
        fetchApiData(this, 'miner_detail', data, (res) => {
          this.detail.leftNum = res.amount - res.buyed_amount
          this.detail = Object.assign(this.detail, res)
          this.detail.single_limit_amount = parseInt(this.detail.single_limit_amount) || 1
          this.detail.sellProgress = ((+this.detail.buyed_amount) / this.detail.amount * 100).toFixed(0) + '%'
          this.number = this.detail.single_limit_amount
          this.detail.name = res.name
          this.detail = Object.assign(this.detail, res.miner_list)
          this.detail.weight = (res.miner_list && res.miner_list.weight) || ''
          this.detail.statusStr = this.status[res.status]
        })
      }
    },
    mounted () {
      this.getData()
    },
    computed: {
      ...mapState({
        token: state => state.info.token,
        true_name: state => state.info.true_name,
        isMobile: state => state.isMobile,
        addressObj: state => state.addressData
      })
    }
  }
</script>

<style type="text/css" lang="scss">
  .product{
    background: #f7f8fa;
    .mobile_box{
      min-height: calc(100vh - 0.88rem);
      padding-bottom: 57px;
      .popup{
        .buy_box{
          font-size: 16px;
          .buy_text{
            @include flex(space-between)
            border-bottom: 1px solid $border;
            margin: 0 15px;
            padding: 10px 0;
            .input_box{
              width:160px;
              line-height: 30px;
              border:1px solid $border;
              @include flex
              span{
                width:30%;
                font-size: 22px;
                text-align: center;
                color: #c5c5c5;
                &.active {
                  color:$light_text;
                }
              }
              input{
                width:40%;
                border-left: 1px solid $border;
                border-right: 1px solid $border;
                line-height: 30px;
                text-align: center;
              }
            }
            &.last{
              .item:last-child{
                color: $orange;
              }
            }
            .icon_loan {
              label {
                input {
                  @include checkbox
                }
                & + label {
                  margin-left: 0.5rem
                }
              }
            }
          }
          .mobile_btn{
            position: relative;
            border: 0;
            padding: 15px;
            button{
              background: transparent;
              color: $blue;
              border: 1px solid $blue;
            }
          }
        }
      }
      .mobile_btn{
        @include mobile_footer_btn
      }
    }
    .detail_limit_text{
      font-size: 12px;
      color:$light_black;
    }
  }
</style>