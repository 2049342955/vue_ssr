<template>
  <section class="bdcform">
    <div class="mobile_header">
      <span class="left">< <em>返回</em></span>
      <span>算力托管申请</span>
    </div>
    <div class="bodyform">
      <form>
        <mt-field label="" placeholder="申请人"></mt-field>
        <mt-field label="" placeholder="请输入手机号" type="tel"></mt-field>
        <mt-field label="" placeholder="请输入验证码">
          <span>获取验证码</span>
        </mt-field>
        <select label="" placeholder="请选择BDC" type="select">
          <option>请选择BDC</option>
        </select>
        <mt-field label="" placeholder="请输入服务器类型" type="number"></mt-field>
        <mt-field label="" placeholder="请输入服务器数量" type="number"></mt-field>
        <button>提交申请</button>
      </form>
    </div>
    <div class="link">
      <img src="../../assets/images/BDC-2.png"/>
      客服热线： 0571-28221076 &nbsp;&nbsp;&nbsp;工作日 （9:00~18:00）
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
      .mint-cell:first-child{
        margin-top:1rem;
      }
      select{
        width: 100%;
        background:white;
        border:1px solid #bfbfbf;
        border-radius:5px;
        margin-top:.5rem;
        height:48px;
      }
      button{
        width: 100%;
        border:0;
        height: 48px;
        color: white;
        margin-top:2rem;
        background: #327fff;
        font-size: 0.6rem;
      }
    }
    .link{
      width: 100%;
      height: 2rem;
      position: fixed;
      bottom:0;
      border-top:1px solid #bfbfbf;
      padding:0 .5rem;
      line-height:2rem;
      box-sizing: border-box;
      font-size:0.45rem;
      color: #bdbdbe;
      img{
        width:.7rem;
        height:.7rem; 
        position: relative;
        top:-.65rem;
        margin-right: .5rem;
      }
    }
  }
</style>