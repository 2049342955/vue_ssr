require('es6-promise').polyfill()
import axios from 'axios'
import qs from 'qs'
import util from './function'

let api = axios.create({
<<<<<<< HEAD
  baseURL: 'http://www.suanli.local/background/api',
  // baseURL: 'http://192.168.3.45/background/api/',
=======
  // baseURL: 'https://www.suanli.com/bsackground/api',
  // baseURL: 'http://www.suanli.me/bsackground/api',
  baseURL: 'http://192.168.3.45/background/api/',
>>>>>>> 8ddc3fa884286280bb003b8612b48d0048372f76
  headers: {'Content-Type': 'application/x-www-form-urlencoded'},
  responseType: 'json'
})
// 修改返回数据格式
api.defaults.transformResponse = (res) => {
  if (typeof res === 'string') {
    res = JSON.parse(res)
  }
  if (res.code === '1000') {
    return res.msg
  } else if (res.code === '600001') {
    return 'repeatLogin'
  } else if (res.code === '100001') {
    return 'overtime'
  } else {
    return res
  }
}

api.defaults.validateStatus = (status) => {
  return true
  // return status >= 200 && status < 300
}

api.interceptors.response.use(res => {
  console.log(res)
  if (res.status) {
    return res.data
  }
  return res
})

api.interceptors.request.use(config => {
  if (config.data) {
    if (config.data['sign']) {
      if (window.btoa) {
        config.data['sign'] = window.btoa(config.data['sign'])
      } else {
        config.data['sign'] = util.btoa(config.data['sign'])
      }
    }
    config.data = qs.stringify(config.data)
  }
  return config
}, error => {
  return Promise.reject(error)
})

export default api
