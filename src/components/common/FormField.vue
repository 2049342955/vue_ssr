<template>
  <div class="form_field">
    <div :class="['input', {addon: f.addon}, {disabled: f.edit}]" v-for="f in form">
      <template v-if="!f.edit">
        <span>{{f.title}}</span>
        <span>*</span>
        <template v-if="f.type!=='select'">
          <input type="text" :name="f.name" autocomplete="off" :placeholder="f.placeholder" @blur="test" :pattern="f.pattern" data-status="" v-if="f.type==='password'" @focus="$event.target.type='password'">
          <input :type="f.type" :name="f.name" autocomplete="off" :placeholder="f.placeholder" @blur="test" :pattern="f.pattern" data-status="" :isChange="f.isChange" v-else-if="f.changeEvent" @change="$parent.$parent.onChange($event,f.name)">
          <input :type="f.type" :name="f.name" autocomplete="off" :placeholder="f.placeholder" @blur="test" :pattern="f.pattern" data-status="" :isChange="f.isChange" v-else :maxlength="f.len">
          <div class="tips_info" v-if="f.tipsInfo">
            <span>{{f.tipsUnit}}</span>
            <span v-if="f.tipsInfo!=='show'">{{f.tipsInfo}}：{{$parent.$parent[f.name]|decimal}}{{f.tipsUnit}}</span>
          </div>
        </template>
        <div class="sel" v-else-if="f.option">
          <select :name="f.name" id="">
            <template v-if="f.name==='product_hash_type'">
              <option :value="v.name" v-for="v,k in hashType">{{v.name}}</option>
            </template>
            <template v-else>
              <option :value="v" v-for="v,k in f.option">{{v}}{{f.unit}}</option>
            </template>
          </select>
        </div>
        <div class="select" v-else>
          <select name="province_name" id="" @change="changeCity" :isChange="true">
            <option :value="v.name" v-for="v,k in province" :selected="p===v.name">{{v.name}}</option>
          </select>
          <select name="city_name" id="" @change="changeCounty" :isChange="true">
            <option :value="v.name" v-for="v,k in city" :selected="c===v.name">{{v.name}}</option>
          </select>
          <select name="area_name" id="" :isChange="true">
            <option :value="v.name" v-for="v,k in county" :selected="n===v.name">{{v.name}}</option>
          </select>
        </div>
        <template v-if="f.addon">
          <canvas id="code" width="90" height="40" v-if="f.addon===1" @click="changeCode"></canvas>
          <div ref="count_btn" class="btn" v-if="f.addon===2" @click="getCode">{{str}}</div>
        </template>
        <span :title="f.tips" :tips="f.placeholder" :error="f.error" :success="f.success"></span>
      </template>
      <template v-else-if="f.edit==='disabled'">
        <span>{{f.title}}</span>
        <span>*</span>
        <input :type="f.type" :name="f.name" :value="mobile" disabled>
      </template>
      <template v-else>
        <span>{{f.title}}</span>
        <span>*</span>
        <input :type="f.type" :name="f.name" :value="$parent[f.name]||$parent.$parent[f.name]" disabled v-if="f.name!=='bank_card'" :isChange="f.isChange">
        <input :type="f.type" :name="f.name" :value="$parent[f.name]&&$parent[f.name].card_no&&$parent[f.name].card_no|cardformat" disabled v-else>
        <div class="tips_info" v-if="f.tipsInfo">
          <span>{{f.tipsUnit}}</span>
          <span v-if="f.showUse">{{f.tipsInfo+':'+$parent.$parent.have_use_time+f.tipsUnit}}</span>
        </div>
        <div class="show_link" v-if="f.showLink">
          <router-link :to="f.showLink">更换银行卡</router-link>
        </div>
      </template>
    </div>
  </div>
</template>

<script>
  import util from '@/util/index'
  import api from '@/util/function'
  import city from '@/util/city'
  import { mapState } from 'vuex'
  export default {
    name: 'form_field',
    props: {
      form: {
        type: Array
      }
    },
    data () {
      return {
        province: [],
        city: [],
        county: [],
        p: '',
        c: '',
        n: '',
        str: '获取验证码'
      }
    },
    mounted () {
      this.province = city
      this.setCity(this.p)
      this.setCounty(this.c)
      if (!document.querySelector('#code')) return false
      this.changeCode()
    },
    methods: {
      test (e) {
        var ele = e.target
        var ff = document.querySelector('.form')
        api.checkFiled(ele, ff)
      },
      changeCode () {
        var ele = document.querySelector('#code')
        localStorage.setItem('code', api.createCode(ele))
      },
      getCode () {
        var self = this
        var form = document.querySelector('.form')
        if (!api.checkCode(form)) return false
        if (self.$refs['count_btn'][0].getAttribute('disabled') === 'true') return false
        util.post('send_code', {sign: api.serialize({token: this.token, mobile: form.mobile.value})}).then(res => {
          api.setTips(form.code, 'success')
          self.conntDown()
          self.$refs['count_btn'][0].setAttribute('disabled', true)
        })
      },
      conntDown () {
        var self = this
        var t = 60
        var tt = setInterval(() => {
          if (t === 0) {
            self.str = '重新获取验'
            clearInterval(tt)
            self.$refs['count_btn'][0].setAttribute('disabled', false)
          } else {
            self.str = t + 's'
            t--
          }
        }, 1000)
      },
      selectCity (arr, value) {
        return arr.filter((v) => v.name === value)
      },
      changeCity (e) {
        this.setCity(e.target.value)
        this.setCounty(this.city[0].name)
      },
      changeCounty (e) {
        this.setCounty(e.target.value)
      },
      setCity (v) {
        this.p = v
        var cities = this.selectCity(city, v)
        cities = cities.length ? cities[0] : city[0]
        this.city = cities.city
      },
      setCounty (v) {
        this.c = v
        var counties = this.selectCity(this.city, v)
        counties = counties.length ? counties[0] : this.city[0]
        this.county = counties.county
      }
    },
    computed: {
      ...mapState({
        token: state => state.info.token,
        user_id: state => state.info.user_id,
        mobile: state => state.info.mobile,
        hashType: state => state.hashType
      })
    },
    filters: {
      cardformat: api.cardReadable,
      decimal: api.decimal
    }
  }
</script>
