<template>
  <section class="admin">
    <div class="mobile_header">
      <span class="left">< <em>返回</em></span>
      <span>账户管理</span>
    </div>
    <ul>
        <li>
            <span>用户名</span>
            <i>133****1254</i>
        </li>
        <li>
            <span>绑定手机</span>
            <i>17682555652</i>
        </li>
        <li style="border:0;">
            <span>实名认证</span>
            <i>啦啦啦</i>
        </li>
    </ul>
    <div class="list">
        <router-link to="#" class="route">
            <span>密码管理</span>
            <i><em>></em></i>
        </router-link>
        <router-link to="#" class="route">
            <span>银行卡</span>
            <i>去绑定 <em>></em></i>
        </router-link>
        <router-link to="#" class="route" style="border:0;">
            <span>算力收益地址</span>
            <i>去添加 <em>></em></i>
        </router-link>
    </div>
  </section>
</template>
<script>
export default {
  data () {
    return {
    }
  }
}
</script>
<style scoped lang="scss">
.mobile_header{
    margin-bottom:0;
}
  .admin{
      width: 100%;
      height: 100%;
      background: #f5f5f9;
      ul{
          width: 100%;
          overflow: hidden;
          background: white;
          padding:0 .5rem;
          box-sizing: border-box;
          li{
              width: 100%;
              border-bottom:1px solid #ddd;
              height: 1.5rem;
              display: flex;
              justify-content: space-between;
              line-height: 1.5rem;
              span{
                  color: #121212;
                  font-size: 0.6rem;
              }
              i{
                  color: #999999;
                  font-size: 0.6rem;
              }
          }
      }
      .list{
          width: 100%;
          overflow: hidden;
          background: white;
          padding:0 .5rem;
          box-sizing: border-box;
          margin-top: .5rem;
          .route{
              width: 100%;
              border-bottom:1px solid #ddd;
              height: 1.5rem;
              display: flex;
              justify-content: space-between;
              line-height: 1.5rem;
              span{
                  color: #121212;
                  font-size: 0.6rem;
              }
              i{
                  color: #999999;
                  font-size: 0.6rem;
                  em{
                     font-family: "宋体";
                    font-style: normal;
                  }
              }
          }
      }
  }
</style>