<template>
  <footer class="footer">
    <div class="box">
      <aside>
        <h3>帮助与支持</h3>
        <div class="list" v-for="(t,k) in link">
          <router-link :to="t">{{ k }}</router-link>
        </div>
      </aside>
      <aside>
        <h3>联系我们</h3>
        <div class="list" v-for="(t,k) in text">{{ k + '：' }}<span>{{ t }}</span></div>
      </aside>
      <div class="follow">
        <h3>关注算力网</h3>
        <img :src="qrcode">
        <div>扫一扫关注最新ICO信息</div>
      </div>
    </div>
  </footer>
</template>
<script>
  export default {
    data () {
      return {
        qrcode: require('@/assets/images/qrcode.jpg'),
        link: {'关于我们': '/helpSupport/aboutUs', '安全保障': '/helpSupport/safeGuarantee', '常见问题': '/helpSupport/issues'},
        text: {'公司地址': '杭州市学院路77号黄龙国际中心G座907', '公司电话': '0571-28221076', '客服邮箱': 'V@suanli.com'}
      }
    }
  }
</script>

<style type="text/css" lang="scss">
  @import '../../assets/css/style.scss';
  .footer{
    background: $black;
    color: hsla(0,0%,100%,.6);
    .box{
      @include flex(space-between,flex-start)
      @include gap(20,v)
      @include main
      line-height: 2.4;
      aside{
        .list{
          a{
            color: rgba(255, 255, 255, .6);
            &:hover{
              color:#fff
            }
          }
          span{
            color: $white
          }
        }
      }
    }
    .follow{
      text-align: center;
      img{
        width:80px
      }
      div{
        font-size: 12px
      }
    }
    h3{
      font-size: 18px;
      color: $white
    }
  }
</style>
