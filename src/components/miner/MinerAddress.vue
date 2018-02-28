<template>
  <div class="pay_address">
    <div class="pc_pay_address" v-if="isMobile===0">
      <h3 class="title">选择收货地址</h3>
      <div class="address_box">
        <div :class="['item',{active:a.id===addressObject.id}]" v-for="a,k in showAll?addressData:addressData.slice(0, 3)">
          <span @click="selectAddress(k)">{{a.province_name+a.city_name+a.area_name+a.area_details+'('+a.post_user+' 收) '+a.post_mobile}}</span>
          <span v-if="a.is_default">默认地址</span>
          <span class="set_default" v-else @click="setDefault(a.id)">设为默认地址</span>
        </div>
        <div class="address_btn" @click="openMask(2)">使用新地址</div>
        <div class="all_address_btn" @click="showAll=!showAll" v-if="addressData.length>3">{{showAll?'收起':'查看所有地址'}}</div>
      </div>
    </div>
    <div class="mobile_pay_address" v-if="isMobile===1">
      <div class="address_box" @click="selectAddress" v-if="addressObject.id">
        <h3 :class="{active:addressObject.is_default}">收货人地址：{{addressObject.post_user+'  '+addressObject.post_mobile}}</h3>
        <p>{{addressObject.province_name+addressObject.city_name+addressObject.area_name+addressObject.area_details}}</p>
      </div>
      <div class="address_btn" @click="selectAddress" v-else>使用新地址</div>
      <div class="address_text" v-if="addressObject.id">配送费用：第三方物流、费用到付</div>
    </div>
  </div>
</template>

<script>
  import api from '@/util/function'
  import { fetchApiData } from '@/util/index'
  import { mapState } from 'vuex'
  export default {
    props: {
      addressObject: {
        type: Object
      },
      addressData: {
        type: Array
      }
    },
    data () {
      return {
        showAll: 0
      }
    },
    methods: {
      selectAddress (k) {
        this.$emit('selectAddress', k)
      },
      setDefault (id) {
        fetchApiData(this, 'setDefault', {token: this.token, post_id: id}, (res) => {
          api.tips('设置成功')
          this.$emit('getAddress')
        })
      },
      openMask (k) {
        this.$emit('openMask', k)
      }
    },
    computed: {
      ...mapState({
        token: state => state.info.token,
        isMobile: state => state.isMobile
      })
    }
  }
</script>

<style type="text/css" lang="scss">
  .pay_address{
    .pc_pay_address {
      .address_box {
        @include address_data
        .item{
          background: #FAFAFA;
          &.active,&:hover{
            background: #EFF6FE;
          }
        }
        .all_address_btn{
          float: right;
          margin-top:20px;
          font-size: 12px;
          color:$blue;
          cursor: pointer;
          padding-right:15px;
        }
      }
    }
    .mobile_pay_address {
      padding: 15px 0.3rem;
      background: #fff;
      margin-bottom: 0.2rem;
      .address_box:before,.address_box:after,.address_btn:after {
        @include position(13,auto,auto,0)
      }
      .address_box:after,.address_btn:after {
        content:'';
        @include block(8)
        @include arrow
      }
      .address_box {
        position: relative;
        padding-bottom: 10px;
        &:before {
          left: -5px;
          right: auto;
          font-family: "iconfont" !important;
          content: '\e641';
          font-size: 20px;
        }
        &:after {
          top: 20px;
        }
        h3,p {
          margin-left: 15px;
          font-size: 0.3rem;
        }
        h3{
          position: relative;
          &.active:after{
            content:'默认';
            @include position(10,auto,auto,25)
            font-size: 12px;
            font-weight: normal;
            border:1px solid $orange;
            border-radius:3px;
            padding:0 8px;
            color:$orange
          }
        }
        p{
          @include ellipsis(2)
        }
      }
      .address_btn:after {
        top:23px
      }
      .address_text {
        font-size: 12px;
        color: $light_text;
        border-top: 1px solid $border;
        padding-top: 10px;
      }
    }
  }
</style>
