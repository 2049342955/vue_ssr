<template>
  <section class="bdcform" to="#">
    <div class="mobile_header">
      <span class="left">< <em>我的</em></span>
      <span>资金流水</span>
    </div>
    <p>
      <span>资金用途</span>
      <span>金额（元）</span>
    </p>
    <ul>
      <li v-for="n, k in list">
        <span class="left">
          <i>{{n.type_name}}</i>
          <em>{{n.create_time}}</em>
        </span>
        <span :class="['right', {active: n.value<=0}]">{{n.value}}</span>
      </li>
      <Pager :len="len"></Pager>
    </ul>
    <div class="nodata" v-if="show">
      <img :src="img" alt="">
      <p>暂无列表信息</p>
    </div>
  </section>
</template>
<script>
import util from '@/util'
import api from '@/util/function'
import { mapState } from 'vuex'
import Pager from '@/components/common/Pager'
export default {
  components: {
    Pager
  },
  data () {
    return {
      show: false,
      img: require('@/assets/images/no_data.jpg'),
      now: 1,
      len: 0,
      list: []
    }
  },
  mounted () {
    var data = {token: this.token, user_id: this.user_id, page: this.now}
    var sendData = {sort: ''}
    var self = this
    util.post('userCapitalList', {sign: api.serialize(Object.assign(data, sendData))}).then(function (res) {
      api.checkAjax(self, res, () => {
        self.list = res.value_list
        self.show = !res.value_list.length
        if (self.now > 1) return false
        self.len = Math.ceil(res.total_num / 1)
      })
    })
  },
  computed: {
    ...mapState({
      token: state => state.info.token,
      user_id: state => state.info.user_id,
      bank_card: state => state.info.bank_card
    })
  }
}
</script>
<style scoped lang="scss">
.pager .pager_box{
  border-top: 1px solid #ddd !important;
}
.pager{
  padding-top: 20px;
  padding-bottom: 20px;
  box-sizing: border-box;
}
  .bdcform{
    width: 100%;
    height: 100vh;
    background: #f5f5f9;
    p{
      width: 100%;
      display: flex;
      justify-content: space-between;
      padding:0 .5rem;
      color: #999999;
      font-size: 0.6rem;
      padding-bottom:.4rem;
      box-sizing: border-box;
    }
    ul{
      width: 100%;
      overflow: hidden;
      background: white;
      
      li{
        width: 100%;
        height: 100%;
        padding:0 .5rem;
        box-sizing: border-box;
        display: flex;
        justify-content: space-between;
        border-top:1px solid #ddd;
        .left i{
          display: block;
          font-size: .6rem;
          padding-top: .5rem;
        }
        .left em{
          display: block;
          font-size: .45rem;
          padding-top: .3rem;
          color: #a9a9a9;
          font-style: normal;
        }
        .right{
          line-height: 3rem;
          color: #01beb5;
          font-weight: 800;
          font-size: 0.6rem;
          &.active{
            color: red;
          }
        }
      }
    }
  }
</style>