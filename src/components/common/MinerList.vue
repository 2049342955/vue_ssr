<template>
  <div class="millsList">
    <slot></slot>
    <div class="mill">
      <div v-for="n,k in $parent.minerData" class="listmill">
        <router-link :to="'/minerShop/detail/'+ n.id +'/1'">
          <span class="status" v-if="n.status===1">热销中</span>
          <span class="gray" v-if="n.status===3">已下架</span>
          <span class="gray" v-if="n.status===2">已售罄</span>
          <div class="img1">
            <img :src="n.minerPicture"/>
          </div>
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
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    data () {
      return {
        items: {'one_amount_value': {title: '服务器单价', unit: '元'}, 'hash': {title: '算力', unit: 'T'}, 'buyed_amount': {title: '出售总数', unit: '台'}}
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
      .listmill{
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
        position: relative;
        .img1{
          width: 100%;
          height: 180px;
          position: relative;
          img{
            width: 126px;
            height: 81px;
            left: 50%;
            margin-left: -63px;
            object-fit: cover;
            top:64px;
            position: absolute;
          }
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
          position: absolute;
          left: 0;
          left:0;
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
          position: absolute;
          left: 0;
          top:0;
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
