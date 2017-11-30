<template>
  <div class="cominfor">
    <div class="cominfor_header">
      <div class="cominfor_headercon">
        <div class="cominfo_headerleft">
          <div class="red">
            <h1>算力资讯</h1>
            <p>随时获取最新行业讯息</p>
          </div>
          <div class="olbottom">
            <div v-for="n, k in headerlist" class="ollist">
              <div class="oltitle">{{n.title}}</div>
              <div class="rou">
                  <router-link :to="d.path" v-for="d, m in n.route">{{d.name}}</router-link>
              </div>
            </div>
          </div>
        </div>
        <div class="cominfo_headerright">
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    data () {
      return {
        headerlist: [{
          title: '设备之家',
          route: [{
            name: '矿机测评 >',
            path: '#1'
          }, {
            name: '矿机博物馆 >',
            path: '#2'
          }]
        }, {
          title: '数字货币',
          route: [{
            name: '主流币种 >',
            path: '#3'
          }, {
            name: '数字货币 >',
            path: '#4'
          }]
        }, {
          title: '二手资讯'
        //   route: [{
        //     name: '',
        //     path: ''
        //   }, {
        //     name: '',
        //     path: ''
        //   }]
        }]
      }
    }
  }
</script>

<style lang="scss" scoped>
  @import '../../assets/css/style.scss';
  .cominfor{
    width: 100%;
    height: 100%;
    .cominfor_header{
      width: 100%;
      height: 630px;
      background-image: url('../../assets/images/information.png');
      overflow: hidden;
      background-size: 100% 100%;
      object-fit: cover;
      position: absolute;
      top:0;
      padding-top: 157px;
      .cominfor_headercon{
        width: 1180px;
        margin:0 auto;
        .cominfo_headerleft{
          width: 300px;
          height: 400px;
          background-image: url('../../assets/images/information1.png');
          margin-right: 4px;
          position: relative;
          .red{
            position: absolute;
            width: 296px;
            height: 170px;
            background-image: url('../../assets/images/red.png');
            background-size: 100% 100%;
            left: -15px;
            top:-13px;
            text-align: center;
            h1{
                color: white;
                font-weight: 800;
                font-size: 40px;
                margin-top: 35px;
            }
            p{
                margin-top: 10px;
                color: white;
                font-size: 13px;
                &:after{
                    content:'';
                    @include triangle(right,white)
                    border-top: 5px solid transparent;
                    border-bottom: 5px solid transparent;
                    border-left: 5px solid white;
                    margin-left: 12px;
                }
                &:before{
                    content:'';
                    @include triangle(right,white)
                    border-top: 5px solid transparent;
                    border-bottom: 5px solid transparent;
                    border-left: 5px solid white;
                    margin-left: 12px;
                    transform:rotate(180deg);
                    margin-right: 12px;
                }
            }
          }
          .olbottom{
              padding:0;
              margin:0;
              padding-top: 190px;
              margin-left: 56px;
              .ollist{
                  width: 200px;
                  height: 74px;
                  border-left: 1px solid #535464;
                  margin:0;
                  padding:0;
                  .oltitle{
                      color: #327fff;
                      font-size: 14px;
                      padding-left: 11px;
                      &:before{
                          content: '';
                          width: 6px;
                          height: 6px;
                          background: #bfbfbf;
                          position: absolute;
                          left:54px;
                          border-radius: 100%;
                          margin-top:7px;
                      }
                  }
                  .rou{
                      margin-top: 12px;
                      margin-left: 14px;
                      a{
                          color: white;
                          margin-right: 22px;
                          &:hover{
                              color: #327fff;
                          }
                      }
                  }
                  &:last-child{
                      height: 60px;
                  }
              }
          }
        }
      }
    }
  }
</style>

