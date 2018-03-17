import util from '@/util/index'

export function getList (more, callback) {
  util.post(this.dataUrl, {token: 0, page: this.now}).then((res) => {
    if (more) this.list = this.list.concat(res.msg.list)
    else this.list = res.msg.list
    if (callback) {
      this.loading = false
      callback()
    }
    if (this.now > 1) return false
    if (!this.list.length) this.noData = true
    localStorage.setItem('all_id', JSON.stringify(res.msg.id_list))
    this.len = Math.ceil(res.msg.total / this.perNum)
  })
}

export function setPage (n) {
  this.now = n
  this.getList()
}

export function loadMore (callback) {
  if (this.now < this.len) {
    this.loading = true
    this.now++
    this.getList(1, callback)
  } else {
    this.loading = false
  }
}
