<template>
  <section class="bdc_list">
    <div class="bg-box">
      <div class="bg"></div>
      <div class="mask"></div>
    </div>
    <div class="top-box-row">
      <div class="top-box">
        <div class="float-left bdc-box">
          <div><span class="big-title">BDC</span><span class="subtitle">（Blockchain   Data   Center）</span></div>
          <div class="bdc-detail">BDC是平台整合优质品牌商与分销商，通过平台的优势及服务以及吸引广大消费者的一种形式，算力网通过自身的优势整合筛选出行业内优质合规的BDC机房，算力服务器生产商，为算力爱好者提供算力服务器托管，算力服务器采购，算力服务器租赁等服务，打通算力及衍生商品产业链的完整交易，做到平台，供应商，消费者三方互惠互利。</div>
          <div><span class="service">客服：</span><span class="tel">0571- 28221076</span><span class="time">工作日（9:00~18:00）</span></div>
        </div>
        <div class="float-right form-box">
          <form>
            <div class="form-header">提交托管矿机申请</div>
            <div class="form-line"><span class="label">申请人</span><input type="text" v-model.trim="depName" placeholder="请输入您的姓名">{{depName}}</div>
            <div class="form-line"><span class="label">手机号码</span><input type="text" v-model.trim="depTel" pattern="^1[3578][0-9]{9}$" placeholder="请输入手机号码"></div>
            <div class="form-line"><span class="label">选择BDC</span>
              <select v-model="depBdc">
                <option v-for="(item, index) in list" :key="item.bdc_name" :value="index">{{item.bdc_name}}</option>
              </select>
            </div>
            <div class="form-line"><span class="label">服务器类型</span><input type="text" v-model.trim="depType" placeholder="请输入算力服务器类型"></div>
            <div class="form-line"><span class="label">服务器数量</span><input type="text" v-model.trim="depNumber" placeholder="输入托管算力服务器数量"></div>
            <div class="btn" @click="submit">提交申请</div>
          </form>
        </div>
      </div>
    </div>
    <div class="item-box-row">
      <div class="item-box" v-for="(item, index) in list" :key="item.bdc_name">
        <div class="header">{{item.bdc_name}}</div>
        <div class="overflow">
          <img class="float-left" :src="item.bdc_img" alt="">
          <div class="float-left tip">
            <div class="line"><span>算力机房规模</span>{{item.bdc_scope}}</div>
            <div class="line"><span>供电类型</span>{{item.bdc_electric_type}}</div>
            <div class="line"><span>散热方式</span>{{item.bdc_radiating_type}}</div>
            <div class="line"><span>支持服务器</span>{{item.bdc_Mills_type}}</div>
          </div>
        </div>
      </div>
      <!-- <div class="item-box">
        <div class="header">云南BDC</div>
        <div class="overflow">
          <img class="float-left" src="../../assets/images/bdc2.jpg" alt="">
          <div class="float-left tip">
            <div class="working">建设中&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;即将上线 ...</div>
          </div>
        </div>
      </div>
      <div class="item-box">
        <div class="header">通辽BDC</div>
        <div class="overflow">
          <img class="float-left" src="../../assets/images/bdc2.jpg" alt="">
          <div class="float-left tip">
            <div class="working">准备中&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;即将上线 ...</div>
          </div>
        </div>
      </div> -->
    </div>
  </section>
</template>

<script>
  import api from '../../util'
  export default {
    data () {
      return {
        list: [],
        depName: '',
        depTel: '',
        depBdc: 0,
        depType: '',
        depNumber: ''
      }
    },
    methods: {
      test (e) {
        console.log(11)
      },
      submit () {
        // TODO:验证
        api.post('http://result.eolinker.com/lJxVgU255189f80709e57d8af8cf4050835a76513cd9c10?uri=depositMessage', {
          dep_name: this.depName,
          dep_tel: this.depTel,
          dep_bdc: this.depBdc,
          dep_type: this.depType,
          dep_number: this.depNumber
        }).then(function () {

        })
      }
    },
    beforeMount () {
      let self = this
      api.post('http://result.eolinker.com/lJxVgU255189f80709e57d8af8cf4050835a76513cd9c10?uri=bdcinfoList').then(function (data) {
        self.list = data
      })
    }
  }
</script>

<style type="text/css" lang="scss" scoped>
  @import '../../assets/css/style.scss';
  .bg-box{
    width: 100%;
    height: 580px;
    position: absolute;
    top: 0;
    left: 0;
    overflow: hidden;
    z-index: -1;
    & .mask{
      position: absolute;
      width: 100%;
      height: 100%;
      background-color: rgba(0,0,0,0.5);
    }
  }
  .bg{
    background: url('../../assets/images/bdc_bg.jpg') no-repeat;
    width: 1920px;
    height: 580px;
    position: absolute;
    top: 0;
    left: 50%;
    margin-left: -960px;
  }
  .bdc_list{
    font-size: 18px;
    color: #fff;
  }
  .overflow{
    overflow: hidden;
  }
  .float-left{
    float: left;
  }
  .float-right{
    float: right;
  }
  .big-title{
    font-size: 48px;
    font-weight: bold;
  }
  .top-box{
    margin: 0 auto;
    width: 1180px;
    // background-color: ;
    height: 500px;
    overflow: hidden;
    padding-top: 20px; 
  }
  .subtitle{
    font-size: 18px;
    margin-left: 20px;
  }
  .service{
    font-size: 14px;
    color: #666;
  }
  .tel{
    font-weight: bold;
    margin-right: 10px;
  }
  .time{
    font-size: 12px;
    color: #666;
  }
  .bdc-box{
    width: 670px;
    margin-top: 85px;
  }
  .bdc-detail{
    margin: 30px 0;
  }
  .form-box{
    background-color: #15121c;
    width: 410px;
    padding: 25px 45px;
    & .btn{
      color: #fff;
      height: 40px;
      line-height: 40px;
      text-align: center;
      background-color: #327fff;
      border-radius: 5px;
      cursor: pointer;
    }
  }
  .form-header{
    font-weight: bold;
    text-align: center;
    margin-bottom: 25px;
    color: #fff;
  }
  .form-line{
    position: relative;
    height: 40px;
    border-radius: 5px;
    background-color: #fff;
    font-size: 16px;
    margin-bottom: 19px;
    line-height: 40px;
    & .tip{
      position: absolute;
    }
    & .label{
      font-size: 16px;
      width: 105px;
      height: 20px;
      line-height: 20px;
      display: inline-block;
      border-right: 1px solid #ccc;
      margin-left: 12px;
      color: #666;
    }
    & input{
      display: inline-block;
      width: 200px;
      padding-left: 20px;
      font-size: 16px;
    }
    & select{
      border: none;
      font-size: 16px;
      outline: none;
      width: 190px;
      padding-left: 20px;
      height: 40px;
    }
  }
  .item-box-row{
    background-color: #15121c;
    padding-bottom: 35px;
  }
  .item-box{
    width: 1180px;
    margin: 0 auto;
    padding-top: 55px;
    border-bottom: 1px solid #000;
    padding-bottom: 45px;
    background-color: #15121c;
    &:last-child{
      border: none;
    }
    & img{
      width: 590px;
      height: 460px;
    }
    & .line{
      margin-bottom: 40px;
    }
    .tip{
      padding-top: 80px;
    }
    .working{
      width: 260px;
      height: 40px;
      line-height: 40px;
      background-color: #15121c;
      margin-top: 120px;
      margin-left: 170px;
      text-align: center;
    }
    & .overflow{
      background-color: #25212f;
      & span{
        font-weight: bold;
        display: inline-block;
        width: 145px;
        height: 45px;
        line-height: 45px;
        text-align: center;
        margin-right: 50px;
        margin-left: 65px;
        background-color: #15121c;
      }
    }
  }
  .header{
    font-size: 24px;
    text-align: center;
    margin: 0 auto;
    color: #fff;
    background-color: transparent;
    margin-bottom: 40px;
    &:before{
      content: '';
      display: inline-block;
      background: url('../../assets/images/title-left.png') no-repeat;
      width: 122px;
      height: 36px;
      vertical-align: middle;
      margin-right: 80px;
    }
    &:after{
      content: '';
      display: inline-block;
      background: url('../../assets/images/title-right.png') no-repeat;
      width: 122px;
      height: 37px;
      vertical-align: middle;
      margin-left: 80px;
    }
  }
</style>
