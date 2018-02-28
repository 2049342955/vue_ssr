<template>
  <div class="mobile_scroll_list">
    <div v-infinite-scroll="loadMore" infinite-scroll-disabled="loading" infinite-scroll-distance="10" class="item_box">
      <component :class="type" :is="type" v-for="n,k in data" :data="n" :key="k"></component>
    </div>
    <p v-if="loading"  class="loadmore">加载中······</p>
  </div>
</template>

<script>
  import Vue from 'vue'
  import { InfiniteScroll } from 'mint-ui'
  Vue.use(InfiniteScroll)
  import MobileMinerItem from '@/components/miner/MobileMinerItem'
  import MobileCloudMinerItem from '@/components/cloudCompute/MobileCloudMinerItem'
  export default {
    components: {
      MobileMinerItem, MobileCloudMinerItem
    },
    props: {
      data: {
        type: Array
      },
      len: {
        type: Number
      },
      now: {
        type: Number
      }
    },
    data () {
      return {
        loading: false,
        type: ''
      }
    },
    methods: {
      loadMore () {
        if (this.now < this.len) {
          this.loading = true
          this.$emit('getMobileData', 1)
          setTimeout(() => {
            this.loading = false
          }, 1000)
        } else {
          this.loading = false
        }
      }
    },
    mounted () {
      if (this.$route.name === 'minerList') {
        this.type = 'MobileMinerItem'
      } else {
        this.type = 'MobileCloudMinerItem'
      }
    }
  }
</script>
