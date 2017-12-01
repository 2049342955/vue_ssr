<template>
  <div class="currency">
    <div class="currency_header">suanLi&nbsp;&nbsp;之家 <span>主流 · 测评 · 博物馆</span></div>
    <div class="currency_content">
      <equipment-left></equipment-left>
       <div class="currency_right">
        <h1>主流币种资料<span class="icon iconfont icon-dui"></span></h1>
        <div class="currency_toplist">
          <div class="toplist" v-for="n, k in toplists">
            <img :src="n.unit"/>
            <span>{{n.name}}</span>
          </div>
        </div>
        <div class="currency_bottomlist">
          <div class="bottomlist" v-for="n, k in bottomlists">
            <img :src="n.unit"/>
            <span>{{n.name}}</span>
          </div>
        </div>
      </div> 
      </div>
    </div>
  </div>
</template>

<script>
  import EquipmentLeft from '@/components/computational/EquipmentLeft'
  export default {
    components: {
      EquipmentLeft
    },
    data () {
      return {
        toplists: [{unit: require('@/assets/images/BDC-2.png'), name: '比特币(Bitcoin)'}, {unit: require('@/assets/images/BDC-2.png'), name: '比特币(Bitcoin)'}],
        bottomlists: [{unit: require('@/assets/images/BDC-2.png'), name: '比特币(Bitcoin)'}, {unit: require('@/assets/images/BDC-2.png'), name: '比特币(Bitcoin)'}]
      }
    }
  }
</script>

<style lang="scss" scoped>
  .currency{
    width: 100%;
    min-height: 1562px;
    background: #303849;
    .currency_header{
      width: 1180px;
      height: 84px;
      line-height: 84px;
      margin:0 auto;
      font-size: 29px;
      color: white;
      font-weight: 800;
      span{
        font-size: 15px;
        color: #999999;
        font-weight: 100;
        margin-left: 20px;
      }
    }
    .currency_content{
      width: 1180px;
      height: 100%;
      margin:0 auto;
      .currency_right{
        float: left;
        width: 1002px;
        height: 1424px;
        background: white;
        padding:32px 62px 0 62px;
        box-sizing: border-box;
        h1{
          color: #121212;
          font-size: 24px;
          font-weight: 800;
        }
      }
    }
  }
</style>

