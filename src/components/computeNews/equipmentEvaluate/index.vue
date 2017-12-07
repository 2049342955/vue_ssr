<template>
  <pequipment-evalute v-if="!isMobile"></pequipment-evalute>
  <mequipment-evalute v-else></mequipment-evalute>
</template>

<script>
  import { mapState } from 'vuex'
  import PequipmentEvalute from './pc'
  import MequipmentEvalute from './mobile'
  export default {
    components: {
      PequipmentEvalute, MequipmentEvalute
    },
    computed: {
      ...mapState({
        isMobile: state => state.isMobile
      })
    }
  }
</script>
