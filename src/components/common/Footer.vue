<template>
  <footer class="footer" v-if="!$route.path.includes('auth')" :disabled="$route.name==='notFound'">
    <div class="box">
      <div class="box_foot">
        <aside>
          <h4>联系我们</h4>
          <h3>杭州总部</h3>
          <p style="margin-bottom:10px;">咨询电话：<span class="active">0571-28221076</span>工作日（9:00~18:00）</p>
          <p style="margin-bottom:10px;">客服邮箱：V@suanLi.com</p>
          <p style="margin-bottom:10px;">公司地址：浙江省杭州市学院路77号黄龙国际中心G座-907</p>
        </aside>
        <aside>
          <div class="help_support">
            <router-link :to="l" v-for="l,k in link" :key="k">{{k}}</router-link>
          </div>
          <div class="service">
            <h4>产品及服务</h4>
            <router-link :to="s" v-for="s,k in service" :key="k">{{k}}</router-link>
          </div>
          <div class="copyright">
            <div class="copyright_img"></div>
            <p class="copyright_text">Copyright © 2013-2017 Zhejiang Shuqin Technology Co., Ltd. All Rights Reserved. 算力网 版权所有</p>
          </div>
        </aside>
        <div class="follow">
          <h4>关注我们</h4>
          <router-link :to="i" v-for="i,k in info" :key="k">{{k}}</router-link>
          <div class="outside">
            <div class="qrcode"></div>
          </div>
          <div class="active">最新区块链资讯</div>
        </div>
      </div>
      <div class="partner">
        <span>友情<br>链接</span>
        <div>
          <a :href="p.FriendlyLink_address" target="_blank" v-for="p,k in partner" :key="k">{{p.FriendlyLink_name}}</a>
        </div>
      </div>
    </div>
  </footer>
</template>

<script>
  import util from '../../util'
  export default {
    data () {
      return {
        // link: {'关于我们': '/webInfo/aboutUs', '安全保障': '/webInfo/safeGuarantee', '法律声明': '/webInfo/lawyer', '常见问题': '/webInfo/issues'},
        link: {'关于我们': '/webInfo/aboutUs', '常见问题': '/webInfo/issues'},
        service: {'算力商城': '/cloudCompute/list/1/all', '算力转让': '/computeTransfer/list/1/all', '算力托管': '/bdc/list', '算力资讯': '/webInfo/list/news'},
        partner: [],
        info: {'网站动态': '/webInfo/list/website', '产品公告': '/webInfo/list/product'}
      }
    },
    created () {
      var self = this
      util.post('friendlinkList', {sign: 'token=0'}).then(function (res) {
        self.partner = res
      })
    }
  }
</script>

<style type="text/css" lang="scss">
  @import '../../assets/css/style.scss';
  .footer{
    background: $black;
    color: $light_text;
    padding-bottom:40px;
    .box{
      .box_foot{
        @include flex(space-between,flex-start)
        @include gap(25,v)
        margin-bottom:10px;
        @include main
        line-height: 2.4;
        aside{
          .copyright{
            @include flex
            .copyright_img{
              width: 92px;
              height: 35px;
              border-radius:5px;
              background: url('../../assets/images/css_sprites.png') -152px -152px;
            }
            .copyright_text{
              width:400px;
              margin-left:20px;
              font-size: 12px;
              line-height: 1.6;
            }
          }
          .help_support{
            margin-bottom:25px;
            a{
              @include gap(20,h)
              border-left:1px solid $light_text;
              &:first-child{
                padding-left:0;
                border-left:0
              }
            }
          }
          .service{
            margin-bottom:30px;
            a{
              @include gap(30,h)
              &:nth-child(2){
                padding-left:0
              }
            }
          }
        }
        .follow{
          text-align: center;
          .outside{
            background: #fff;
            margin-top:10px;
            padding:3px;
            .qrcode{
              width: 80px;
              height: 80px;
              background: url('../../assets/images/css_sprites.png') -175px -10px;
            }
          }
          .active{
            font-size: 12px
          }
          a{
            display: block;
            line-height: 1.5;
          }
        }
        h3,span.active{
          font-size: 18px
        }
        span.active{
          font-weight: bold;
          margin-right:10px
        }
      }
      .partner{
        @include main
        @include flex
        padding:10px;
        border:1px dashed $light_text;
        line-height: 1.2;
        span{
          padding-right:10px;
          border-right:1px solid $light_text
        }
        div{
          flex:1;
          @include gap(30,h)
          @include flex
          a{
            width:100px;
            text-align: center;
          }
        }
      }
    }
    h4{
      color:#f5f8fb;
    }
    h3,a,p,span{
      color:#adaeb1;
    }
    a:hover,.active{
      color:$white
    }
    &[disabled]{
      display: none;
    }
  }
</style>
