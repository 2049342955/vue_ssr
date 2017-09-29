<template>
  <div class="cloud_list">
    <h2>
      <span>云矿机推荐</span>
      <span>由保全网提供存证、保全服务</span>
      <router-link to="/cloudCompute/shop">更多云矿机 ></router-link>
    </h2>
    <table>
      <tr>
        <th v-for="n in nav">{{n}}</th>
      </tr>
      <tr v-for="l in list">
        <td v-for="v,k in l" v-if="k!=='status'">
          <template v-if="k==='name'"><i class="iconfont" v-if="l.status">&#xe605;</i><i class="zhanwei" v-else></i>{{v}}</template>
          <template v-else-if="k==='num'">{{v}}台</template>
          <template v-else-if="k==='price'">{{v|format}}元</template>
          <template v-else-if="k==='opr'"><a href="">{{v}}</a></template>
          <template v-else>{{v}}</template>
        </td>
      </tr>
    </table>
  </div>
</template>

<script>
  import api from '../../util/function'
  export default {
    name: 'chart',
    data () {
      return {
        nav: ['项目名称', '出售总数', '购买单价', '最小购买单位', '每台算力', '算力类型', '项目进度', '操作'],
        list: [{name: 'Avalon(阿瓦隆A6)', num: 100, price: 12000, unit: '1台', compute: '9T', computeType: 'BTC', progress: '80%', opr: '申购', status: 'hot'}, {name: 'Avalon(阿瓦隆A6)', num: 100, price: 12000, unit: '1台', compute: '9T', computeType: 'BTC', progress: '80%', opr: '申购', status: 'hot'}, {name: 'Avalon(阿瓦隆A6)', num: 100, price: 12000, unit: '1台', compute: '9T', computeType: 'BTC', progress: '80%', opr: '申购', status: 'hot'}, {name: 'Avalon(阿瓦隆A6)', num: 100, price: 12000, unit: '1台', compute: '9T', computeType: 'BTC', progress: '80%', opr: '申购'}, {name: 'Avalon(阿瓦隆A6)', num: 100, price: 12000, unit: '1台', compute: '9T', computeType: 'BTC', progress: '80%', opr: '申购'}]
      }
    },
    filters: {
      format: api.readable
    }
  }
</script>

<style type="text/css" lang="scss">
  @import '../../assets/css/style.scss';
  .cloud_list{
    @include main
    margin-bottom:60px;
    h2{
      @include flex
      @include gap(15,v,margin)
      span:nth-child(1){
        font-size: 24px;
        font-weight: bold;
      }
      span:nth-child(2){
        margin-left:20px;
        font-size: 16px;
        background: linear-gradient(to right, #b28850, #cfa972);
        color:$white;
        padding:3px 10px
      }
      a{
        font-size: 16px;
        flex:1;
        text-align: right;
        color:#999;
        &:hover{
          color:$blue
        }
      }
    }
    table{
      width:100%;
      text-align: center;
      th{
        font-weight: normal;
        font-size: 18px;
        line-height: 65px;
        background: #ecf3ff
      }
      td{
        font-size: 16px;
        color:$light_text;
        line-height: 75px;
        border-bottom: 1px solid $border;
        .iconfont{
          color:$orange;
          font-size: 24px
        }
        .zhanwei{
          padding-left:24px
        }
      }
      tr:not(:first-child){
        &:hover{
          background: #f4f4f4
        }
        td:nth-child(3),a{
          color:$orange
        }
        td:last-child{
          a{
            width:130px;
            padding:5px 25px;
            border-radius:5px
          }
        }
        &:hover a{
          background:$orange;
          color:$white
        }
      }
    }
  }
</style>