function getTitle (vm) {

  const { meta } = (vm&&vm.$route&&vm.$route||{});
  const title = meta&&meta.title;
  return title;
  /*console.log()
  if (title) {
    return typeof title === 'function'
      ? title.call(vm)
      : title
  }*/
}

const serverTitleMixin = {
  created () {
    const title = getTitle(this)
    if (title&&this&&this.$ssrContext) {
      console.log(18,title,this.$ssrContext)
      //this.$ssrContext.title = `Vue HN 2.0 | ${title}`
    }
  }
}

export default serverTitleMixin
