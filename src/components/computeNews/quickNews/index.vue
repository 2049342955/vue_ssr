<template>
  <pageFrame isComponent="true">
    <pquick-news v-if="!isMobile"></pquick-news>
    <mquick-news v-else></mquick-news>
  </pageFrame>
</template>

<script>
  import util from '@/util/index'
  import api from '@/util/function'
  import PquickNews from './pc'
  import MquickNews from './mobile'
  import { mapState } from 'vuex'
  import pageFrame from '../pageFrame'
  export default {
    components: {
      PquickNews, MquickNews, pageFrame
    },
    data () {
      return {
        newslists: []
      }
    },
    methods: {
      getList () {
        var self = this
        util.post('NewsBriefList', {sign: api.serialize({token: 0})}).then(function (res) {
          api.checkAjax(self, res, () => {
            self.newslists = res
          })
        }).catch(res => {
          console.log(res)
        })
      }
    },
    mounted () {
      this.getList()
    },
    computed: {
      ...mapState({
        token: state => state.info.token,
        isMobile: state => state.isMobile
      })
    }
  }
</script>
