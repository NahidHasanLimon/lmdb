<template>
	<div>
		<h1>From Component A </h1>
		<h6>  Current State of Counter is A=> {{ counter }} </h6>
		<button class="btn btn-warning" @click="changeCounterFromCounterA">Change Counter from Component A </button>
	</div>
</template>
<script type="">
	import {mapGetters} from 'vuex'
	  export default {
		data(){
			return {

			}
		},
		computed:{
            ...mapGetters({
                'counter' : 'getCounter'
            })
        },
		methods:{
			changeCounterFromCounterA(){
				// direct mutations
				// this.$store.commit('changeTheCounter',15)
				this.$store.dispatch('changeCounterAction',22)
			},
		},
		mounted(){
			console.log("Component A mounted ");
		},
	}
</script>