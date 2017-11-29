<template>
  <div class="calculator">
    <h2>挖矿计算器</h2>
     <form> 
      <div class="fromone">
        <label>币种</label>
        <select>
          <option v-for="n, k in option">{{n.name}}</option>
        </select>
      </div>
      <div class="fromone">
        <label>单台矿机价格</label>
        <input type="text" placeholder="22" class="cover" onkeyup="value=value.replace(/[^\d]/g,'') " ng-pattern="/[^a-zA-Z]/" id="input1" v-model="message1"/>
      </div>
      <div class="fromone">
        <label>矿机数量</label>
        <input type="text" placeholder="22" class="cover" onkeyup="value=value.replace(/[^\d]/g,'') " ng-pattern="/[^a-zA-Z]/" id="input2"/>
      </div>
      <div class="fromone">
        <label>矿机算力</label>
        <div class="rightblock">
            <input type="text" placeholder="22" class="cover cover1" onkeyup="value=value.replace(/[^\d]/g,'') " ng-pattern="/[^a-zA-Z]/" id="input3"/>
            <span>TH/S</span>
        </div>
      </div>
      <div class="fromone">
        <label>矿机功耗</label>
        <div class="rightblock">
            <input type="text" placeholder="22" class="cover cover1" onkeyup="value=value.replace(/[^\d]/g,'') " ng-pattern="/[^a-zA-Z]/" id="input4"/>
            <span>W</span>
        </div>
      </div>
      <div class="fromone">
        <label>每T功耗</label>
        <span class="tespan">5555 W/T</span>
      </div>
      <div class="fromone">
        <label>每T价格</label>
        <span class="tespan">¥ 221 /T</span>
      </div>
      <div class="fromone">
        <label>电费</label>
        <div class="rightblock">
            <input type="text" placeholder="22" class="cover cover1" onkeyup="value=value.replace(/[^\d]/g,'') " ng-pattern="/[^a-zA-Z]/" id="input5"/>
            <span>¥/KWh</span>
        </div>
      </div>
      <div class="fromone">
        <label>币价</label>
        <div class="rightblock">
            <input type="text" placeholder="22" class="cover cover1" onkeyup="value=value.replace(/[^\d]/g,'') " ng-pattern="/[^a-zA-Z]/" id="input6"/>
            <span>¥/BTC</span>
        </div>
      </div>
      <div class="fromone">
        <label>起始难度</label>
        <input type="text" placeholder="22" class="cover" onkeyup="value=value.replace(/[^\d]/g,'') " ng-pattern="/[^a-zA-Z]/" id="input7"/>
      </div>
      <div class="fromone">
        <label>开始时间和结束时间</label>
        <el-date-picker v-model="value3" type="datetimerange" range-separator="至" start-placeholder="开始日期" end-placeholder="结束日期">
        </el-date-picker> 
      </div>
      <button>计算</button>
     </form> 
     <h2>预期利润概览</h2>
     <div class="total">
         <p v-for="n, k in totallist">
             <template v-if="n.next==='%'">
               <span class="p_left">{{n.title}}</span>
               <span class="p_right">{{n.next}}</span>
             </template>
             <template v-else>
               <span class="p_left">{{n.title}}</span>
               <span class="p_right">{{n.prev}}</span>
             </template>
         </p>
     </div>
  </div>
</template>

<script>
  export default {
    data () {
      return {
        message1: '',
        totallist: [{title: '总利润', prev: '¥'}, {title: '总收入', prev: '¥'}, {title: '总电费', prev: '¥'}, {title: '总矿机成本', prev: '¥'}, {title: '每T价格', prev: '¥'}, {title: '投资回报率', next: '%'}, {title: '当前每日收入', prev: '¥'}, {title: '当前每日电费', prev: '¥'}, {title: '当前每日利润', prev: '¥'}],
        value3: [new Date(2000, 10, 10, 10, 10), new Date(2000, 10, 11, 10, 10)],
        option: [{name: 'CNY - ¥'}, {name: 'USD - $'}]
      }
    },
    methods: {
    //   changeon () {
    //     var inputvalue1 = document.getElementById('input1').value
    //     console.log(inputvalue1)
    //   }
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
      width: 80%;
      overflow: hidden;
      padding: 0 10%;
      box-sizing: border-box;
      margin-bottom: 5px;
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

