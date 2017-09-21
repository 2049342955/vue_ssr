export default {
  getInfo ({commit, state}) {
    if (!state.token) return false
    // api.get('/user/detail', state.token).then((res) => {
    //   commit('setInfo', res.data)
    // })
  }
}
