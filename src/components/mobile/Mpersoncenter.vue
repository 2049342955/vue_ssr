<template>
  <div class="personcenter">
    <div class="person_header">
       <img src="../../assets/images/person.png" class="bg"/> 
       <div class="left">
            <div class="img"><img src="../../assets/images/jie.png"/></div>
            <div class="cen">
               <h4>昵称</h4>
               <p>欢迎来到算力网</p>
            </div>
            <div class="right">
               >
            </div>
       </div>
    </div>
    <div class="price">
        <p>账户余额 (元)</p>
        <h4>100.00</h4>
    </div>
    <div class="alllist">
        <router-link to="/mobile/administration" class="route" style="margin-bottom:0.5rem;border-bottom:0;">
            <span class="left">
                <img src="../../assets/images/zhang.png"/>
                账户管理
            </span>
            <img src="../../assets/images/leftjian.png" class="leftjian"/>
        </router-link>
        <router-link to="/mobile/moneyFlow" class="route">
            <span class="left">
                <img src="../../assets/images/liu.png"/>
                资金流水
            </span>
            <img src="../../assets/images/leftjian.png" class="leftjian"/>
        </router-link>
        <router-link to="/mobile/order" class="route">
            <span class="left">
                <img src="../../assets/images/ding.png"/>
                订单管理
            </span>
            <img src="../../assets/images/leftjian.png" class="leftjian"/>
        </router-link> 
        <router-link to="/mobile/help" class="route" style="border-bottom:0;">
            <span class="left">
                <img src="../../assets/images/wen.png"/>
                常见问题
            </span>
            <img src="../../assets/images/leftjian.png" class="leftjian"/>
        </router-link>
    </div>
    <button>退出</button>
  </div>
</template>

<script>
export default {
}
</script>

<style type="text/css" lang="scss">
  .personcenter{
      width:100%;
      height:100vh;
      background:#f4f4f4;
      .person_header{
          width: 100%;
          height: 5rem;
          background:#373d41;
          position: relative;
          .bg{
              width: 100%;
              position: absolute;
              bottom:0;
              left:0;
          }
          .left{
              width: 100%;
              display: flex;
              justify-content: space-between;
              z-index:88;
              position: absolute;
              top:0;
              .img{
                width: 1.8rem;
                height: 1.8rem;
                background: white;
                border-radius: 100%;
                text-align: center;
                line-height: 1.2rem;
                margin-left: 1.5rem;
                margin-top: 1.4rem;
                img{
                  width: 1.2rem;
                  height: auto;
                }
              }
              .cen{
                  margin-top: 1.35rem;
                  position: relative;
                  left:-2rem;
                  h4{
                      color: white;
                      font-size: 0.7rem;
                  }
                  p{
                      color:white;
                  }
              }
              .right{
                  color:white;
                  font-family: "宋体";
                  line-height: 5rem;
                  margin-right: 0.5rem;
              }
          }
      }
      .price{
          width: 100%;
          height: 3rem;
          background:white;
          border-bottom: 1px solid #ddd;
          padding:0.5rem;
          p{
              color: #999;
          }
          h4{
              color: #ff721f;
              font-size: .9rem;
              font-weight: 900;
          }
      }
      .alllist{
          width: 100%;
          .route{
              width: 100%;
              height: 2rem;
              background:white;
              display: flex;
              justify-content: space-between;
              padding:0 .5rem;
              box-sizing: border-box;
              border-bottom:1px solid #ddd;
              line-height: 2rem;
              .left{
                  width: 90%;
                  img{
                      width: 0.8rem;
                      margin-right: 1rem;
                      position: relative;
                      top: -0.6rem;
                  }
              }
              .leftjian{
                  width: 0.3rem;
                  height: 0.5rem;
                  margin-top: 0.8rem;
              }
          }
      }
      button{
          width: 100%;
          height: 2rem;
          line-height: 2rem;
          background:white;
          color:#999;
          border:0;
          margin-top: 0.5rem;
          font-size: 0.7rem;
      }
  }
</style>

