<template>
	
<div class="col-lg-8 left_sidebar">
	<!-- Tranding Area Post -->
	<div class="row tranding_post_area">
		<div class="col-12 tranding_tittle"> 
			<h2>Blog Articles</h2>
			<router-link  :to="{ name: 'political' }">
			View More <i class="fa fa-arrow-right"></i></router-link>
		</div>
		<!-- Tranding_post -->
		<div class="col-md-6" v-for="prod, index in prodlayer1s.data">
			<div class="tranding_post" 
			v-if ="prod.subid &&  prod.subid != null  && prod.subid != '' 
			&& prod.sub['name'] &&  prod.sub['name'] != null  && prod.sub['name'] != ''"> 
				<router-link   class="post_img"
				:to="{ name: 'politicaldetail', 
				params: { id: prod.id , title:prod.title , cat: prod.cat['name'] , sub:prod.sub['name']} }"> 
					<img v-bind:src="'https://www.socialist-armenia.org/images/news/' + prod.img" v-bind:alt = prod.name />	
					<span class="tag_btn widthauto minwidth160">
					{{ prod.cat['name'] }} | {{ prod.sub['name'] }}
					</span>
				</router-link> 
				<div class="post_content"> 
					{{ prod.des }}	
					<h6>{{ prod.dater }} <span>|</span>
				<router-link   class='bold'
				:to="{ name: 'politicaldetail', 
				params: { id: prod.id , title:prod.title , cat: prod.cat['name'] , sub:prod.sub['name']} }">	
					 &rsaquo; {{ prod.name }} </router-link></h6>
				</div>
			</div>
		<div class="tranding_post" v-else> 
			<router-link   class="post_img"
			:to="{ name: 'politicaldetail', params: {id: prod.id,title:prod.title , cat: prod.cat['name'] } }"> 
			     <img v-bind:src="'https://www.socialist-armenia.org/images/news/' + prod.img" v-bind:alt = prod.name />	
					<span class="tag_btn widthauto minwidth160">
					{{ prod.cat['name'] }} 
					</span>
				</router-link> 
				<div class="post_content"> 
					{{ prod.des }}	
					<h6>{{ prod.dater }} <span>|</span>
				<router-link   class='bold'
				:to="{ name: 'politicaldetail', params: { id: prod.id , title:prod.title , cat: prod.cat['name'] } }">	
					 &rsaquo;  {{ prod.name }} </router-link></h6>
				</div>
			</div>	
		</div>
	</div>
	<!-- Feature Post Area-->
	<div class="row feature_post_area">
		<div class="col-12">
			<div class="feature_tittle"> 
				<h2>More Articles</h2>
				<router-link  :to="{ name: 'political' }">View More <i class="fa fa-arrow-right"></i>
				</router-link>
			</div>
		</div>
		<div class="col-12" v-for="prod, index in prodlayer1s.data">
			<div class="media feature_post" v-if ="prod.subid &&  prod.subid != null  && prod.subid != '' 
			&& prod.sub['name'] &&  prod.sub['name'] != null  && prod.sub['name'] != ''"> 
			   <div class="feture_img"> 
				<router-link   
				:to="{ name: 'politicaldetail', 
				params: { id: prod.id , title:prod.title , cat: prod.cat['name'] , sub:prod.sub['name']} }"> 				
				 <img 
				v-bind:src="'https://www.socialist-armenia.org/images/news/medium/' + prod.img" v-bind:alt = prod.name />

				</router-link>				
					<ul class="special_share">
						<li>
						<a v-bind:href="'https://twitter.com/share?text='+prod.name+'&url='+globalURL+'politicaldetail/'+ prod.id +'/' +  prod.title "
							target = '_blank'>
						<i class="fa fa-twitter"></i></a></li>
						<li>
						<a v-bind:href="'http://www.facebook.com/share.php?u='+globalURL+'politicaldetail/'+ prod.id +'/' +  prod.title "
							target = '_blank'>
						<i class="fa fa-facebook"></i></a></li>
					</ul>
			   </div> 
				<div class="media-body feture_content">
					<h6>{{ prod.dater }}  <span>|</span>
					<router-link  class='bold' 
					:to="{ name: 'politicaldetail', params: { id: prod.id , title:prod.title , cat: prod.cat['name'] , sub:prod.sub['name']} }"> 
					 &rsaquo; {{ prod.name }}  </router-link>	
					</h6>
					<p>{{ prod.des }}</p>
				</div>
			</div>
			
			<div class="media feature_post" v-else> 

			   <div class="feture_img"> 
				<router-link   
				:to="{ name: 'politicaldetail', 
				params: { id: prod.id , title:prod.title , cat: prod.cat['name'] } }"> 				
				 <img 
				v-bind:src="'https://www.socialist-armenia.org/images/news/medium/' + prod.img" v-bind:alt = prod.name />
				</router-link>				
					<ul class="special_share">
						<li>
						<a v-bind:href="'https://twitter.com/share?text='+prod.name+'&url='+globalURL+'politicaldetail/'+ prod.id +'/' + prod.title "
							target = '_blank'>
						<i class="fa fa-twitter"></i></a></li>
						<li>
							<a v-bind:href="'http://www.facebook.com/share.php?u='+globalURL+'politicaldetail/'+ prod.id +'/' + prod.title "
							target = '_blank'>
						<i class="fa fa-facebook"></i></a></li>
						
					</ul>
			   </div> 
				<div class="media-body feture_content">	
					<h6>{{ prod.dater }}  <span>|</span>
					<router-link   class='bold'
					:to="{ name: 'politicaldetail', params: { id: prod.id , title:prod.title , cat: prod.cat['name'] } }"> 
					 &rsaquo;  {{ prod.name }}  </router-link>	
					</h6>
					<p>{{ prod.des }}</p>
				</div>
			</div>		
		</div>
	</div>
	
	<!-- Watch It Area-->
	<div class="row watch_it_area"> 
		<!-- font_load_post -->
		<div class="col-12">
		   <div 
			v-if ="homebannerdetail1.linkk &&  homebannerdetail1.linkk != null  && homebannerdetail1.linkk != '' " 
		   class="font_load_post">
			<a v-bind:href=homebannerdetail1.linkk target = '_blank'>
			<img v-bind:src=
			"'https://www.socialist-armenia.org/images/ban/' + homebannerdetail1.img" 
			v-bind:alt = homebannerdetail1.name /> </a>	
		   </div>
		   
		   	<div v-else class="font_load_post">
			<img v-bind:src=
			"'https://www.socialist-armenia.org/images/ban/' + homebannerdetail1.img" 
			v-bind:alt = homebannerdetail1.name />
		   </div>   
		</div>
		
		<!--ethereum_price_posts -->
		<div class="col-12 marginbottom11"> 
			<div 
			v-if ="homebannerdetail2.linkk &&  homebannerdetail2.linkk != null  && homebannerdetail2.linkk != '' "
			class="ethereum_price_posts">
			<a v-bind:href=homebannerdetail2.linkk target = '_blank'>	
				<img v-bind:src=
				"'https://www.socialist-armenia.org/images/ban/' + homebannerdetail2.img" class='marginbottom11'
				v-bind:alt = homebannerdetail2.name />
			</a>
			</div>
			
			<div v-else class="ethereum_price_posts"> 
			<img v-bind:src=
			"'https://www.socialist-armenia.org/images/ban/' + homebannerdetail2.img" class='marginbottom11'
			v-bind:alt = homebannerdetail2.name />
			</div>
		</div>

		<div class="col-12">
			<div class="feature_tittle"> 
				<h2>Videos</h2>
				<router-link  :to="{ name: 'video' }">
				View More <i class="fa fa-arrow-right"></i></router-link>
			</div>
		</div>

		<div v-for="vid, index in homevideos.data" class="col-md-6" >
			<div class="watch_video">
				<iframe :src =vid.linkk class="video_thumbnail" width = '100%'/>
				<p class="video_heding">{{ vid.name }}</p>
				<p> {{ vid.des }} </p>
			</div>
		</div>

	</div>
	

</div>

</template>


<script>

import router from '../app2.js'
import Vue from 'vue'
import Router from 'vue-router'

export default 
{
	name: 'app-left1',
	
	data: function() 
	{
		return {
			prodlayer1s: {}, 
			prodlayer2s: {}, 
			homebannerdetail1: {},
			homebannerdetail2: {},
			homevideos: {},
		}
	},
	
	computed: {

		currentpager : function () 
		{
			 var vm = this;
			 //return this.$route.path;
				return function (pg) {
				//alert(portfolioid);
			   var pager = vm.$route.path;
			   if(pager == pg ||  pager.includes(pg)   )
			   {
					console.log(pager + ' IS equal to ' + pg);
					return true;
			   }
			   else
			   {
				 return false;
			   }
			}
		},
		
		currentpager2 : function () 
		{
			 var vm = this;
			 //return this.$route.path;
				return function (pg , pg2) {
				//alert(portfolioid);
			   var pager = vm.$route.path;
			   if(pager == pg ||  ( pager.includes(pg) && pager.includes(pg2)  ) )
			   {
					console.log(pager + ' IS equal to ' + pg);
					return true;
			   }
			   else
			   {
				 return false;
			   }
			}
		},
		currentpager3 : function () 
		{	
			let urll = window.location.href;	
			return urll;
		},
	},
	
	
	created: function()
	{
		const vr1 = this.$router;
	},
	 mounted: function()
	{
		const vr2 = this.$router;
		this.fetchProdslayer1();
		this.fetchProdslayer2();
		this.fetchhomeban1();
		this.fetchhomeban2();
		this.fetchhomevideos();
	},
	
	methods: 
	{
		fetchProdslayer1() 
		{
			axios.get('/api/prodhomelayer1').then((res) => 
			{
				//console.log( ' linne 172 ' + res);
				this.prodlayer1s = res;
			});
		},
		
		fetchProdslayer2() 
		{
			axios.get('/api/prodhomelayer2').then((res) => 
			{
				//console.log( ' linne 172 ' + res);
				this.prodlayer2s = res;
			});
		},	
		fetchhomeban1() 
		{
			axios.get('/api/bannerhomelayer1').then((res) => 
			{	
				this.homebannerdetail1 = res.data;
			});
		},
		fetchhomeban2() 
		{
			axios.get('/api/bannerhomelayer2').then((res) => 
			{	
				this.homebannerdetail2 = res.data;
			});
		},
		fetchhomevideos()
		{
			axios.get('/api/homevideos1').then((res) => 
			{	
				this.homevideos = res;
				console.log( ' linne 384 ' + res);
				console.log( ' linne 385 ' + res.data);
			});
		},
	
	},
}
</script>