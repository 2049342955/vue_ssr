<template>
  <pmanu-facturer v-if="!isMobile"></pmanu-facturer>
  <mmanu-facturer v-else></mmanu-facturer>
</template>

<script>
  import { mapState } from 'vuex'
  import PmanuFacturer from './pc'
  import MmanuFacturer from './mobile'
  export default {
    components: {
      PmanuFacturer, MmanuFacturer
    },
    computed: {
      ...mapState({
        isMobile: state => state.isMobile
      })
    }
  }
</script>
