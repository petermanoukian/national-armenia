<template>
  <div>
  
	


    <!-- Welcome Area End -->


	<section class="our-speaker-area bg-img bg-gradient-overlay section-padding-200-60" >

		<div class="container">
			<div class="row">
				
				<div class="col-12 ppad10">
					<h4>Our Services</h4>
				</div>
				
			<div class="marpad15">
				
				
				<header class="clearfix"><h4>Lebanese Armenian Web Site Development</h4></header>
				<div>
				<p> This web site is a blog built with the backend web technologies of laravel (a PHP framework),
				HTML5, CSS3, Jquery 
				</p>
				
				<header class="clearfix">
					<h4>Web Development Services - Free lance web site developer Armenia</h4>
			 
				</header>
				<p> Hello, in case you intend to have an advanced web site, 
				dyamic where you can control and update your website informtation, <br>
				Please contact me, I am a free lance website developer, I develop a web site by two approach
				<br>One which is very fast and good for SEO - Search engines Optimization, built with
				either php 7.4 object oriented approach with mysqli database and jquery </p>
				
				<p>HTML 5, Semantic web sites, with CSS3 and animations </p>
				
				</div>

				<div class="widget message-form col-md-12">
					<header class="clearfix"><h4>Armenia - Lebanon Freelance website development</h4></header>
					<div>
					The other approach si with laravel and vuejs, 
					a super super fast web site that laods once and afterwars withzero refresh, that is why is is super fast
					<br>
					SEO Services
					<br> Web Applications
					<br> responsive web sites that work both on your computer, Ipad, and Mobile
					</div>
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