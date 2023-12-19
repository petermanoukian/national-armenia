<template>

    <section class="post_section">
		<div class="container">
			<div class="row post_section_inner">

				<Left1 />
				<Right1 />
			</div>
		</div>
	</section>

</template>


<script>

import router from '../app2.js'


import Vue from 'vue';
import Router from 'vue-router';
import Left1 from './Left1.vue';
import Right1 from './Right1.vue';


export default {

	components: { Left1 , Right1 },

	data() {
      return {
	  
	  }
       
    },
	created: function()
	{
		const vr1 = this.$router;
		
		

	},
	 mounted: function()
	{
		const vr2 = this.$router;

	},
	
	methods: 
	{

		
	
	
	},
	


}
</script>
