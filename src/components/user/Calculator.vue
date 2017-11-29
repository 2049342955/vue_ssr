<template>
  <div class="calculator">
    <h2>挖矿计算器</h2>
     <form>
      <div class="fromone" v-for="n,k in fromlists">
        <label>{{n.label}}</label>
        <template v-if="n.type === 'select'">
          <select>
            <option v-for="n, k in option">{{n.name}}</option>
          </select>
        </template>
        <template v-else-if="n.type === 'text'">
          <template v-if="n.unit === ''">
            <input :type="n.type" :placeholder="n.placeholder" class="cover"/>
          </template>
          <template v-else>
            <div class="rightblock">
              <input :type="n.type" :placeholder="n.placeholder"/>
              <span>{{n.unit}}</span>
            </div>
          </template>
        </template>
        <template v-else>
          <template v-if="n.price === '¥'">
            <span class="tespan">{{n.price}} {{n.placeholder}} {{n.unit}}</span>
          </template>
          <template v-else>
            <span class="tespan">{{n.placeholder}} {{n.unit}}</span>
          </template>
        </template>
      </div>
      <div class="fromone">
        <label>开始时间和结束时间</label>
        <DatePickerr v-model="value3" type="datetimerange" range-separator="至" start-placeholder="开始日期" end-placeholder="结束日期">
        </DatePickerr>
      </div>
      <button>计算</button>
     </form>
     <h2>预期利润概览</h2>
     <div class="total">
         <p v-for="n, k in totallist">
             <template v-if="n.prev==='¥'">
               <span class="p_left">{{n.title}}</span>
               <span class="p_right">{{n.prev}}</span>
             </template>
             <template v-else-if="n.next==='%'">
               <span class="p_left">{{n.title}}</span>
               <span class="p_right">{{n.next}}</span>
             </template>
         </p>
     </div>
  </div>
</template>

<script>
  export default {
    data () {
      return {
        totallist: [{title: '总利润', prev: '¥'}, {title: '总收入', prev: '¥'}, {title: '总电费', prev: '¥'}, {title: '总矿机成本', prev: '¥'}, {title: '每T价格', prev: '¥'}, {title: '投资回报率', next: '%'}, {title: '当前每日收入', prev: '¥'}, {title: '当前每日电费', prev: '¥'}, {title: '当前每日利润', prev: '¥'}],
        value3: [new Date(2000, 10, 10, 10, 10), new Date(2000, 10, 11, 10, 10)],
        option: [{name: 'CNY - $'}, {name: 'USD - $'}],
        fromlists: [{label: '币种', type: 'select', unit: '', placeholder: ''}, {label: '单台矿机价格', type: 'text', unit: '', placeholder: '10900'}, {label: '矿机数量', type: 'text', unit: '', placeholder: '1'}, {label: '矿机算力', type: 'text', unit: 'TH/s', placeholder: '2'}, {label: '矿机功耗', type: 'text', unit: 'W', placeholder: '1025'}, {label: '每T功耗', type: '', unit: 'W/T', placeholder: '5263250'}, {label: '每T价格', type: '', unit: '/T', placeholder: '221', price: '¥'}, {label: '电费', type: 'text', placeholder: '0.32', unit: '¥/KWh'}, {label: '币价', type: 'text', placeholder: '32', unit: '¥/BTC'}, {label: '起始难度', placeholder: '125488', unit: '', type: 'text'}, {label: '每T收益', type: 'text', placeholder: '0.352', unit: ''}]
      }
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
      margin-bottom: 10px;
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

