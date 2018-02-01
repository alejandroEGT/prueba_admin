<template>
	<div>
		<button @click="onCLick" >link</button>
	</div>
</template>


<script type="text/javascript">
	export default{
		data(){
			return{

			}
		},

		methods:{
			onCLick(){
				axios.get('/event').then((r)=>{
					return r;
				});
			}
		}
	}
</script>