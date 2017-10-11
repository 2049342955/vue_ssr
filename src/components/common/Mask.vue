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
        width:450px
      }
    }
  }
</style>
