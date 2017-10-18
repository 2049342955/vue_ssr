<template>
  <section class="product_list">
    <div class="box">
      <Sort :page="page" :sort="sort"></Sort>
      <div class="data">
        <div class="item" v-for="d,k in $parent.computeDate">
          <h3>{{page==='computeTransfer'?d.product_name:d.name}}<span :class="'icon_currency '+d.hashtype.name"></span></h3>
          <div class="info_box">
            <template v-for="n,i in dataNav">
              <div class="info" v-if="i==='leftNum'">
                <div class="text">
                  <span class="num">{{d.amount-d.buyed_amount}}</span>
                  <span>{{n.unit}}</span>
                </div>
                <p>{{n.title}}</p>
              </div>
              <div class="info" v-else>
                <div class="text">
                  <span class="num">{{d[i]}}</span>
                  <span>{{n.unit}}</span>
                </div>
                <p>{{n.title}}</p>
              </div>
              <div class="line"></div>
            </template>
            <div class="btn" @click="goPay(d.id)">立即购买</div>
          </div>
        </div>
      </div>
    </div>
    <div class="web_tips" ref="tips"></div>
  </section>
</template>

<script>
  import { mapState } from 'vuex'
  import api from '@/util/function'
  import Sort from '@/components/common/Sort'
  export default {
    components: {
      Sort
    },
    props: {
      sort: {
        type: Array
      },
      dataNav: {
        type: Object
      },
      page: {
        type: String
      }
    },
    data () {
      return {
        edit: -1
      }
    },
    methods: {
      goPay (id) {
        if (this.token === 0) {
          api.tips(this.$refs.tips, '请先登录', () => {
            this.$router.push({name: 'login'})
          })
          return false
        }
        if (!(this.true_name && this.true_name.status === 1)) {
          api.tips(this.$refs.tips, '请先实名认证', () => {
            this.$router.push({name: 'account'})
          })
          return false
        }
        if (this.risk.user_risk_score < 0) {
          api.tips(this.$refs.tips, '请先进行风险测评', () => {
            this.$router.push({name: 'account'})
          })
          return false
        }
        this.$router.push({path: '/' + this.page + '/detail/' + id})
      }
    },
    computed: {
      ...mapState({
        token: state => state.info.token,
        true_name: state => state.info.true_name,
        risk: state => state.info.risk
      })
    }
  }
</script>

<style type="text/css" lang="scss">
  @import '../../assets/css/style.scss';
  .product_list{
    margin-top:-20px;
    background: #f7f8fa;
    padding-top:50px;
    padding-bottom:50px;
    .box{
      @include main
      .data{
        .item{
          padding:30px 50px;
          background: $white;
          h3{
            font-size: 18px;
            margin-bottom:10px;
            .icon_currency{
              margin-left:5px;
            }
          }
          .info_box{
            @include flex(space-between)
            .info{
              .text .num{
                font-size: 24px;
              }
              &:first-child{
                .text{
                  color: $orange
                }
              }
              p{
                color: $light_black;
              }
            }
            .line{
              width:1px;
              height: 50px;
              background: $border
            }
            .btn{
              width:145px;
              color: $orange;
              text-align: center;
              line-height: 48px;
              border-radius:5px;
            }
          }
          &:not(:last-child){
            margin-bottom:10px;
          }
          &:hover{
            background: #f4f4f4;
            .btn{
              @include button($orange)
              cursor: pointer;
            }
          }
        }
      }
    }
  }
</style>
