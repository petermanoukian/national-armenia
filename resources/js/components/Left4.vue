<template>
	
<div class="col-lg-8 left_sidebar">
	<!-- Tranding Area Post -->
	<div class="row tranding_post_area">
		<div class="col-12 tranding_tittle"> 
			<h2>Blog Articles by tag : {{ ViewPort.tag }} {{ Tagup }}</h2> <br>

			<span v-if ="ViewPort.tag &&  ViewPort.tag != null  && ViewPort.tag != '' " class='margintopbottom10'>	
				By: <span class='bold'> {{ ViewPort.tag }} </span>	
			</span>
	

		</div>
		
		<div class="col-12 tranding_tittle"> 
			<div class="input-group">
				<input class="form-control search" placeholder="Search Articles"
				type="search" name="search-form" id="searchForm" required v-model="keywords" >	
			</div>
		</div>
		
		<div class = 'row'>
			<div class="col-md-6" v-for="prod, index in prods.data">
				<div class="tranding_post" 
				v-if ="prod.subid &&  prod.subid != null  && prod.subid != '' 
				&& prod.sub['name'] &&  prod.sub['name'] != null  && prod.sub['name'] != ''"> 
					<router-link   class="post_img"
					:to="{ name: 'politicaldetail', 
					params: { id: prod.id , title:prod.title , cat: prod.cat['name'] , sub:prod.sub['name']} }"> 
						<img v-bind:src="'https://www.socialist-armenia.org/images/news/' + prod.img" 
						v-bind:alt = prod.name />	
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
						 <img v-bind:src="'https://www.socialist-armenia.org/images/news/' + prod.img" 
						 v-bind:alt = prod.name />	
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
		</div>
	
		<div class="row">
			<div class="col-12">
				<div class="more-blog-btn text-center"> 
					<pagination :data="prods" @pagination-change-page="fetchprod"></pagination>  
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
			
			ViewPort:{                    	
				tag: null,
			},
			keywords: null,
	
		}
	},
	watch: {
        keywords(after, before) {
            this.fetchsearchprod();
        }
	},
	computed: {
			Tagup() {
			  return this.ViewPort.tag;
		    },
	

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
		let tagg = '';
	
		
		if(app.$route.params.tag)
		{	
			
			let idtag = app.$route.params.tag;	
			
			this.ViewPort.tag = idtag;
			this.fetchprod();
	
		}
		else if(app.$route.params.keywords)
		{
			
			this.keywords = app.$route.params.keywords;
			this.fetchsearchprod();
		
		}
		else
		{
			this.fetchprod();

		}
	
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
		
		
		fetchprod(page) 
		{	
			var apper = this;
			var url  ='';
			if (typeof page === 'undefined') 
			{
				page = 1;
			}

			if(apper.ViewPort.tag != null && apper.ViewPort.tag !='')
			{
				let tag1 = apper.ViewPort.tag;
				url = '/api/politicstagjson/'+tag1+'?page=' + page;		
			}
			else
			{

				url = '/api/politicstagjson?page=' + page;
			}
			console.log('line 326 ' + url);
			

			axios.get(url).then((res) => 
			{
				console.log( ' prods linne 331 ' + res);
				this.prods = res.data;
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