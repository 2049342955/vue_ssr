<template>
  <section class="mask">
    <div class="form_box">
      <div class="close" @click="$parent.closeEdit()">
        <span class="icon"></span>
        <span>关闭</span>
      </div>
      <h2>{{title}}</h2>
      <form class="form form_content" @submit.prevent="$parent.submit" novalidate>
        <FormField :form="form"></FormField>
        <p v-if="fee">手续费：{{$parent.total_price*$parent.fee}}元</p>
        <button>确认提交</button>
      </form>
    </div>
  </section>
</template>

<script>
  import FormField from '@/components/common/FormField'
  export default {
    components: {
      FormField
    },
    props: {
      form: {
        type: Array
      },
      title: {
        type: String
      },
      fee: {
        type: Number
      }
    }
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
          span{
            &:first-child {
              width: 115px;
              text-align: right;
            }
            &:nth-child(2) {
              left: 135px
            }
          }
          input,.sel{
            padding-left:185px
          }
          .select{
            padding-left:185px;
            @include flex
            select{
              flex:1;
              height:32px;
              line-height: 32px;
              border:none;
              & + select{
                margin-left:3px
              }
            }
          }
        }
      }
    }
  }
</style>
