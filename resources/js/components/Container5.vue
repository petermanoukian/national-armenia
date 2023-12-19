<template>

    <section class="post_section">
		<div class="container">
			<div class="row post_section_inner">

				<Left5 />
				<Right1 />
			</div>
		</div>
	</section>

</template>


<script>

import router from '../app2.js'


import Vue from 'vue';
import Router from 'vue-router';
import Left5 from './Left5.vue';
import Right1 from './Right1.vue';


export default {

	components: { Left5 , Right1 },

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
