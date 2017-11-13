<template>
  <section class="bdcform" to="#">
    <div class="mobile_header">
      <span class="left">< <em>返回</em></span>
      <span>意见反馈</span>
      <button>提交</button>
    </div>
    <div class="message">
      <textarea placeholder="欢迎您向我们反馈使用过程中的任何意见和建议！"></textarea>
      <p>0/150</p>
    </div>
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
      background:none;
      border:0;
      color: white;
      font-size:  0.5rem;
      position: absolute;
      right: 0.5rem;
      top:.7rem;
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