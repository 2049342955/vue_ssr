import api from '@/util/function'
import { fetchApiData } from '@/util'
export function alipay (url, data) {
  if (api.checkWechat()) {
    api.tips('请在浏览器里打开')
    return false
  }
  data.subject = encodeURIComponent(data.subject)
  fetchApiData(this, 'alipay_wap', Object.assign({is_mobile: +this.isMobile, url: url, token: this.token}, data), (resData) => {
    location.href = resData.url
  })
}
export function paySuccess (url, data, btn) {
  if (this.payNo === 2) {
    this.alipay(url, data)
    btn.removeAttribute('disabled')
  } else {
    api.tips('恭喜您购买成功！', () => {
      if (this.addressObject) {
        api.setStorge('info', {addressData: this.addressObject})
      }
      this.$router.push({path: '/miner/paySuccess'})
    })
  }
}
export function openMask (n) {
  document.body.style.overflow = 'hidden'
  window.scroll(0, 0)
  this.edit = n
  this.contract = ''
  if (n === 1) {
    this.contract = this.content1 ? this.content + '<br>' + this.content1 : this.content
    this.title = '协议详情'
  } else if (n === 3) {
    this.title = '支付方式'
  }
}
export function closeMask () {
  document.body.style.overflow = 'auto'
  this.edit = false
}
