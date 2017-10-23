<template>
  <footer class="footer" v-if="!$route.path.includes('auth')" :disabled="$route.name==='notFound'">
    <div class="box">
      <aside>
        <h4>联系我们</h4>
        <h3>杭州总部</h3>
        <p>咨询电话：<span class="active">0571-28221076</span>工作日（9:00~18:00）</p>
        <p>客服邮箱：V@suanli.com</p>
        <p>公司地址：浙江省杭州市学院路77号黄龙国际中心G座-907</p>
        <div class="copyright_img"></div>
      </aside>
      <aside>
        <div class="help_support">
          <router-link :to="l" v-for="l,k in link" :key="k">{{k}}</router-link>
        </div>
        <div class="service">
          <h4>产品及服务</h4>
          <router-link :to="s" v-for="s,k in service" :key="k">{{k}}</router-link>
        </div>
        <div class="partner">
          <span>友情<br>链接</span>
          <div>
            <a :href="p" v-for="p,k in partner" :key="k">{{k}}</a>
          </div>
        </div>
      </aside>
      <div class="follow">
        <h4>关注我们</h4>
        <router-link :to="i" v-for="i,k in info" :key="k">{{k}}</router-link>
        <div class="qrcode"></div>
        <div class="active">最新区块链资讯</div>
      </div>
    </div>
  </footer>
</template>
<script>
  export default {
    data () {
      return {
        // link: {'关于我们': '/webInfo/aboutUs', '安全保障': '/webInfo/safeGuarantee', '法律声明': '/webInfo/lawyer', '常见问题': '/webInfo/issues'},
        link: {'关于我们': '/webInfo/aboutUs', '常见问题': '/webInfo/issues'},
        service: {'BDC托管': '/bdc/list', '云矿机商城': '/cloudCompute/list/1/all', '算力转让区': '/computeTransfer/list/1/all'},
        partner: {'保全网': 'https://baoquan.com/', '千信网': 'http://www.eqianxin.com/', '数秦区块链': ''},
        info: {'网站动态': '/webInfo/list/website', '产品公告': '/webInfo/list/product'}
      }
    }
  }
</script>

<style type="text/css" lang="scss">
  @import '../../assets/css/style.scss';
  .footer{
    background: $black;
    color: $light_text;
    .box{
      @include flex(space-between,flex-start)
      @include gap(20,v)
      @include main
      border-bottom:1px solid $light_text;
      line-height: 2.4;
      aside{
        .copyright_img{
          width: 92px;
          height: 35px;
          border-radius:5px;
          margin-top:35px;
          margin-bottom:10px;
          background: url('../../assets/images/css_sprites.png') -152px -152px;
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
          margin-bottom:25px;
          a{
            @include gap(30,h)
            &:nth-child(2){
              padding-left:0;
              border-left:0
            }
          }
        }
        .partner{
          @include flex
          padding:10px;
          border:1px dashed $light_text;
          line-height: 1.2;
          span{
            padding-right:10px;
            border-right:1px solid $light_text;
          }
          div{
            flex:1;
            @include gap(30,h)
            @include flex(space-between)
          }
        }
      }
      .follow{
        text-align: center;
        .qrcode{
          width: 80px;
          height: 80px;
          margin-top:15px;
          background: url('../../assets/images/css_sprites.png') -175px -10px;
        }
        div{
          font-size: 12px
        }
        a{
          display: block;
          line-height: 2;
        }
      }
      h3,span.active{
        font-size: 18px
      }
      h4{
        color:#d7d8d9
      }
      h3,.help_support a,.partner span{
        color:$light_black
      }
      span.active{
        font-weight: bold;
        margin-right:10px
      }
      a:hover{
        color:$white
      }
      .active{
        color:$white
      }
    }
    &[disabled]{
      display: none;
    }
  }
</style>
