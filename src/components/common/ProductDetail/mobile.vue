<template>
  <div class="mobile_product_info">
    <template v-if="$parent.$route.params.type!=='1'">
      <div class="info_ulmobile">
        <div :class="['info_limobile',{'active': $parent.contentShow===k}]" v-for="n,k in $parent.infolists" @click="$parent.tabs(k)">{{n.title}}</div>
      </div>
      <div class="content_itemsmobile">
        <template v-for="n,k in $parent.infolists">
          <div class="content_itemmobile" v-html="mydata[n.name]" v-if="k!==3&&$parent.contentShow===k"></div>
          <div class="content_itemmobile" v-if="k===3&&$parent.contentShow===3">
            <img :src="mydata[n.name]" alt="">
          </div>
        </template>
      </div>
    </template>
    <template v-else>
      <div class="info_ulmobile">
        <div :class="['info_limobile',{'active': $parent.contentShow===m}]" v-for="d,m in $parent.infolist" @click="$parent.tabs(m,d.name)">{{d.title}}</div>
      </div>
      <div class="content_itemsmobile">
        <div class="product_img">
          <div class="pro_name">{{mydata.name}}</div>
          <div class="pro_slogan">{{mydata.miner_list&&mydata.miner_list.slogan}}</div>
          <div class="pro_resume">{{mydata.miner_list&&mydata.miner_list.resume}}</div>
          <img class="pro_img" :src="require('@/assets/images/miner_shop/miner_img.jpg')" alt="">
          <!-- <img class="params_img" :src="mydata.ActivityPicture" alt=""> -->
        </div>
        <div class="content_itemmobile" :id="d.name" v-for="d,m in $parent.infolist">
          <h2 v-if="m!==0">{{d.title}}</h2>
          <div class="content_conmobile" v-html="mydata[d.name]" v-if="d.name!=='MinerAdvantage'"></div>
          <div class="params_tablemobile" v-else>
            <table border="1" cellspacing="0">
              <tr v-for="p,k in $parent.params">
                <td>{{p}}</td>
                <td>{{(mydata.miner_list&&mydata.miner_list[k])||mydata[k]}}</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </template>
  </div>
</template>

<script>
  export default {
    props: {
      detail: {
        type: Object
      }
    },
    data () {
      return {
        mydata: {}
      }
    },
    mounted () {
      this.mydata = this.$parent.$parent.detail
      console.log(this.$parent.$parent.detail)
    }
  }
</script>

<style type="text/css" lang="scss">
  @import '../../../assets/css/style.scss';
  .mobile_product_info{
    position: relative;
    @include main
    margin-top:15px;
    background: white;
    overflow: hidden;
    box-shadow: #dfe0e1 0 5px 5px -3px;
    .info_ulmobile{
      border-bottom:1px solid #e5e5e5;
      width: 100%;
      overflow: hidden;
      height: 2rem;
      display: flex;
      justify-content: space-between;
      padding:0 0.5rem;
      box-sizing: border-box;
      .info_limobile{
        cursor:pointer;
        color:#333333;
        line-height: 2rem;
        font-size: 0.65rem;
        box-sizing: border-box;
        &.active{
          color: #ff721f;
          border-bottom: 2px solid #ff721f;
          box-sizing: border-box;
        }
        &:hover{
          color: #ff721f;
          border-bottom: 2px solid #ff721f;
          box-sizing: border-box;
        }
      }
    }
    .content_itemsmobile{
      position: relative;
      margin:0 0.5rem;
      margin-top:15px;
      box-sizing: border-box;
      padding-bottom:40px;
      .content_itemmobile{
        background: #f7f8fa;
        margin-top: 0.3rem;
        padding-bottom: 0.5rem;
        h2{
          font-weight: bold;
          margin-bottom:10px;
          padding:0 20px;
          text-align: center;
          font-size: 0.7rem;
          padding-top: 0.5rem;
        }
        .params_tablemobile{
          table{
            width:100%;
            border: 1px solid $light_black;
            tr{
              td{
                padding:5px 15px;
                &:nth-child(2){
                  width:70%;
                  text-align: right;
                }
              }
            }
          }
        }
        .content_conmobile{
          width: 100%;
          overflow: hidden;
          padding:0 .3rem;
          padding-top: 10px;
          background: #f7f8fa;
          margin-bottom: 0.2px;
          strong span{
            font-size: 0.8rem !important;
          }
        }
      }
      .product_img{
        position: relative;
        .pro_name,.pro_slogan,.pro_resume{
          @include position(40)
          bottom:auto;
          text-align: center;
          color:#fff
        }
        .pro_name{
          font-size: 0.6rem;
          top:0.5rem;
        }
        .pro_slogan{
          top:1.3rem;
          font-size: 0.9rem;
        }
        .pro_resume{
          top:4rem;
          right:auto;
          padding: 0 0.2rem;
          font-size: 0.5px;
        }
        img{
          &.pro_img{

          }
          // &.params_img{
          //   @include position(480,auto,auto,50)
          //   width:40%;
          //   right:30px !important;
          // }
        }
      }
    }
  }
</style>
