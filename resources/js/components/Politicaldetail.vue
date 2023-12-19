<template>
	
  <div>

		<Homebanner2 />
		<Container3 />

</div>

</template>

<script>

import router from '../app2.js'


import Vue from 'vue';
import Router from 'vue-router';
import Header from './Header.vue';
import Footer from './Footer.vue';

import Homebanner2 from './Homebanner2.vue';
import Container1 from './Container1.vue';
import Container3 from './Container3.vue';
export default {

	components: { Header , Footer ,  Homebanner2, Container3 },
	data() {
      return {
        databanner: [
        ],
		//bannerdiv:[],
      };
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

<style>
  .example-slide {
    align-items: center;
	margin-top:100px; 
    background-color: #666;
    color: #FFF;
    display: inline-block;
    font-size: 1.5rem;
    justify-content: center;
    min-height: 10rem;
	width:100%;
  }
</style>