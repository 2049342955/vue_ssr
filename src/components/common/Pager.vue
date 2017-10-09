<template>
  <aside class="pager" v-if="$parent.len>1">
    <span :class="{disabled:$parent.now<=1}" @click="getData($parent.now-1)">&lt;</span>
    <span v-for="i in $parent.len" :class="{active:i===$parent.now}" @click="getData(i)">{{ i }}</span>
    <span :class="{disabled:$parent.now>=$parent.len}" @click="getData($parent.now+1)">&gt;</span>
  </aside>
</template>

<script>
  // import util from '@/util'
  export default {
    name: 'pager',
    props: {
      type: {
        type: String
      }
    },
    methods: {
      getData (p) {
        if (p <= 0 || p > this.$parent.len) return false
        this.$parent.now = p
        switch (this.type) {
          case 'message':
            // util('/goods/list', {page: p, pageSize: 8, categoryType: this.$route.params.categoryNo}).then(res => {
            //   this.$parent.goods = res.list
            // })
            break
        }
      }
    }
  }
</script>

<style type="text/css" lang="scss">
  @import '../../assets/css/style.scss';
  .pager{
    @include pager
  }
</style>
