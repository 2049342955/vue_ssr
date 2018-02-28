<template>
  <section class="product">
    <div class="pc_box" v-if="isMobile===0">
      <base-frame type="云算力" :name="detail.name">
        <BaseInfo :detail="detail" :number="number" @changeNum="changeNum" @checkPay="checkPay"></BaseInfo>
      </base-frame>
      <ProductInfo :detail="detail" :nav="cloudInfo"></ProductInfo>
    </div>
    <div class="mobile_box" v-else-if="isMobile===1">
      <MobileBase :detail="detail" :mobileNav="mobileNav"></MobileBase>
      <MobileProduct :detail="detail" :nav="cloudInfo"></MobileProduct>
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
  import BaseInfo from '@/components/cloudCompute/BaseInfo'
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
        detail: {incomeType: '每日结算，隔日发放', fee: '', product_name: '', name: '', status: 0},
        cloudInfo: [
          {name: 'machine_advantage', title: '产品优势'},
          {name: 'machine_intro', title: '产品参数'},
          {name: 'machine_agreement', title: '协议说明'},
          {name: 'product_photos', title: 'BDC中心相册'}
        ],
        mobileNav: {
          hash_income: {title: '预计每日收益', unit: '元'},
          one_amount_value: {title: '每台价格', unit: '元'},
          hash: {title: '每台算力', unit: 'T'}
        },
        status: {4: '预热', 5: '可售', 7: '已售馨', 10: '活动'},
        number: 1,
        buyStatus: 0,
        sheetVisible: false,
        mask: false,
        maskPosition: ''
      }
    },
    methods: {
      checkPay (isLoan) {
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
          this.$router.push({name: 'login'})
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
          this.goPay(isLoan)
        }
      },
      openMask () {
        if (this.detail.status !== 5 && this.detail.status !== 10) {
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
      goPay (isLoan) {
        let loanEle = document.querySelector('#isLoan1')
        if (loanEle && loanEle.checked) {
          isLoan = true
        }
        if (this.number < 1) {
          api.tips('请输入或添加至少1台算力服务器')
          return false
        }
        if (this.buyStatus !== 0) {
          return false
        }
        let data = {
          id: this.$route.params.id,
          name: this.detail.name,
          one_amount_value: this.detail.one_amount_value || '',
          number: this.number || '',
          hash: this.detail.hash || '',
          hashType: this.detail.hashType || '',
          incomeType: this.detail.incomeType || '',
          output: this.detail.output || '',
          total_electric_fee: this.detail.total_electric_fee || '',
          batch_area: this.detail.batch_area || '',
          isLoan: isLoan,
          img: this.detail.product_img,
          bdc_id: this.detail.bdc_message_id
        }
        api.setStorge('info', data)
        if (isLoan && this.isMobile) {
          this.$router.push({path: '/cloudCompute/hirePurchase'})
        } else {
          this.$router.push({path: '/cloudCompute/pay'})
        }
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
        let data = {token: this.token, product_id: this.$route.params.id}
        fetchApiData(this, 'productDetail', data, (res) => {
          this.detail.leftNum = res.amount - res.buyed_amount
          this.detail = Object.assign(this.detail, res)
          this.detail.single_limit_amount = parseInt(this.detail.single_limit_amount) || 1
          this.detail.sellProgress = ((+this.detail.buyed_amount) / this.detail.amount * 100).toFixed(0) + '%'
          this.number = this.detail.single_limit_amount
          this.detail = Object.assign(this.detail, res.has_product_miner_base)
          this.detail.name = res.product_name
          this.detail.hashType = (res.hashtype && res.hashtype.name) || ''
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