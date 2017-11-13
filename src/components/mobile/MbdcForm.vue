<template>
  <section class="mask">
    <div>
      sjznzsjzsnsjznsjzns
    </div>
    <!-- <mt-navbar class="page-part" :selected.sync="selected">
      <mt-tab-item id="1">选项一</mt-tab-item>
      <mt-tab-item id="2">选项二</mt-tab-item>
      <mt-tab-item id="3">选项三</mt-tab-item>
    </mt-navbar>

    <!-- tab-container -->
    <!-- <mt-tab-container :active.sync="selected">
      <mt-tab-container-item id="1">
        <mt-cell v-for="n in 10" :title="'内容 ' + n"></mt-cell>
      </mt-tab-container-item>
      <mt-tab-container-item id="2">
        <mt-cell v-for="n in 4" :title="'测试 ' + n"></mt-cell>
      </mt-tab-container-item>
      <mt-tab-container-item id="3">
        <mt-cell v-for="n in 6" :title="'选项 ' + n"></mt-cell>
      </mt-tab-container-item>
    </mt-tab-container> -->
  </section>
</template>

<script>
  // import FormField from '@/components/common/FormField'
  // import api from '@/util/function'
  export default {
  }
</script>

<style type="text/css" lang="scss">
  @import '../../assets/css/style.scss';
  .mask{
    @include mask
    .form_box{
      .form_content{
        padding:40px 130px;
        @include form(v)
        .input{
          .select{
            @include flex(space-between)
            select{
              width:33%;
              height:32px;
              line-height: 32px;
              border:none;
            }
          }
        }
        &.card_form .input{
          span{
            &:first-child {
              width: 120px;
              text-align: right;
            }
            &:nth-child(2) {
              left: 135px
            }
          }
          input,.sel,.select{
            padding-left:185px
          }
        }
        .fee{
          font-size: 12px;
          color: $light_black;
          margin-left:5px
        }
      }
    }
    .contract{
      padding:30px;
      height:680px;
      overflow:auto;
      p, p > *{
        white-space:wrap !important;
      }
    }
  }
</style>
