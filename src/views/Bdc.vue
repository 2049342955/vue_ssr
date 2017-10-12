<template>
  <article class="bdc">
    <router-view></router-view>
  </article>
</template>

<script>
export default {
  data () {
    return {
      banner: ''
    }
  }
}
</script>
<style type="text/css" lang="scss">
	.bdc{
		padding-top:80px;
	}
</style>