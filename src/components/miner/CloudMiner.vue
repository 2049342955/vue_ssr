<template>
  <div class="millsList">
    <slot></slot>
    <ul class="mill">
      <li v-for="n,k in $parent.itemDetail">
        <router-link :to="'/minerShop/detail/'+ n.id +'/1/' + n.name">
          <template v-if="n.status===0">
            <span class="gray">已售馨</span>
          </template>
          <template v-else-if="n.status===1">
            <span class="status">预热中</span>
          </template>
          <img :src="n.minerPicture"/>
          <h6>{{n.name}}</h6>
          <p class="address"><span class="left">{{n.unit?n.unit: 'BitCoin'}}</span><span class="right">{{n.MinerAddress?n.MinerAddress: '未定'}}</span></p>
          <div class="progress_info press">
            <div class="progress_box">
              <div class="box" :style="{width:(n.buyed_amount/n.amount * 100)+'%'}"></div>
            </div>
          </div>
          <div class="items">
            <div class="item" v-for="item,d in items">
              <p class="price">{{n[d]}}{{item.unit}}</p>
              <p class="title">{{item.title}}</p>
            </div>
          </div>
        </router-link>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  props: {
    items: {
      type: Object
    }
  },
  data () {
    return {
    }
  }
}
</script>

<style type="text/css" lang="scss">
  @import '../../assets/css/style.scss';
  .millsList{
    width: 100%;
    overflow: hidden;
    margin:0 auto;
    background: #f6f7f9;
    padding-top: 12px;
    h2{
      @include data_title
    }
    .mill{
      width: 1198px;
      overflow: hidden;
      margin:0 auto;
      li{
        padding:0;
        margin:0;
        width: 280px;
        height: 320px;
        background: white;
        float: left;
        text-align: center;
        margin-bottom: 24px;
        margin-left: 8px;
        margin-right: 11px;
        img{
            width: 126px;
            min-height: 81px;
            height: auto;
            margin-top:34px;
            margin-bottom: 34px;
        }
        .status{
          width: 70px;
          height: 25px;
          display: block;
          text-align: center;
          line-height: 25px;
          background: #ff6458;
          color:white;
          font-size: 12px;
        }
        .gray{
          background: #bfbfbf;
          width: 70px;
          height: 25px;
          display: block;
          text-align: center;
          line-height: 25px;
          color:white;
          font-size: 12px;
        }
        h6{
            font-size: 14px;
            color:#121212;
            padding-left: 20px;
            padding-right: 20px;
            box-sizing: border-box;
            text-align: left;
        }
        .address{
            width: 100%;
            padding:0 20px;
            box-sizing: border-box;
            padding-top: 9px;
            overflow: hidden;
            .left{
                color: #327fff;
                float: left;
                font-size: 12px;
            }
            .right{
                float: right;
                color: #a9a9a9;
                font-size: 12px;
            }
        }
        .press{
            width: 240px;
            height: 5px;
            background: #e3e3e3;
            margin: 0 auto;
            margin-top: 20px;
            .progress_box{
              position: relative;
              overflow:hidden;
              height:100%;
              .box{
                @include position
                background: #32cf99;
              }
            }
        }
        .items{
            width: 100%;
            padding: 0 20px;
            padding-top: 18px;
            .item{
                float: left;
                text-align: center;
                p{
                    margin:0;
                    padding:0;
                }
                .price{
                  height: 20px;
                  font-size: 14px;
                  color: #666666;
                }
                .title{
                    color: #a9a9a9;
                    font-size: 12px;
                }
            }
            :nth-child(1){
                width: 80px;
                height: 30px;      
            }
            :nth-child(2){
                // margin-left:5px;
                // margin-right:5px;
            }
        }
        &:hover{
           box-shadow:#dfe0e1 0 0 30px;
        }
      }
    }
  }
</style>
