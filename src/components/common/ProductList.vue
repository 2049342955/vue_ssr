<template>
  <section class="product_list">
    <div class="box">
      <div class="sort">
        <div class="item" @click="setSort('all',$event)">默认</div>
        <div :class="['item', {active: edit==k}, {up: !s.value}]" v-for="s,k in sort" @click="setSort(k,$event)">{{s.title}}<span class="iconfont"></span></div>
      </div>
      <div class="data">
        <div class="item" v-for="d,k in $parent.computeDate">
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
            <router-link class="btn" :to="'/'+page+'/detail/'+d.id">立即购买</router-link>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
  export default {
    props: {
      sort: {
        type: Array
      },
      dataNav: {
        type: Object
      },
      page: {
        type: String
      }
    },
    data () {
      return {
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
        this.$router.push({path: '/' + this.page + '/list/' + this.$route.params.type + '/' + str})
      }
    }
  }
</script>
<style type="text/css" lang="scss">
  @import '../../assets/css/style.scss';
  .product_list{
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
</style>
