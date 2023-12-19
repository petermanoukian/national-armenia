<template>
  <div>


	<section class="our-speaker-area bg-img bg-gradient-overlay section-padding-200-60" >

		<div class="container">
			<div class="row">
				
				<div class="col-12 ppad10">
					<h4>About Us</h4>
				</div>
				
			<div class="marpad15">
				
				<header class="clearfix">
					<h4>Armenian and Lebanese Polical social Blog and articles</h4>
				</header>
				
				<div>
				<p> This web site is a blog to discuss various Armenian, Lebanese and International
				Social and political issues that concerns the two great republics of Lebanon and Armenian,
				I consider both of them my fatherland and nation
				</p>
				
				<header class="clearfix">
					<h4>Web Development Services - Free lance Armenia</h4>
				</header>
				<p>This web site is built by Peter Manoukian</p>
				<p>A web developer, Lebanese Armenian web site development with PHP, Laravel, Jquery, Vuejs</p>
				<p> Free lance back end and full stack web development Armenia / Lebanon </p>
				<p>Lebanese free lance web development </p>
				<p> SEO Services, freelance web applications Armenia </p>
				<p>More Details Coming Soon </p>
				</div>
				
				<div class ='bold'>  
					<a href = 'https://www.socialist-armenia.org/Bedros-Manoukian-Articles.pdf' target = '_blank'> 
					 &raquo; My Articles </a> 
				</div>
		
				
			</div>
				
				
				
			</div>
		</div>
	</section>








	
    

</div>

</template>

<script>

import router from '../app2.js'




import Vue from 'vue';
import Router from 'vue-router';
import Header from './Header.vue';
import Footer from './Footer.vue';

import Homebanner2 from './Homebanner2.vue';


export default {


	components: { Header , Footer ,  Homebanner2},

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
		this.fetchBanners();
		

	},
	 mounted: function()
	{
		const vr2 = this.$router;

	},
	
	methods: 
	{
		fetchBanners() 
		{
			let bsers = [];
			let bannerdivx = [];
			axios.get('/banner/json').then((res) => 
			{
				console.log( ' linne 1073 ' + res);
				
				//this.bannerdiv = res.data;
				//bsers = this.bannerdiv;
				bsers = res.data;
				for(let bser of bsers)
				{
				   //bannerdivx += "<div class='example-slide'>" + bser.name + "</div>";
				   bannerdivx.push("<div class='example-slide'><div style = 'width:100%;margin-top:14px;margin-bottom:10px;clear:both;text-align:center;'>" + bser.name + "</div><div style = 'width:100%;margin-top:5px;margin-bottom:28px;clear:both;text-align:center;'><img src ='images/service/"+bser.img+ "' alt = '' style = 'clear:both;'/></div></div>");
				   //console.log(' 1083 ' + bser.name);
				}
				//console.log(' 1085 ' + bannerdivx);
				this.databanner = bannerdivx;

			});
			


		},
		
	
	
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