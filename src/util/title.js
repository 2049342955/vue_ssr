import webSeo from './webSeo'
function getTitle (vm) {
  const { title } = vm.$options
  if (title) {
    return typeof title === 'function'
      ? title.call(vm)
      : title
  }
}

const serverTitleMixin = {
  created () {
    const name = getTitle(this)
    if (name) {
      this.$ssrContext.title = webSeo[name].title
      this.$ssrContext.desc = webSeo[name].desc || '算力网（www.suanli.com）是比特币挖矿一站式服务平台，拥有专业的挖矿及运营团队，目前拥有矿机托管，矿场投资，算力出售，算力转让等业务，切实为比特币挖矿爱好者提供一站式贴心服务。'
      this.$ssrContext.keywords = webSeo[name].keywords || '算力,挖矿,比特币,矿机,算力资讯,矿场,BDC托管,无忧挖矿'
    }
  }
}

const clientTitleMixin = {
  mounted () {
    const name = getTitle(this)
    if (name) {
      document.title = webSeo[name].title
      document.querySelector('meta[name="keywords"]').setAttribute('content', webSeo[name].keywords || '算力,挖矿,比特币,矿机,算力资讯,矿场,BDC托管,无忧挖矿')
      document.querySelector('meta[name="description"]').setAttribute('content', webSeo[name].desc || '算力网（www.suanli.com）是比特币挖矿一站式服务平台，拥有专业的挖矿及运营团队，目前拥有矿机托管，矿场投资，算力出售，算力转让等业务，切实为比特币挖矿爱好者提供一站式贴心服务。')
    }
  }
}

export default process.env.VUE_ENV === 'server'
  ? serverTitleMixin
  : clientTitleMixin
