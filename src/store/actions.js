export default {
  getInfo ({commit, state}) {
    var data = localStorage.getItem('info')
    if (data) {
      state.info = JSON.parse(data)
    }
  }
}
