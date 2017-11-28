<template>
  <article class="cloud_compute">
		<div class="bgImg">
			<p v-if="$route.params.type==='1'" class="centertype">矿机商城<span>></span>矿机<span>></span><em>{{$route.params.name}}</em></p>
			<p v-else-if="$route.params.type==='0'" class="centertype">矿机商城<span>></span>云矿机<span>></span><em>{{$route.params.name}}</em></p>
    </div>
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

<style lang="scss" scoped>
  .bgImg{
		background-image: url('../assets/images/miner.png');
		width: 100%;
		height: 352px;
		background-size: 100% 100%;
		.centertype{
			width: 1180px;
			margin:0 auto;
			padding-top: 12px;
			color: white;
			font-size: 12px;
			span{
				padding:0 24px;
			}
			em{
				font-style: normal;
				color: #bfbfbf;
			}
		}
	}
</style>

