<template>
  <section class="address">
    <h2>地址管理</h2>
    <div class="address_box">
      <div class="item" v-for="a,k in data">
        <span class="address_item" @click="selectAddress(k)">{{a.province_name+a.city_name+a.area_name+a.area_details+'('+a.post_user+' 收) '+a.post_mobile}}</span>
        <span v-if="a.is_default">默认地址</span>
        <span class="set_default" v-else @click="setDefault(a.id)">设为默认</span>
        <span class="set_default" @click="openMask(k)">编辑</span>
        <span class="set_default" @click="deleteAddress(a.id,k)">删除</span>
      </div>
      <div class="address_btn" @click="openMask">添加新地址</div>
    </div>
    <div class="nodata" v-if="show">
      <div class="nodata_img"></div>
      <p>暂无列表信息</p>
    </div>
    <MyMask :form="address" :val="addressData" v-if="show"></MyMask>
  </section>
</template>

<script>
  import util from '@/util'
  import api from '@/util/function'
  import MyMask from '@/components/common/AddressMask'
  import { mapState } from 'vuex'
  export default {
    components: {
      MyMask
    },
    data () {
      return {
        address: [{name: 'post_user', type: 'text', title: '姓名', placeholder: '请输入姓名', isChange: true}, {name: 'post_mobile', type: 'text', title: '手机号码', placeholder: '请输入手机号码', pattern: 'tel'}, {name: 'address', type: 'select', title: '地址', isChange: true}, {name: 'area_details', type: 'text', title: '详细地址', placeholder: '请输入详细地址', isChange: true}, {name: 'is_default', type: 'radio', title: '是否设为默认地址'}],
        data: [],
        addressData: {},
        show: false
      }
    },
    methods: {
      setDefault (id, k) {
        var self = this
        util.post('setDefault', {sign: api.serialize({token: this.$parent.token, post_id: id})}).then(function (res) {
          api.checkAjax(self, res, () => {
            api.tips('设置成功')
            self.fetchData()
          })
        })
      },
      submit (e) {
        var form = e.target
        var data = api.checkFrom(form)
        var url = ''
        var strTips = ''
        if (!data) return false
        data.is_default = 1
        data.token = this.token
        data.is_default = +form.is_default.checked
        if (!this.addressData.id) {
          url = 'addAddress'
          strTips = '添加成功'
        } else {
          url = 'modifyAddress'
          data.post_id = this.addressData.id
          strTips = '编辑成功'
        }
        var self = this
        util.post(url, {sign: api.serialize(data)}).then(function (res) {
          api.checkAjax(self, res, () => {
            self.fetchData()
            api.tips(strTips)
            self.closeEdit(self.isMobile)
          }, form.btn)
        })
      },
      deleteAddress (id, k) {
        var self = this
        util.post('deleteAddress', {sign: api.serialize({token: this.$parent.token, post_id: id})}).then(function (res) {
          api.checkAjax(self, res, () => {
            api.tips('删除成功')
            self.fetchData()
          })
        })
      },
      openMask (k) {
        this.addressData = {}
        document.body.style.overflow = 'hidden'
        this.show = true
        if (this.data[k]) {
          this.addressData = this.data[k]
        }
      },
      closeEdit (mobile) {
        document.body.style.overflow = 'auto'
        this.show = false
      },
      fetchData () {
        var self = this
        util.post('showAddress', {sign: api.serialize({token: this.token, user_id: this.user_id})}).then(function (res) {
          api.checkAjax(self, res, () => {
            self.data = res
          })
        })
      },
      getList () {
        this.fetchData()
      }
    },
    watch: {
      '$route': 'fetchData'
    },
    mounted () {
      this.fetchData()
    },
    computed: {
      ...mapState({
        token: state => state.info.token,
        user_id: state => state.info.user_id
      })
    }
  }
</script>

<style type="text/css" lang="scss">
  @import '../../assets/css/style.scss';
  .address{
    padding:0 15px;
    h2{
      padding:0 15px !important;
    }
    .address_box{
      @include address_data
      .item{
        padding:10px 40px;
        cursor: initial;
        .address_item{
          width:70%;
        }
      }
      .address_btn{
        margin-left:40px;
      }
    }
    @include nodata
  }
</style>
