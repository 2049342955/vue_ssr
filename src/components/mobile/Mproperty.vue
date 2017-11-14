<template>
  <section class="bdcform">
    <div class="mobile_header">
      <span class="left">< <em>返回</em></span>
      <select>
        <option>BTC资产</option>
      </select>
    </div>
    <div class="property">
      <div class="property_top">
        <div class="left">
          <h1>今日获得收益</h1>
          <p>0.0056485 <i>BTC</i></p>
        </div>
        <div class="right">提取收益</div>
      </div>
      <div class="property_bottom">
        <div class="left" style="border-right:1px solid white;">
          <h1>累积获得收益</h1>
          <p>0.0056485 <i>BTC</i></p>
        </div>
        <div class="left" style="padding-left:1rem;">
          <h1>账户余额</h1>
          <p>0.0056485 <i>BTC</i></p>
        </div>
      </div>
    </div>
    <ul>
      <li>
        <span>购入云矿机</span>
        <i>10.000.00元</i>
      </li>
      <li>
        <span>出售中云矿机</span>
        <i>10.000.00元</i>
      </li>
      <li>
        <span>已出售云矿机</span>
        <i>80.00元</i>
      </li>
      <li>
        <span>算力总和</span>
        <i>10%</i>
      </li>
      <li style="border:0;">
        <span>算力收益图表</span>
      </li>
    </ul>
  </section>
</template>
<script>
export default {
}
</script>
<style scoped lang="scss">
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
    padding:0 .5rem;
    box-sizing: border-box;
    background:white;
    background: #4b98ff;
    padding-bottom: 0.8rem;
    .property_top{
      width: 100%;
      display: flex;
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
    }
    .property_bottom{
      width: 100%;
      display: flex;
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
      li{
        width: 100%;
        display: flex;
        justify-content: space-between;
        height: 1.5rem;
        border-bottom:1px solid #ddd;
        padding:0 .5rem;
        box-sizing: border-box;
        line-height: 1.5rem;
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