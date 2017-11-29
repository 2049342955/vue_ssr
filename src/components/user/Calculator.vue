<template>
  <div class="calculator">
    <h2>挖矿计算器</h2>
     <form @submit.prevent="submit"> 
      <div class="fromone">
        <label>币种</label>
        <select id="select" @change="change">
          <option v-for="n, k in option">{{n.name}}</option>
        </select>
      </div>
      <div class="fromone">
        <label>单台矿机价格</label>
        <input type="text" :value="message1"  class="cover" onkeyup="value=value.replace(/[^\d]/g,'') " ng-pattern="/[^a-zA-Z]/" id="input1" v-model="message1"/>
        <span class="biao block1">请输入单台矿机价格</span>
      </div>
      <div class="fromone">
        <label>矿机数量</label>
        <input type="text" value="message2" class="cover"  onkeyup="value=value.replace(/[^\d]/g,'') " ng-pattern="/[^a-zA-Z]/" id="input2" v-model="message2"/>
        <span class="biao block2">请输入单台矿机价格</span>
      </div>
      <div class="fromone">
        <label>矿机算力</label>
        <div class="rightblock">
            <input type="text" value="message3" class="cover cover1" onkeyup="value=value.replace(/[^\d]/g,'') " ng-pattern="/[^a-zA-Z]/" id="input3" v-model="message3"/>
            <span>TH/S</span>
        </div>
        <span class="biao block3">请输入单台矿机价格</span>
      </div>
      <div class="fromone">
        <label>矿机功耗</label>
        <div class="rightblock">
            <input type="text" value="message4" class="cover cover1" onkeyup="value=value.replace(/[^\d]/g,'') " ng-pattern="/[^a-zA-Z]/" id="input4" v-model="message4"/>
            <span>W</span>
        </div>
        <span class="biao block4">请输入单台矿机价格</span>
      </div>
      <div class="fromone">
        <label>每T功耗</label>
        <span class="tespan">{{(message4/message3)?(message4/message3): '0'}} W/T</span>
      </div>
      <div class="fromone">
        <label>每T价格</label>
        <span class="tespan">¥ {{(message1/message2)?(message1/message2): '0'}} /T</span>
      </div>
      <div class="fromone">
        <label>电费</label>
        <div class="rightblock">
            <input type="text" value="message5" class="cover cover1" onkeyup="value=value.replace(/[^\d]/g,'') " ng-pattern="/[^a-zA-Z]/" id="input5" v-model="message5"/>
            <span>¥/KWh</span>
        </div>
        <span class="biao block5">请输入单台矿机价格</span>
      </div>
      <div class="fromone">
        <label>币价</label>
        <div class="rightblock">
            <input type="text" value="message6" class="cover cover1" onkeyup="value=value.replace(/[^\d]/g,'') " ng-pattern="/[^a-zA-Z]/" id="input6" v-model="message6"/>
            <span>¥/BTC</span>
        </div>
        <span class="biao block6">请输入单台矿机价格</span>
      </div>
      <div class="fromone">
        <label>起始难度</label>
        <input type="text" value="message7" class="cover" onkeyup="value=value.replace(/[^\d]/g,'') " ng-pattern="/[^a-zA-Z]/" id="input7" v-model="message7"/>
        <span class="biao block7">请输入单台矿机价格</span>
      </div>
      <div class="fromone">
        <label>开始时间和结束时间</label>
        <el-date-picker v-model="value3" type="datetimerange" range-separator="至" start-placeholder="开始日期" end-placeholder="结束日期">
        </el-date-picker> 
      </div>
      <button class="button" @click="submit">计算</button>
     </form> 
     <h2>预期利润概览</h2>
     <div class="total">
         <p>
            <span class="p_left">总利润</span>
            <span class="p_right">{{typebi}} {{((((5 * message6 * message3).toFixed(2)) - (message5 * message4 * 24 * message3)).toFixed(2) * timeall).toFixed(2)}}</span>
         </p>
         <p>
            <span class="p_left">总收入</span>
            <span class="p_right">{{typebi}} {{((5 * message6 * message3).toFixed(2)) * timeall}}</span>
         </p>
         <p>
            <span class="p_left">总电费</span>
            <span class="p_right">{{typebi}} {{(message5 * message4 * 24 * message3) * timeall}}</span>
         </p>
         <p>
            <span class="p_left">总矿机成本</span>
            <span class="p_right">{{typebi}} {{message1 * message2}}</span>
         </p>
         <p>
            <span class="p_left">每T价格</span>
            <span class="p_right">{{typebi}} {{message1 / message2}}</span>
         </p>
         <p>
            <span class="p_left">投资回报率</span>
            <span class="p_right">{{(((((5 * message6 * message3).toFixed(2)) - (message5 * message4 * 24 * message3)).toFixed(2) * timeall) / (message1 * message2)).toFixed(2)}} %</span>
         </p>
         <p>
            <span class="p_left">当前每日收入</span>
            <span class="p_right">{{typebi}} {{(5 * message6 * message3).toFixed(2)}}</span>
         </p>
         <p>
            <span class="p_left">当前每日电费</span>
            <span class="p_right">{{typebi}} {{message5 * message4 * 24 * message3}}</span>
         </p>
         <p>
            <span class="p_left">当前每日利润</span>
            <span class="p_right">{{typebi}} {{(((((5 * message6 * message3).toFixed(2)) - (message5 * message4 * 24 * message3)).toFixed(2)) / (message1 * message2)).toFixed(2)}}</span>
         </p>
     </div>
  </div>
</template>

<script>
  export default {
    data () {
      return {
        message1: '111',
        message2: '1',
        message3: '111',
        message4: '11',
        message5: '0.32',
        message6: '0.33',
        message7: '0.33',
        typebi: '¥',
        totallist: [{title: '总利润', prev: '¥'}, {title: '总收入', prev: '¥'}, {title: '总电费', prev: '¥'}, {title: '总矿机成本', prev: '¥'}, {title: '每T价格', prev: '¥'}, {title: '投资回报率', next: '%'}, {title: '当前每日收入', prev: '¥'}, {title: '当前每日电费', prev: '¥'}, {title: '当前每日利润', prev: '¥'}],
        value3: [new Date(2000, 10, 10, 10, 10), new Date(2000, 10, 11, 10, 10)],
        option: [{name: 'CNY - ¥'}, {name: 'USD - $'}],
        timeall: '',
        dayprice: '',
        daydian: '',
        dayxian: '',
        allxian: '',
        allprice: '',
        alldian: ''
      }
    },
    methods: {
      change () {
        var select = document.getElementById('select').value
        if (select === 'CNY - ¥') {
          this.typebi = '¥'
        } else {
          this.typebi = '$'
        }
        var time = document.getElementsByClassName('el-range-input')[0].value
        var time1 = document.getElementsByClassName('el-range-input')[1].value
        var d1 = new Date(time)
        var d2 = new Date(time1)
        this.timeall = Math.floor((parseInt(d2 - d1)) / (24 * 3600 * 1000))
      },
      submit () {
        var time = document.getElementsByClassName('el-range-input')[0].value
        var time1 = document.getElementsByClassName('el-range-input')[1].value
        var d1 = new Date(time)
        var d2 = new Date(time1)
        this.timeall = Math.floor((parseInt(d2 - d1)) / (24 * 3600 * 1000))
      }
    },
    mounted () {
      var time = document.getElementsByClassName('el-range-input')[0].value
      var time1 = document.getElementsByClassName('el-range-input')[1].value
      var d1 = new Date(time)
      var d2 = new Date(time1)
      this.timeall = Math.floor((parseInt(d2 - d1)) / (24 * 3600 * 1000))
    }
  }
</script>

<style lang="scss" scoped>
  .calculator{
    width: 100%;
    overflow: hidden;
    background: white;
    h2{
      width: 100%;
      background: white;
      margin-bottom: 20px;
    }
    .fromone{
      width: 100%;
      overflow: hidden;
      padding: 0 10%;
      box-sizing: border-box;
      margin-bottom: 5px;
      .biao{
          color: red;
          height: 40px;
          line-height: 40px;
          margin-left: 20px;
          display:none;
      }
      label{
        width: 143px;
        height: 40px;
        display:inline-block;
        float: left;
        font-size: 14px;
        line-height: 40px;
      }
      select{
        width: 400px;
        height: 40px;
        float: left;
        border-radius: 4px;
        border: 1px solid #d8dce5;
        padding-left: 7px;
      }
      .rightblock{
        width: 400px;
        height: 40px;
        float: left;
        border-radius: 4px;
        border: 1px solid #d8dce5;
        span{
          display:inline-block;
          background:#eee;
          color: #555;
          height: 100%;
          float: right;
          font-size: 14px;
          line-height: 40px;
          padding: 0 5px;
          box-sizing: border-box;
        }
        input{
          float: left;
          height: 100%;
          width: auto;
          box-sizing: border-box;
          padding-left: 10px;
        }
      }
      .cover{
        width: 400px;
        height: 40px;
        float: left;
        border-radius: 4px;
        border: 1px solid #d8dce5;
        padding-left: 10px;
      }
      .cover1{
          border:0;
      }
      .tespan{
        display:inline-block;
        float: left;
        text-align: right;
        width: 400px;
        height: 40px;
        line-height: 40px;
        color: #888;
      }
    }
    button{
        width: 242px;
        height: 44px;
        background: #01bfb5;
        color: white;
        font-size: 16px;
        margin-top: 30px;
        margin-left: 30%;
    }
    .total{
        width: 80%;
        overflow: hidden;
        padding: 0 10%;
        box-sizing: border-box;
        margin-bottom: 5px;
        p{
          width: 40%;
          float: left;
          height: 30px;
          margin-right: 10%;
          margin-bottom: 10px;
          .p_right{
              color:#888;
              float: right;
          }
        }
    }
  }
</style>

