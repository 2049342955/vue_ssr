<template>
  <div class="museum">
    <div class="museum_header">suanLi&nbsp;&nbsp;之家 <span>主流 · 测评 · 博物馆</span></div>
    <div class="museum_content">
      <equipment-left></equipment-left>
       <div class="museum_right">
        <h1>矿机博物馆<span class="icon iconfont icon-dui"></span></h1>
        <div class="museum_lists" v-for="n, k in museum">
          <img :src="n.bigimg"/>
          <div class="museum_content">
            <h6>{{n.title}}</h6>
            <p>{{n.name}}</p>
            <button>查看详情</button>
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
        museum: [{bigimg: require('@/assets/images/kuan.png'), title: '雨刮的关系苏夏按顺序和结束小把戏', name: 'US小把戏股迅速杨旭压缩性手续啊华杯赛瞎写洒下手续年活塞销洒下那思想闹啥心手续啊少女心按顺序潇洒相比较散心加上你下课继续说啊实习就阿森西奥金所炫按顺序'}, {bigimg: require('@/assets/images/kuan.png'), title: '雨刮的关系苏夏按顺序和结束小把戏', name: 'US小把戏股迅速杨旭压缩性手续啊华杯赛瞎写洒下手续年活塞销洒下那思想闹啥心手续啊少女心按顺序潇洒相比较散心加上你下课继续说啊实习就阿森西奥金所炫按顺序'}]
      }
    }
  }
</script>

<style lang="scss" scoped>
  .museum{
    width: 100%;
    min-height: 1562px;
    background: #303849;
    .museum_header{
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
    .museum_content{
      width: 1180px;
      height: 100%;
      margin:0 auto;
      .museum_right{
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
          span{
            font-size: 20px;
            margin-left: 13px;
          }
        }
        .museum_lists{
          width: 100%;
          height: 232px;
          background: white;
          box-shadow: 0 0 10px #c2c2c2;
          margin-top: 20px;
          border-radius: 8px;
          img{
            width:132px;
            height: 170px;
            float: left;
            object-fit: cover;
            margin-left: 48px;
            margin-top: 26px;
          }
          .museum_content{
            width: 79%;
            float: left;
            padding-left: 58px;
            padding-top: 50px;
            h6{
              color: #333333;
              font-size: 22px;
              margin-bottom: 12px;
            }
            p{
              line-height: 22px;
              color: #666666;
              height: 42px;
              overflow: hidden;
              padding-right: 45px;
            }
            button{
              width: 172px;
              height: 38px;
              border:1px solid #bfbfbf;
              background:white;
              color: #a9a9a9;
              margin-top: 27px;
              float: right;
              margin-right: 37px;
              &:hover{
                background:#fe5039;
                color: white;
                border:0;
              }
            }
          }
        }
      }
    }
  }
</style>

