<template>
  <aside class="pager" v-if="$parent.len>1">
    <span :class="{disabled:$parent.now<=1}" @click="getData($parent.now-1)">上一页</span>
    <template v-if="$parent.len<=7">
      <span v-for="i in $parent.len" :class="['pager_item', {active:i===$parent.now}]" @click="getData(i)">{{ i }}</span>
    </template>
    <template v-else>
      <span v-for="i in 3" :class="['pager_item', {active:i===$parent.now}]" @click="getData(i)">{{ i }}</span>
      <span v-if="$parent.leftSibling>4">...</span>
      <template v-if="$parent.now>3&&$parent.now<$parent.len-1">
        <span :class="['pager_item', {active:$parent.leftSibling===$parent.now}]" @click="getData($parent.leftSibling)">{{ $parent.leftSibling }}</span>
        <span :class="['pager_item', {active:$parent.rightSibling===$parent.now}]" @click="getData($parent.rightSibling)">{{ $parent.rightSibling }}</span>
      </template>
      <span v-if="$parent.rightSibling<$parent.len-2">...</span>
      <span :class="['pager_item', {active:$parent.len-1===$parent.now}]" @click="getData($parent.len-1)">{{ $parent.len-1 }}</span>
      <span :class="['pager_item', {active:$parent.len===$parent.now}]" @click="getData($parent.len)">{{ $parent.len }}</span>
    </template>
    <span :class="{disabled:$parent.now>=$parent.len}" @click="getData($parent.now+1,1)">下一页</span>
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
      getData (p, type) {
        if (p <= 0 || p > this.$parent.len) return false
        this.$parent.now = p
        if (type) {
          if (this.$parent.now >= this.$parent.len - 2) return false
          this.$parent.leftSibling = p
          this.$parent.rightSibling = this.$parent.leftSibling + 1
        } else {
          if (this.$parent.now <= 4) return false
          this.$parent.rightSibling = p
          this.$parent.leftSibling = this.$parent.rightSibling - 1
        }
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
    margin-bottom:50px
  }
</style>
