<template>
  <section class="active">
    <img :src="img1"/>
    <div class="body">
       <h1>标题</h1>
       <div class="side">
          <ul>
              <li v-for="n, k in data">
                  <p class="price"><em>1180</em> {{n.unit}}</p>
                  <p class="title">{{n.title}}</p>
              </li>
          </ul>
          <div class="bottom">
              <div class="one" style="margin-bottom:1rem;">
                  <span class="title">购买数量</span>
                  <span class="flex">
                      <span class="aes">-</span>
                      <input type="number" value="1" class="number"/>
                      <span class="desc">+</span>
                  </span>
              </div>
              <div class="one">
                  <span class="title">购买算力</span>
                  <span class="price">45T</span>
              </div>
              <div class="one">
                  <span class="title">支付金额</span>
                  <span class="price">56000元</span>
              </div>
          </div>
       </div>
       <button class="submit">立即支付</button>
       <p class="radio"><input type="checkbox"/>阅读并同意 <span>《云算力购买协议》</span> <span>《矿机托管协议》</span></p>
       <img src="../../assets/images/data.png" class="imagesall"/>
       <img src="../../assets/images/logo.png" class="logo"/>
       <p class="tel">咨询电话： 0571-28031736</p>
    </div>
  </section>
</template>
<script>
export default {
  data () {
    return {
      img1: require('@/assets/images/5.png'),
      data: [{title: '算力服务器价格', unit: '元/台'}, {title: '服务器算力', unit: 'T'}, {title: '剩余总量', unit: '台'}]
    }
  }
}
</script>
<style scoped lang="scss">
    .body{
        width: 100%;
        overflow: hidden;
        background: #151136;
        h1{
            width: 100%;
            color: white;
            font-size: 0.7rem;
            text-align: center;
            margin-top: 0.5rem;
            margin-bottom: 0.5rem;
        }
        .side{
            width: 96%;
            margin-left: 2%;
            overflow: hidden;
            background: url('../../assets/images/4.png') no-repeat;
            background-size: 100% 100%;
            padding:0 .3rem;
            box-sizing: border-box;
            padding-bottom: 0.5rem;
            ul{
                width: 100%;
                display: flex;
                justify-content: space-between;
                padding-top: 0.5rem;
                border-bottom: 1px dashed white;
                padding-bottom: 0.7rem;
                li{
                    width:  33.3%;
                    text-align: center;
                    .price{
                        color: #fede00;
                        font-size: 0.5rem;
                        em{
                            font-style: normal;
                            font-size: 0.7rem;
                            font-weight: 800;
                        }
                    }
                    .title{
                        font-size: 0.5rem;
                        color: white;
                        padding-top: 0.1rem;
                    }
                }
            }
             .bottom{
                padding-top: 1rem;
                .one{
                    width: 100%;
                    padding: 0 0.5rem;
                    display: flex;
                    justify-content: space-between;
                    margin-bottom: .5rem;
                    .title{
                        font-size: 0.6rem;
                    }
                    .price{
                        color: #fede00;
                        font-size: 0.6rem;
                    }
                    span{
                        color:white;
                        &.flex{
                        display: flex;
                        justify-content: space-between;
                        .number{
                            width: 3rem;
                            height: 1rem;
                            background: white;
                            text-align: center;
                            line-height: 1rem;
                        }
                        .aes{
                            width: 1.2rem;
                            height: 1rem;
                            border-top-left-radius: .1rem;
                            border-bottom-left-radius: .1rem;
                            text-align: center;
                            color:#666666;
                            background: #e5e5e5;
                            font-weight: 800;
                            font-size: 0.8rem;
                            line-height: 1rem;
                        }
                        .desc{
                            width: 1.2rem;
                            height: 1rem;
                            border-top-right-radius: .1rem;
                            border-bottom-right-radius: .1rem;
                            text-align: center;
                            color:#666666;
                            background: #e5e5e5;
                            font-weight: 800;
                            font-size: 0.8rem;
                            line-height: 1rem;
                        }
                        }
                    }
                }
            }
        }
        .submit{
            width: 94%;
            height: 1.8rem;
            background: url('../../assets/images/1.png');
            background-size: 100% 100%;
            margin-top: 1rem;
            margin-left: 3%;
            color:white;
            border:0;
        }
        .radio{
            color: white;
            font-size: 0.5rem;
            width: 100%;
            text-align: center;
            margin-top: 0.5rem;
            input{
                width: 0.6rem;
                background: white;
                height: 0.6rem;
                border-radius: .1rem;
                margin-right: .2rem;
                position: relative;
                top: .1rem;
            }
        }
        .imagesall{
            width: 94%;
            margin-left: 3%;
            margin-top: 2rem;
        }
        .logo{
            width: 30%;
            margin-left: 35%;
            margin-top: 1.5rem;
        }
        .tel{
            width: 100%;
            color: white;
            text-align: center;
            margin-top: 0.5rem;
            margin-bottom: 1rem;
        }
    }
</style>