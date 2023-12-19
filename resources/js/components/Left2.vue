<template>	
<div class="col-lg-8 left_sidebar">
	<div class="row tranding_post_area">
		<div class="col-12 tranding_tittle"> 
			<h2>Blog Articles</h2> <br>
			<span v-if ="ViewPort.cat &&  ViewPort.cat != null  && ViewPort.cat != '' " class='margintopbottom10'>	
				Category: <span class='bold'> {{ ViewPort.cat }} </span>	
			</span>
			
			<span v-if ="ViewPort.sub &&  ViewPort.sub != null  && ViewPort.sub != '' " 
			class='margintopbottom10'>	
				SubCategory: <span class='bold'> {{ ViewPort.sub }} </span>	
			</span>
		</div>	
		<div class="col-12 tranding_tittle"> 
			<div class="input-group">
				<input class="form-control search" placeholder="Search Articles"
				type="search" name="search-form" id="searchForm" required v-model="keywords" >	
			</div>
		</div>	
		<div class = 'row'>
			<div class="row feature_post_area">
			<div class="col-11" v-for="prod, index in prods.data">

				<div class="media feature_post"
				v-if ="prod.subid &&  prod.subid != null  && prod.subid != '' 
				&& prod.sub['name'] &&  prod.sub['name'] != null  && prod.sub['name'] != ''"> 
				   <div class="feture_img"> 
					<router-link   class="post_img"
					:to="{ name: 'politicaldetail', 
					params: { id: prod.id , title:prod.title , cat: prod.cat['name'] , sub:prod.sub['name']} }">
					<img v-bind:src="'https://www.socialist-armenia.org/images/news/medium/' + prod.img" 
					v-bind:alt = prod.name />	
					</router-link> 

						<ul class="special_share">
							<li><a 
							v-bind:href="'https://twitter.com/share?text='+prod.name+'&url='+globalURL+'politicaldetail/'+ prod.id +'/' +  prod.title "
							target = '_blank'
							><i class="fa fa-twitter"></i></a></li>
							<li><a v-bind:href="'http://www.facebook.com/share.php?u='+globalURL+'politicaldetail/'+ prod.id +'/' +  prod.title "
							target = '_blank'><i class="fa fa-facebook"></i></a></li>
							
						</ul>
				   </div> 
					<div class="media-body feture_content">	
						<router-link   class='bold f_heding'
						:to="{ name: 'politicaldetail', 
						params: { id: prod.id , title:prod.title , cat: prod.cat['name'] , sub:prod.sub['name']} }">	
						 &rsaquo; {{ prod.name }} </router-link>
						<h6>
						{{ prod.cat['name'] }} | {{ prod.sub['name'] }} {{ prod.dater }}
						{{ prod.dater }}	
						</h6>
						<p>
						{{ prod.des }}
						</p>
					</div>
				</div>
				
				
				<div class="media feature_post"
				v-else> 
				   <div class="feture_img"> 
					<router-link   class="post_img"
					:to="{ name: 'politicaldetail', params: {id: prod.id,title:prod.title , cat: prod.cat['name'] } }"> 
					<img v-bind:src="'https://www.socialist-armenia.org/images/news/medium/' + prod.img" 
					v-bind:alt = prod.name />	
					</router-link> 
						<ul class="special_share">
							<li><a 
							v-bind:href="'https://twitter.com/share?text='+prod.name+'&url='+globalURL+'politicaldetail/'+ prod.id +'/' +  prod.title "
							target = '_blank'
							><i class="fa fa-twitter"></i></a></li>
							<li><a v-bind:href="'http://www.facebook.com/share.php?u='+globalURL+'politicaldetail/'+ prod.id +'/' +  prod.title "
							target = '_blank'><i class="fa fa-facebook"></i></a></li>	
						</ul>
				   </div> 
					<div class="media-body feture_content">
						<router-link    class='bold f_heding'
						:to="{ name: 'politicaldetail', params: {id: prod.id,title:prod.title , cat: prod.cat['name'] } }"> 
						 &rsaquo; {{ prod.name }} </router-link>
						<h6>
						{{ prod.cat['name'] }}  {{ prod.dater }}
						{{ prod.dater }}	
						</h6>
						<p>
						{{ prod.des }}
						</p>
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
				cat_id: null,
				cat: null,
				sub_id: null,
				sub: null,
	
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
			categoryId() {
			  return this.ViewPort.cat_id;
		    },
		   
		    category() {
			  return this.ViewPort.cat;
		    }, 
			
			subcategoryId() {
			  return this.ViewPort.sub_id;
		    },
		   
		    subcategory() {
			  return this.ViewPort.sub;
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
		let idcat = '';
		let idsub = '';
		let catt = '';
		let subb = '';
		
		if(app.$route.params.catid)
		{	
			idcat = app.$route.params.catid;	
			catt = app.$route.params.cat;
			this.ViewPort.cat_id = idcat;
			this.ViewPort.cat = catt;
			console.log(' 181 idcat ' + idcat);
				
			
			if(app.$route.params.subid)
			{
				idsub = app.$route.params.subid;
				subb = app.$route.params.sub;
				this.ViewPort.sub_id = idsub;
				this.ViewPort.sub = subb;
				console.log(' 188 idcat ' + idsub);
				//this.fetchprodcatsub(idcat, catt, idsub , subb);
				this.fetchprod();
				
			}
			else
			{
				//this.fetchprodcat(idcat, catt);
				this.fetchprod();
			}
			
			
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

			if(apper.ViewPort.cat_id != null && apper.ViewPort.cat_id !='')
			{
				let catid1 = apper.ViewPort.cat_id;
				let catt1 = apper.ViewPort.cat;
				
				if(apper.ViewPort.sub_id != null && apper.ViewPort.sub_id !='')
				{
					let subid1 = apper.ViewPort.sub_id;
					let subb1 = apper.ViewPort.sub;
					url = '/api/politicsjson/'+catid1+'/'+catt1+'/'+subid1+'/'+subb1+'?page=' + page;
				}
				
				else
				{
					url = '/api/politicsjson/'+catid1+'/'+catt1+'?page=' + page;
				
				}	
			}
			else
			{

				url = '/api/politicsjson?page=' + page;
			}
			console.log('line 326 ' + url);
			

			axios.get(url).then((res) => 
			{
				console.log( ' prods linne 331 ' + res);
				this.prods = res.data;
			});
		},
		
		fetchprodcat(catid, catt, page) 
		{	
			var apper = this;
			var url  ='';
			
			let catid1 = apper.ViewPort.cat_id;
			let catt1 = apper.ViewPort.cat;
			
			if (typeof page === 'undefined') 
			{
				page = 1;
			}
		
			url = '/api/politicsjson/'+catid1+'/'+catt1+'?page=' + page;
			console.log('line 311 ' + url);
			

			axios.get(url).then((res) => 
			{
				console.log( ' prods linne 316 ' + res);
				this.prods = res.data;
			});
		},
		
		
		
		fetchprodcatsub(catid, catt, subid, subb , page) 
		{	
			var apper = this;
			var url  ='';
			
			let catid1 = apper.ViewPort.cat_id;
			let catt1 = apper.ViewPort.cat;
			let subid1 = apper.ViewPort.sub_id;
			let subb1 = apper.ViewPort.sub;
			
			
			if (typeof page === 'undefined') 
			{
				page = 1;
			}
			

			
			url = '/api/politicsjson/'+catid1+'/'+catt1+'/'+subid1+'/'+subb1+'?page=' + page;
			//url = '/api/politicsjson/cat/catt/subid/subb?page=' + page;
			console.log('line 333 ' + url);
			

			axios.get(url).then((res) => 
			{
				console.log( ' prods linne 338 ' + res);
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