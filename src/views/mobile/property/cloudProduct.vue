<template>
  <div class="cloud_product">
    <div class="form_title">
      <span v-for="item in formTitle">{{item}}</span>
    </div>
    <div class="form_none"></div>
    <scroll-list class="form_content" @loadMore="loadMore" :more="len>1" :noData="show">
      <section v-for="item in formData" class="form_item">
        <span class="name">{{item.product_name}}</span>
        <span class="count">{{item.buy_amount}}台</span>
        <span class="count_suanli">{{item.total_hash}}T</span>
      </section>
    </scroll-list>
  </div>
</template>

<script>
  import util from '@/util'
  import { mapState } from 'vuex'
  import ScrollList from '@/components/common/ScrollList'

  export default {
    name: 'cloudProduct',
    components: {
      ScrollList
    },
    data () {
      return {
        formTitle: ['产品名称', '数量', '算力'],
        now: 1,
        show: false,
        totalNumber: 0,
        formData: [],
        len: 0,
        loading: false
      }
    },
    methods: {
      getData () {
        util.post('fundOrder', {token: this.token, type: 0, status: 1, page: this.now}).then(res => {
          this.len = res.msg.total_num
          for (let i = 0, len = res.msg.list.length; i < len; i++) {
            this.formData.push(res.msg.list[i])
          }
          this.totalNumber = res.msg.total_num
          if (this.now > 1) return false
          this.show = !this.formData.length
        })
      },
      loadMore () {
        if (this.formData.length < this.len) {
          this.loading = true
          this.now ++
          this.getData()
          setTimeout(() => {
            this.loading = false
          }, 1000)
        } else {
          this.loading = false
        }
      }
    },
    mounted () {
      this.getData()
    },
    computed: {
      ...mapState({
        token: state => state.info.token
      })
    }
  }
</script>

<style type="text/css" lang="scss">
  .cloud_product {
    width: 100%;
    font-size: 0.3rem;
    padding: 0.88rem 0.3rem 0;
    .form_title {
      @include flex(space-start, center);
      color: #666;
      height: 0.75rem;
      span:nth-child(1) {
        width: 50%;
      }
      span:nth-child(2) {
        width: 35%;
      }
      span:nth-child(3) {
        width: 15%;
      }
    }
    .form_none {
      height: 0.2rem;
      margin: 0 -0.3rem;
      background: #f5f5f9;
    }
    .form_content {
      .form_item {
        @include flex(space-start, center);
        height: 1rem;
        border-bottom: solid 1px #e5e5e5;
        .name {
          width: 50%;
          font-weight: bold;
          color: #333;
        }
        .count, .count_suanli {
          width: 35%;
          color: #999;
        }
        .count_suanli {
          width: 15%;
        }
      }
    }
    .load_more{
      height: 1.3rem;
      text-align: center;
      line-height: 1.3rem;
    }
  }
</style>
