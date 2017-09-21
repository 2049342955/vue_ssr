import { SET_TOKEN, LOGOUT, SET_INFO } from './mutation-types'

export default {
  [SET_TOKEN] (state, res) {
    state.token = res
    localStorage.setItem('token', res)
  },
  [LOGOUT] (state) {
    state.token = ''
    state.info = {}
    state.collection = []
    state.collectNum = 0
    localStorage.removeItem('token')
  },
  [SET_INFO] (state, payload) {
    state.info = payload
  }
}
