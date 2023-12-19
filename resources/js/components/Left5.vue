<template>
	
<div class="col-lg-8 left_sidebar">
	<div class="row tranding_post_area">
		<div class="col-12 tranding_tittle marginbottom5"> 
			<h2>Useful Links</h2>
		</div>

		<div class = 'row'><div class="row feature_post_area margintop5">
			<div class="col-11" v-for="roww, index in links.data">
				<div class="media feature_post"> 
				   <div class="feture_img"> 
						<a v-bind:href=roww.linkk target = '_blank'>
							<img v-bind:src="'https://www.socialist-armenia.org/images/ban/' + roww.img" v-bind:alt = roww.name />
						</a>
				   </div> 
					<div class="media-body feture_content">
						<h6>
						<a v-bind:href=roww.linkk target = '_blank'
						 class='bold f_heding'> &rsaquo; {{ roww.name }} </a>
						</h6>

						<p>
						{{ roww.des }}	
						</p>
						<p><span  v-html="roww.dess"></span></p>	
					</div>
				</div>
			</div>	
		</div></div>	
	</div>
	
	<div class="row">
		<div class="col-12">
			<div class="more-blog-btn text-center"> 
				<pagination :data="links" @pagination-change-page="fetchlink"></pagination>  
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
	</div>
</div>

</template>

<script>

import router from '../app2.js'
import Vue from 'vue'
import Router from 'vue-router'

export default 
{
	name: 'app-left2',
	
	data: function() 
	{
		return {
			prods: {}, 
			
			homebannerdetail1: {},
			homebannerdetail2: {},
			links: {},
		
			keywords: null,
			
			
		}
	},
	watch: {
        keywords(after, before) {
            this.fetchsearchprod();
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
		
	
		this.fetchhomeban1();
		this.fetchhomeban2();
		
		let app = this;

		this.fetchlink();

	},
	
	methods: 
	{


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
		
		
		fetchlink(page) 
		{	
			var apper = this;
			var url  ='';
			if (typeof page === 'undefined') 
			{
				page = 1;
			}


			url = '/api/linkjson?page=' + page;
		
			console.log('line 326 ' + url);
			

			axios.get(url).then((res) => 
			{
				console.log( ' prods linne 331 ' + res);
				this.links = res.data;
			});
		},
		

		
		
		fetchsearchprod() {
			let keyer = this.keywords;
			if(keyer.length > 2)
			{
				axios.get('/api/prodsearch/search', { params: { keywords: this.keywords } })
                .then(response => this.prods = response.data)
                .catch(error => {});
			}
			else
			{
				this.fetchprod();
			
			}
        },
		
	},
}
</script>