import axios from 'axios'
import qs from 'qs'

let api = axios.create({
  // baseURL: 'http://suanli.baoquan.com/background/api',
  // baseURL: 'http://suanli1.baoquan.com/background/api/',
  baseURL: 'http://192.168.3.45/background/api/',
  headers: {'Content-Type': 'application/x-www-form-urlencoded'},
  responseType: 'json'
})
// 修改返回数据格式
api.defaults.transformResponse = (res) => {
  if (res.code === '2000') {
    return false
  }
  return res.msg
}

api.defaults.validateStatus = (status) => {
  return true
  // return status >= 200 && status < 300
}

api.interceptors.response.use(res => {
  if (res.status) {
    return res.data
  }
  return res
})

api.interceptors.request.use(config => {
  if (config.data) {
    if (config.data['sign']) {
      config.data['sign'] = btoa(config.data['sign'])
    }
    config.data = qs.stringify(config.data)
  }
  return config
}, error => {
  return Promise.reject(error)
})

export default api
