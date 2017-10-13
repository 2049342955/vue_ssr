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
    risk: '',
    bindAddress: ''
  }
}

export default new Vuex.Store({
  state,
  actions,
  mutations
})
