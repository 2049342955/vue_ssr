<template>
  <section class="bdcform">
    <div class="property">
      <img src="../../assets/images/beaut.png" style="width:100%;position:absolute;"/>
      <div class="property_top">
        <div class="left">
          <h1>今日获得收益</h1>
          <p>{{computeData.today_hash}} <i>{{hashType[nowEdit]&&hashType[nowEdit].name&&hashType[nowEdit].name.toLowerCase()}}</i></p>
        </div>
        <div class="mobile_select_hash">
          <div class="now_hash" @click="showList">{{hashType[nowEdit]&&hashType[nowEdit].name}}资产<span></span></div>
          <div class="other" v-if="showSelect">
            <div class="item" @click="setList(k)" v-for="n,k in hashType">{{n.name}}资产</div>
          </div>
        </div>
      </div>
      <div class="property_bottom">
        <div class="left" style="border-right:1px solid white;">
          <h1>累积获得收益</h1>
          <p>{{computeData.total_hash}} <i>{{hashType[nowEdit]&&hashType[nowEdit].name&&hashType[nowEdit].name.toLowerCase()}}</i></p>
        </div>
        <div class="left" style="padding-left:1rem;">
          <h1>账户余额</h1>
          <p>{{computeData.balance_account}} <i>{{hashType[nowEdit]&&hashType[nowEdit].name&&hashType[nowEdit].name.toLowerCase()}}</i></p>
        </div>
      </div>
    </div>
    <ul>
      <li v-for="d,k in computeProperty">
        <span>{{d[0]}}</span>
        <i>{{dataProperty[k]}}{{d[1]}}</i>
      </li>
      <li>
        <span>提取收益</span>
      </li>
      <li style="border:0;">
        <span>算力收益图表</span>
      </li>
    </ul>
  </section>
</template>

<script>
  import util from '@/util'
  import api from '@/util/function'
  import { mapState } from 'vuex'
  export default {
    data () {
      return {
        nowEdit: 0,
        computeData: {today_hash: 0, balance_account: 0, total_hash: 0},
        computeProperty: {total_miner: ['已购入云矿机', '台'], total_hash: ['算力总和', 'T'], selled_miner: ['已出售云矿机', '台'], selling_miner: ['出售中云矿机', '台']},
        dataProperty: {total_miner: 0, total_hash: 0, selled_miner: 0, selling_miner: 0},
        GetIncome: [{name: 'product_hash_type', type: 'text', title: '算力类型', edit: 'hashType'}, {name: 'amount', type: 'text', title: '提取额度', placeholder: '请输入提取额度', changeEvent: true, pattern: 'coin', tipsInfo: '余额', tipsUnit: 'hash'}, {name: 'trade_password', type: 'password', title: '交易密码', placeholder: '请输入交易密码', pattern: 'telCode'}],
        showSelect: false
      }
    },
    methods: {
      showList () {
        this.showSelect = !this.showSelect
      },
      setList (n) {
        this.showSelect = false
        this.nowEdit = n
        this.getList()
      },
      getList () {
        var self = this
        var sendData = {token: this.token, user_id: this.user_id, product_hash_type: (this.hashType[this.nowEdit] && this.hashType[this.nowEdit].id) || '1'}
        util.post('myHashAccount', {sign: api.serialize(sendData)}).then(function (res) {
          api.checkAjax(self, res, () => {
            self.computeData = res
          })
        })
        util.post('hashAsset', {sign: api.serialize(sendData)}).then(function (res) {
          api.checkAjax(self, res, () => {
            self.dataProperty = res
          })
        })
      }
    },
    mounted () {
      if (!this.token) {
        this.$router.push({name: 'login'})
      }
      this.getList()
    },
    computed: {
      ...mapState({
        token: state => state.info.token,
        user_id: state => state.info.user_id,
        hashType: state => state.hashType
      })
    }
  }
</script>

<style scoped lang="scss">
@import '../../assets/css/style.scss';
.bdcform{
  background:#f5f5f9;
}
.mobile_header{
  margin-bottom: 0;
}
  select{
    color: white;
    width: 4rem;
    font-size: 0.7rem;
  }
  .property{
    width: 100%;
    overflow: hidden;
    background:white;
    background: #327fff;
    padding-bottom: 0.8rem;
    .property_top{
      width: 100%;
      display: flex;
      padding:0 .5rem;
      box-sizing: border-box;
      justify-content: space-between;
      padding-top: 0.5rem;
      color: white;
      .left p{
         margin-top: 0.15rem;
         font-size: 0.7rem;
      }
      .left i{
        font-weight: 100;
        font-size: 0.5rem;
      }
      .right{
        width: 3.3rem;
        height: 1rem;
        line-height: 0.9rem;
        text-align: center;
        border-radius: 1rem;
        border:1px solid white;
        margin-top: 0.6rem;
      }
      .mobile_select_hash{
        @include position(15,auto,auto,15)
        .now_hash{
          padding:0 5px;
          span{
            @include triangle(bottom)
            margin-left:10px
          }
        }
        .other{
          padding:0 5px;
          background: rgba(12, 90, 220, 0.75);
          color:#eee;
          line-height: 1.8;
          .item{

          }
        }
      }
    }
    .property_bottom{
      width: 100%;
      display: flex;
      padding:0 .5rem;
      box-sizing: border-box;
      justify-content: space-between;
      padding-top: 0.5rem;
      color: white;
      margin-top: 0.8rem;
      .left{
        width: 50%;
      }
      .left p{
         margin-top: 0.15rem;
         font-size: 0.7rem;
      }
      .left i{
        font-weight: 100;
        font-size: 0.5rem;
      }
    }
  }
  ul{
      width: 100%;
      margin-top: 0.5rem;
      overflow: hidden;
      background:white;
      padding:0 .5rem;
      box-sizing: border-box;
      li{
        width: 100%;
        display: flex;
        justify-content: space-between;
        height:2rem;
        border-bottom:1px solid #ddd;
        line-height: 2rem;
        span{
          color: #121212;
          font-size: 0.6rem;
        }
        i{
          color: #999999;
        }
      }
  }
</style>
