<template>
  <section class="transfer_detail">
    <div class="main">
      <Pay v-if="next" page="computeTransfer" :proData="proData2" :proText="proText2"></Pay>
      <Product v-else page="computeTransfer" :proData="proData" :proText="proText"></Product>
    </div>
  </section>
</template>

<script>
  import Pay from '../common/Pay'
  import Product from '../common/Product'
  export default {
    components: {
      Pay, Product
    },
    data () {
      return {
        next: false,
        detail: {title: '阿瓦隆001号', address: '1号楼A区', imgurl: require('@/assets/images/detail_img.jpg'), price: 868, hash: '100.0', num: 6, hashType: 'BTC', income: 0.12441251, electricityFees: 0.12441251, buyType: '转让', incomeType: '每日结算，次日发放', desc: '*  BTC挖矿阿瓦隆001号算力矿机来源嘉楠耘智A741矿机', leftNum: 5, advantage: ['一次购买，全程无忧挖矿，购买后立即享受收益', '算力网提供专业挖矿配件以及后续收益派发服务', '正规矿场运营，国家电力保证矿机7*24小时正常运行', '算力网提供专业技术维护，保证您矿机超长时间挖矿', '用户可收回矿机残值，保证投资收益', '用户可对矿机所有权进行转让'], Protocol: ['算力宝A7 云挖矿合约产品将A7矿机算力拆分成T，以按T销售的模式运作，以提升产品整体的灵活性。', '以下是无忧挖矿六号的合约介绍：', '售 价：        每份合约原价968RMB，其中包含的硬件费用包含矿机设备和矿机配件两部份。现算力宝平台补贴用户100RMB/T，售价868.00RMB/T。', '算力单位：   每份合约代表A7矿机1T的算力。', '电 费：        每份合约功耗为170W，电费为0.40CNY/KWH,其中矿机功耗为150W，电源功耗为20W，合计为170W，每天总电费为1.632CNY。', '算力收益：   合约合作矿池为1hash，1hash选用PPS收益模式，矿池收益当日结算，次日发放。算力收益=挖矿收益-电费。电费按次日16:00的比特币价格从前一天的比特币收益中抵扣。', '停电维护：   每月1号为矿场停电维护时间，当天比特币收益为0，同时也不需交电费。（2017年4月起，停电维护时间改为每月10号）', '停止挖矿：   如果连续10天挖矿收入小于电费，合约终止'], minerImg: [require('@/assets/images/miner1.jpg'), require('@/assets/images/miner2.jpg')], transfer: false},
        proData: {price: {title: '每T算力价格', unit: '元'}, hash: {title: '算力总量', unit: 'T'}, num: {title: '出租时长', unit: '个月'}},
        proText: {hashType: '算力类型', buyType: '购买类型', incomeType: '结算方式'},
        proData2: {title: {title: '矿机名称', unit: ''}, price: {title: '每T算力价格', unit: '元'}, number: {title: '算力总量', unit: 'T'}, income: {title: '今日每T预期收益', unit: 'btc'}, electricityFees: {title: '每日电费约', unit: 'btc'}},
        proText2: {hashType: '算力类型', buyType: '购买类型', incomeType: '结算方式'}
      }
    },
    methods: {
      goPay () {
        this.next = true
      }
    }
  }
</script>
<style type="text/css" lang="scss">
  @import '../../assets/css/style.scss';
  .transfer_detail{
    padding-top: 30px;
    padding-bottom: 110px;
    background: #f7f8fa;
    .main{
      @include main
    }
  }
</style>
