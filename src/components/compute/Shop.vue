<template>
  <section class="compute_shop">
    <div class="bg_box">
      <div class="bg"></div>
    </div>
    <div class="miner_nav">
      <router-link class="item" :to="'/cloudCompute/shop/'+(k+1)+'/'+$route.params.sort" v-for="n,k in nav" :key="k">
        <span :class="['iconfont', 'icon'+k]"></span>
        <span>{{n}}</span>
      </router-link>
    </div>
    <div class="miner_list">
      <div class="box">
        <div class="sort">
          <div class="item" @click="setSort('all')">默认</div>
          <div class="item" v-for="s,k in sort" @click="setSort(k)">{{s.title}}</div>
        </div>
        <div class="data">
          <div class="item" v-for="d,k in computeDate">
            <h3>{{d.title}}</h3>
            <div class="info_box">
              <div class="info" v-for="n,i in dataNav">
                <div class="info_item">
                  <div>
                    <span class="num">{{d[i]}}</span>
                    <span>{{n.unit}}</span>
                  </div>
                  <p>{{n.title}}</p>
                </div>
                <div class="line"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
  export default {
    data () {
      return {
        nav: ['BTC挖矿', 'BCC挖矿', 'ETH挖矿', 'ETC挖矿'],
        sort: [{title: '价格', option: ['price_asc', 'price_desc'], value: 0}, {title: '算力', option: ['base_asc', 'base_desc'], value: 0}, {title: '出售总数', option: ['num_asc', 'num_desc'], value: 0}],
        computeDate: [{id: 1, title: '阿瓦隆001号', type: 'btc', price: 10000, hash: '9.0', number: 500, leftNum: 199}, {id: 1, title: '阿瓦隆001号', type: 'btc', price: 10000, hash: '9.0', number: 500, leftNum: 199}, {id: 1, title: '阿瓦隆001号', type: 'btc', price: 10000, hash: '9.0', number: 500, leftNum: 199}, {id: 1, title: '阿瓦隆001号', type: 'btc', price: 10000, hash: '9.0', number: 500, leftNum: 199}, {id: 1, title: '阿瓦隆001号', type: 'btc', price: 10000, hash: '9.0', number: 500, leftNum: 199}, {id: 1, title: '阿瓦隆001号', type: 'btc', price: 10000, hash: '9.0', number: 500, leftNum: 199}],
        dataNav: {'price': {title: '每台服务器价格', unit: '元'}, 'hash': {title: '每台服务器算力', unit: 'T'}, 'number': {title: '出售服务器总数', unit: '台'}, 'leftNum': {title: '剩余可售服务器', unit: '台'}}
      }
    },
    methods: {
      setSort (n) {
        var obj = this.sort[n]
        var str = ''
        if (obj) {
          obj.value = +(!obj.value)
          str = obj.option[obj.value]
        } else {
          str = 'all'
        }
        this.$router.push({path: '/cloudCompute/shop/' + this.$route.params.type + '/' + str})
      }
    }
  }
</script>

<style type="text/css" lang="scss">
  @import '../../assets/css/style.scss';
  @import '../../assets/fonts/iconfont.css';
  .compute_shop{
    .bg_box{
      @include bg(1920,420px,#12161d)
      z-index: -1;
      .bg{
        background:url(../../assets/images/cloudCompute.jpg) no-repeat;
      }
    }
    .miner_nav{
      position: relative;
      z-index: 1;
      margin-top:-40px;
      line-height: 60px;
      @include main
      @include gap(70,h)
      @include flex(space-between)
      background: $white;
      box-shadow:5px 10px 15px 0px rgba(50, 127, 255, 0.12);
      .item{
        color: $text;
        font-size: 18px;
        cursor: pointer;
        border-bottom:2px solid transparent;
        @include gap(10,h)
        &:hover,&.router-link-active{
          color:$blue;
          border-bottom:2px solid $blue
        }
        .iconfont{
          @include block(36)
          vertical-align: middle;
          &:before{
            font-size: 36px
          }
          &.icon0:before{
            content: "\e62d"
          }
          &.icon1:before{
            content: "\e6ad"
          }
          &.icon2:before{
            content: "\e60f"
          }
          &.icon3:before{
            content: "\e60d"
          }
        }
      }
    }
    .miner_list{
      margin-top:-20px;
      background: #f7f8fa;
      padding-top:50px;
      .box{
        @include main
        .sort{
          background: $white;
          padding:10px 25px;
          @include flex
          border: 1px solid $border;
          .item{
            cursor: pointer;
            padding:10px 30px;
            background: #f7f8fa;
            & + .item{
              margin-left:50px
            }
          }
        }
        .data{
          .item{
            background: $white;
            h3{
              font-size: 18px;
            }
            .info_box{
              @include flex(space-between)
              .info{
                
              }
            }
          }
        }
      }
    }
  }
</style>
