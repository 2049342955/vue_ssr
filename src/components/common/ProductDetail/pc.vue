<template>
  <div class="pc_product_info">
    <template v-if="$parent.$route.params.type!=='1'">
      <div class="info_ul">
        <div :class="['info_li',{'active': $parent.contentShow===k}]" v-for="n,k in $parent.infolists" @click="$parent.tabs(k)">{{n.title}}</div>
      </div>
      <div class="content_items">
        <template v-for="n,k in $parent.infolists">
          <div class="content_item" v-html="mydata[n.name]" v-if="k!==3&&$parent.contentShow===k"></div>
          <div class="content_item" v-if="k===3&&$parent.contentShow===3">
            <img :src="mydata[n.name]" alt="">
          </div>
        </template>
      </div>
    </template>
    <template v-else>
      <div class="info_ul">
        <div :class="['info_li',{'active': $parent.contentShow===m}]" v-for="d,m in $parent.infolist" @click="$parent.tabs(m,d.name)">{{d.title}}</div>
      </div>
      <div class="content_items">
        <div class="product_img">
          <div class="pro_name">{{mydata.name}}</div>
          <div class="pro_slogan">{{mydata.miner_list&&mydata.miner_list.slogan}}</div>
          <div class="pro_resume">{{mydata.miner_list&&mydata.miner_list.resume}}</div>
          <img class="pro_img" :src="require('@/assets/images/miner_shop/miner_img.jpg')" alt="">
          <img class="params_img" :src="mydata.ActivityPicture" alt="">
        </div>
        <div class="content_item" :id="d.name" v-for="d,m in $parent.infolist">
          <h2 v-if="m!==0">{{d.title}}</h2>
          <div class="content_con" v-html="mydata[d.name]" v-if="d.name!=='MinerAdvantage'"></div>
          <div class="params_table" v-else>
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
  .pc_product_info{
    position: relative;
    @include main
    margin-top:90px;
    background: white;
    overflow: hidden;
    padding:0 98px;
    box-sizing: border-box;
    box-shadow: #dfe0e1 0 5px 5px -3px;
    .info_ul{
      border-bottom:1px solid #e5e5e5;
      width: 100%;
      overflow: hidden;
      .info_li{
        cursor:pointer;
        float: left;
        width: 75px;
        color:#333333;
        margin-right: 50px;
        font-size: 18px;
        height: 50px;
        padding-top: 12px;
        padding-bottom: 12px;
        box-sizing: border-box;
        &.active{
          color: #327fff;
          border-bottom: 2px solid #327fff;
          box-sizing: border-box;
        }
        &:hover{
          color: #327fff;
          border-bottom: 2px solid #327fff;
          box-sizing: border-box;
        }
      }
    }
    .content_items{
      position: relative;
      margin:15px 0 40px 0;
      padding-bottom:40px;
      background: #DDDFEB;
      .content_item{
        padding-top:20px;
        h2{
          font-weight: bold;
          margin-bottom:20px;
          padding:0 20px;
        }
        .params_table{
          margin:0 20px;
          margin-bottom:20px;
          box-shadow: #9a9a9a -4px 0 5px -3px;
          table{
            width:70%;
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
        .content_con img{
          margin-bottom:30px;
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
          font-size: 36px;
        }
        .pro_slogan{
          top:24%;
          font-size: 50px;
        }
        .pro_resume{
          top:80%;
          left:20%;
          width:60%;
          right:auto;
          font-size: 18px;
        }
        img{
          &.pro_img{

          }
          &.params_img{
            @include position(480,auto,auto,50)
            width:40%;
          }
        }
      }
    }
  }
</style>
