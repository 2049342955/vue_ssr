<template>
  <section class="bdcform">
    <div class="message">
      <textarea placeholder="欢迎您向我们反馈使用过程中的任何意见和建议！"></textarea>
      <p>0/150</p>
    </div>
    <button>提交</button>
  </section>
</template>
<script>
export default {
  data () {
    return {
      option: {'title': '请选择BDC'}
    }
  }
}
</script>
<style scoped lang="scss">
  .bdcform{
    width: 100%;
    height: 100vh;
    background: #f5f5f9;
    button{
      background:#327fff;
      height: 2rem;
      border:0;
      color: white;
      font-size:  0.7rem;
      width: 94%;
      margin-top: 20px;
      margin-left: 3%;
      border-radius: 3px;
    }
    .bodyform{
      width: 100%;
      padding:0;
      margin:0;
      padding:0 .5rem;
      .mint-cell{
        margin-top:.5rem;
        border:1px solid #bfbfbf;
        border-radius:5px;
        span{
          width: 4.5rem;
          display:inline-block;
          height: 34px;
          text-align:center;
          color: #498aff;
          margin-top:6px;
          line-height: 34px;
          border-left:1px solid #dddddd;
        }
      }
    }
    .message{
      width: 100%;
      height: 6rem;
      background: white;
      padding:.5rem;
      textarea::-webkit-input-placeholder{
        color: #e6e6e6;
      }
      textarea{
        width: 100%;
        height: 4.5rem;
        display: block;
      }
      p{
        text-align: right;
        color: #5a5a5a;
      }
    }
  }
</style>