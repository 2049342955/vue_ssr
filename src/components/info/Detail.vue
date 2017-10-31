<template>
  <section class="web_info_detail">
    <h3>{{content.title}}</h3>
    <div class="info_detail" v-html="content.content"></div>
    <div class="web_tips" ref="tips"></div>
  </section>
</template>

<script>
  import util from '../../util'
  import api from '../../util/function'
  export default {
    data () {
      return {
        content: {}
      }
    },
    created () {
      var self = this
      util.post('content', {sign: 'token=0&news_id=' + this.$route.params.id}).then(function (res) {
        api.checkAjax(self, res, () => {
          self.content = res[0]
        })
      })
    }
  }
</script>
<style type="text/css" lang="scss">
  @import '../../assets/css/style.scss';
  .web_info_detail{
    min-height:500px;
    background: #fff;
    padding:15px;
    line-height: 2;
    h3{
      text-align: center;
      font-size: 18px;
      line-height: 3;
    }
    .info_detail{
      img{
        width:auto;
        max-width:100%
      }
    }
  }
</style>
