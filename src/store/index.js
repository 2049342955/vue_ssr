import Vue from 'vue'
import Vuex from 'vuex'
import actions from './actions'
import mutations from './mutations'

Vue.use(Vuex)

const state = {
  info: {
    user_id: '',
    mobile: '',
    token: 0,
    true_name: '',
    bank_card: '',
    risk: {user_risk_score: -1},
    address: [],
    trade_password: 0,
    unread_num: 0
  }
}

const getters = {
  menu: state => {
    var arr = [
      {opr: '已认证', status: 1, setting: false},
      {opr: '认证', status: 0, setting: true},
      {opr: '测评', status: 0, setting: true},
      {opr: '绑定', status: 0, setting: true},
      {opr: '添加地址', status: 0, setting: true},
      {opr: '修改', status: 1, setting: true},
      {opr: '设置', status: 0, setting: true}
    ]
    var tipInfo = ['正在审核', '认证成功', '认证不一致', '无结果']
    if (state.info.true_name) {
      arr[1].status = state.info.true_name.status > 1 ? 0 : 1
      arr[1].opr = state.info.true_name.status > 1 ? tipInfo[state.info.true_name.status] + ' 请重新认证' : tipInfo[state.info.true_name.status]
      arr[1].setting = state.info.true_name.status > 1
    }
    if (state.info.bank_card) {
      arr[3].status = 1
      arr[3].opr = '重新绑定'
    }
    if (state.info.risk.user_risk_score > 0) {
      arr[2].status = 1
      arr[2].opr = '已测评'
      arr[2].setting = false
    }
    if (state.info.address.length) {
      arr[4].status = 1
    }
    if (state.info.trade_password) {
      arr[6].status = 1
      arr[6].opr = '重新设置'
    }
    return arr
  }
}

export default new Vuex.Store({
  state,
  getters,
  actions,
  mutations
})
