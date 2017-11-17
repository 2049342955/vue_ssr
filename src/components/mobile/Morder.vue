<template>
  <div class="order" style="margin-bottom:60px;">
      <div class="typeclass">
        <div class="one">
          <div class="hash active" @click="hashcli">云矿机<span class="active"></span></div>
          <div class="other_hash" v-show="showtype">
            <div class="hash_center">
              <div  class="item" v-for="n,k in hashType"><span>{{n.unit}}</span><span class="yes">√</span></div>
            </div>
          </div>
        </div>
        <router-link class="one" :to="'/mobile/order/'+ k" v-for="n,k in statustype">
          {{n.title}}
        </router-link>
      </div>
      <div class="listall" v-show="showxie">
          <div class="item" v-for="n,k in lists">
              <p class="top"><span>{{n.miner&&n.miner.name}}</span><em>{{n.created_time}}</em></p>
              <div class="listlist">
                  <div class="listone">
                      <h4 style="color:#ff721f;">{{n.pay_value}}<em> 元</em></h4>
                      <p>购买金额</p>
                  </div>
                  <div class="listone" style="border-left:1px solid #ddd;border-right:1px solid #ddd;">
                      <h4>{{+n.buy_amount * (+n.miner.hash)}}<em> T</em></h4>
                      <p>总算力</p>
                  </div>
                  <div class="listone">
                      <h4>{{n.buy_amount}}<em> 台</em></h4>
                      <p>购买数量</p>
                  </div>
              </div>
              <!-- <div class="orderbutton">
                  <button class="left" @click="clickdetail(n.id)">查看协议</button>
                  <button class="right" @click="getBaoquan(n.id)">查看保全</button>
              </div> -->
          </div>
          <Pager :len="len"></Pager>
      </div>
      <div class="mnodata" v-if="showImg">
        <div class="nodata_img"></div>
        <p style="text-align:center;">暂无列表信息</p>
      </div>
      <div class="contentdetail" style="text-align:center;width:100%;height:100vh;background:white;padding:0 .5rem;box-sizing:border-box;" v-show="!showxie" v-html="contentdetail.content?contentdetail.content:'暂无内容'">
      </div>
  </div>
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
        lists: [],
        now: 1,
        len: 0,
        hashType: [{unit: '云矿机'}, {unit: '算力'}, {unit: '基金'}, {unit: '矿机'}],
        statustype: [{title: '已购买'}, {title: '进行中'}, {title: '已售出'}, {title: '已结束'}],
        showImg: false,
        showxie: true,
        contentdetail: '',
        showtype: false
      }
    },
    methods: {
      hashcli () {
        this.showtype = !this.showtype
      }
      // clickdetail (id) {
      //   var self = this
      //   this.showxie = false
      //   var useid = id
      //   util.post('miner_contract', {sign: api.serialize({token: this.token, user_id: this.user_id, order_id: useid})}).then(function (res) {
      //     api.checkAjax(self, res, () => {
      //       self.contentdetail = res.miner_res
      //     })
      //   })
      // },
      // getBaoquan (id) {
      //   var useid = id
      //   var data = {token: this.token, order_id: useid, security_hash_type: 3, user_id: this.user_id}
      //   var self = this
      //   var newTab = window.open('about:blank')
      //   util.post('getBaoquan', {sign: api.serialize(data)}).then(function (res) {
      //     api.checkAjax(self, res, () => {
      //       newTab.location.href = 'https://www.baoquan.com/attestations/' + res
      //     })
      //   })
      // }
    },
    mounted () {
      var self = this
      util.post('getMinerList', {sign: api.serialize({token: this.token, user_id: this.user_id, page: this.now})}).then(function (res) {
        api.checkAjax(self, res, () => {
          self.lists = res.list.list
          self.showImg = !res.list.list.length
          if (self.now > 1) return false
          self.len = Math.ceil(res.total_num / 15)
        })
      })
    },
    computed: {
      ...mapState({
        token: state => state.info.token,
        user_id: state => state.info.user_id,
        scode: state => state.info.scode
      })
    }
  }
</script>

<style lang="scss">
@import '../../assets/css/style.scss';
  .order{
      width: 100%;
      height: 100vh;
      background: #f4f4f4;
      .typeclass{
        width: 100%;
        height: 2rem;
        line-height: 2rem;
        background: white;
        display: flex;
        justify-content: space-between;
        border-bottom:1px solid #ddd;
        .one{
          width: 20%;
          text-align:center;
          .hash{
            span{
               @include triangle(bottom)
               border-top: 7px solid black;
               margin-left:10px;
               position: relative;
               top:-2px;
               &.active{
                 border-top: 7px solid #327fff;
               }
            }
          }
          .other_hash{
            width: 100%;
            height: 100%;
            position: fixed;
            top:2rem;
            background:rgba(0,0,0,.3);
            .hash_center{
              width: 100%;
              overflow: hidden;
              background: white;
              text-align: left;
              padding-left:0.5rem;
              line-height: 1.5rem;
              .item{
                width: 100%;
                display: flex;
                justify-content: space-between;
                padding-right: 0.5rem;
                .yes{
                  display:none;
                }
              }
              &:hover,&.router-link-active{
                color: #327fff;
              }
            }
          }
          .active{
            color: #327fff;
          }
        }
      }
  }
  .mnodata{
  width: 100%;
  text-align: center;
  height: 100%;
  background:white;
  position: fixed;
  top:0;
  .nodata_img{
    display: inline-block;
    width: 234px;
    height: 215px;
    margin-top: 100px;
    background: url('../../assets/images/css_sprites.png') -335px -10px;
  }
}
.mnodata img{
  width: 130px;
  display: block;
  margin:0 auto;
  margin-top: 140px;
  margin-bottom: 20px;
}
.mnodata p{
  text-align: center !important;
  width: 40% !important;
  margin-left:30%;
}
.pager .pager_box{
  border-top: 1px solid #ddd !important;
}
.pager{
  padding-top: 20px;
  padding-bottom: 20px;
  box-sizing: border-box;
}
  .listall{
      width:100%;
      overflow: hidden;
      .item{
          width: 100%;
          overflow: hidden;
          background:white;
          padding:0 .5rem;
          box-sizing: border-box;
          margin-bottom: 0.5rem;
          .top{
              width: 100%;
              display: flex;
              justify-content: space-between;
              padding:.4rem 0;
              border-bottom: 1px solid #ddd;
              span{
                  color:#121212;
                  font-size: 0.7rem;
              }
              em{
                  color:#999;
                  font-style: normal;
                  font-size: 0.5rem;
              }
          }
          .listlist{
              width: 100%;
              display: flex;
              justify-content: space-between;
              padding:0.8rem 0;
              .listone{
                  width: 33.3%;
                  text-align: center;
                  h4{
                      font-size:0.9rem;
                     em{
                         font-style: normal;
                         font-size: 0.5rem;
                     }
                  }
                  p{
                      color: #999;
                  }
              }
          }
          .orderbutton{
              width: 100%;
              text-align:right;
              padding:0.5rem 0;
              button{
                background: #327fff;
                color: #fff;
                padding: .2rem .5rem;
              }
              .left{
                  margin-right:.5rem;
              }
          }
      }
  }
</style>
