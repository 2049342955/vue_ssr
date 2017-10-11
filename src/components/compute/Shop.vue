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
          <div class="item" @click="setSort('all',$event)">默认</div>
          <div :class="['item', {active: edit==k}, {up: !s.value}]" v-for="s,k in sort" @click="setSort(k,$event)">{{s.title}}<span class="iconfont"></span></div>
        </div>
        <div class="data">
          <div class="item" v-for="d,k in computeDate">
            <h3>{{d.title}}<span class="icon_img"></span></h3>
            <div class="info_box">
              <template v-for="n,i in dataNav">
                <div class="info">
                  <div class="text">
                    <span class="num">{{d[i]}}</span>
                    <span>{{n.unit}}</span>
                  </div>
                  <p>{{n.title}}</p>
                </div>
                <div class="line"></div>
              </template>
              <router-link class="btn" :to="'/cloudCompute/detail/'+d.id">立即购买</router-link>
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
        dataNav: {'price': {title: '每台服务器价格', unit: '元'}, 'hash': {title: '每台服务器算力', unit: 'T'}, 'number': {title: '出售服务器总数', unit: '台'}, 'leftNum': {title: '剩余可售服务器', unit: '台'}},
        edit: -1
      }
    },
    methods: {
      setSort (n, e) {
        this.edit = n
        var obj = this.sort[n]
        var str = ''
        for (let ele of this.sort) {
          if (obj !== ele) {
            ele.value = 0
          }
        }
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
      padding-bottom:50px;
      .box{
        @include main
        .sort{
          background: $white;
          padding:10px 25px;
          color:$light_text;
          @include flex
          border: 1px solid $border;
          .item{
            cursor: pointer;
            padding:0 30px;
            line-height: 40px;
            background: #f7f8fa;
            & + .item{
              margin-left:50px
            }
            .iconfont{
              @include block(24)
              vertical-align: middle;
              transition:all .3s;
              &:before{
                font-size: 24px;
                content:'\e60e'
              }
            }
            &.active{
              color:$blue
            }
            &.up{
              .iconfont{
                transform:rotate(180deg)
              }
            }
          }
        }
        .data{
          .item{
            padding:30px 50px;
            background: $white;
            h3{
              font-size: 18px;
              margin-bottom:10px;
              .icon_img{
                @include block(18)
                margin-left:5px;
                background: url('../../assets/images/css_sprites.png') -152px -209px;
              }
            }
            .info_box{
              @include flex(space-between)
              .info{
                .text .num{
                  font-size: 24px;
                }
                &:first-child{
                  .text{
                    color: $orange
                  }
                }
                p{
                  color: $light_black;
                }
              }
              .line{
                width:1px;
                height: 50px;
                background: $border
              }
              .btn{
                width:145px;
                color: $orange;
                text-align: center;
                line-height: 48px;
                border-radius:5px;
              }
            }
            &:not(:last-child){
              margin-bottom:10px;
            }
            &:hover{
              background: #f4f4f4;
              .btn{
                @include button($orange)
              }
            }
          }
        }
      }
    }
  }
</style>
