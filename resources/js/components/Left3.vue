<template>
	
<div class="col-lg-8 news_left_sidebar ">

	
	<div class="row news_item news_details ppad14bottom">
		<div class ='blocklear1004-4'>
		<h2>{{ proddetail1.name }}</h2>
		 <p class = 'bold' >  {{ proddetail1.dater }} {{ ViewPort.cat }} {{ ViewPort.sub }}</p>
		<span class="news_heding">
			{{proddetail1.des }}</span>
		<div id ='largeimg'>
			<img v-if="image1" v-bind:src=
			"'https://www.socialist-armenia.org/images/news/' + proddetail1.img" 
			class=' maximg margintopbottom8' v-bind:alt = proddetail1.name />
			<img :src="imagex" v-bind:alt=proddetail1.name class='zindex99 center margintopbottom8' v-if="image2">
		</div>
		
		<div class="row margintopbottom8"  
		v-if ="typeof proddetail1.gals !== 'undefined' &&  proddetail1.gals.length > 0 ">				
			<div class="col-3 margintopbottom8">
				<img v-bind:src="'https://www.socialist-armenia.org/images/news/thumb/' + proddetail1.img"
				 v-bind:alt=proddetail1.name  class='zindex99 center cursor' 
				v-on:click='onImageChange("/images/news/" + proddetail1.img)' />
			</div>
			<div class="col-3 margintopbottom8" v-for="gal, index in proddetail1.gals">
				<img v-bind:src="'https://www.socialist-armenia.org/images/gal/thumb/' + gal.img" v-bind:alt=gal.name 
				 class='zindex99 center cursor' 
				v-on:click='onImageChange("https://www.socialist-armenia.org/images/gal/" + gal.img)'/>
			</div>
        </div>

		<p class='ppad10'>
		<span  v-html="proddetail1.dess"></span>
		</p>
		</div>
		<div class="blocklear1004-4 share_row row marpad5 marpad5">
			<div class="col-sm-12 marpad5 share_area">
				<ul>
					<li>Share:</li>
					<li><a v-bind:href="'http://www.facebook.com/share.php?u='+globalURL+'politicaldetail/'+ proddetail1.id " target = '_blank'><i class="fa fa-facebook"></i></a></li>

					<li><a 
					v-bind:href="'https://twitter.com/share?text='+proddetail1.name+'&url='+globalURL+'politicaldetail/'+ proddetail1.id "
					><i class="fa fa-twitter"></i></a></li>
				</ul>
			</div>
		</div> 
		
		<div class='blocklear1004-4'>
			<span  v-for="tag, index in tags" class = 'bold marginleft5'>
				<router-link  :to="{ name: 'politicaltag', params: { tag: tag } }"  
				class = 'bold marginleft5'> 
					&rsaquo;  {{ tag }}
				</router-link>
			</span>
		</div>

		<div class='blocklear1004-4'>
		   <div 
			v-if ="proddetail1.video && proddetail1.video != null  && proddetail1.video != '' " >
				<iframe :src =proddetail1.video  width = '100%' style = 'width:100%;height:400px;'/>
			</div>
		</div>
		
	</div>

	<div class="row watch_it_area"> 
		<div class="col-12">
		   <div 
			v-if ="homebannerdetail1.linkk &&  homebannerdetail1.linkk != null  && homebannerdetail1.linkk != '' " 
		   class="font_load_post">
			<a v-bind:href=homebannerdetail1.linkk target = '_blank'>
			<img v-bind:src=
			"'https://www.socialist-armenia.org/images/ban/' + homebannerdetail1.img" 
			v-bind:alt = homebannerdetail1.name class = 'maximg'/> </a>	
		   </div>
		   
		   	<div v-else class="font_load_post">
			<img v-bind:src=
			"'https://www.socialist-armenia.org/images/ban/' + homebannerdetail1.img" 
			v-bind:alt = homebannerdetail1.name class = 'maximg'/>
		   </div>   
		</div>
		
		<!--ethereum_price_posts -->
		<div class="col-12 marginbottom11"> 
			<div 
			v-if ="homebannerdetail2.linkk &&  homebannerdetail2.linkk != null  && homebannerdetail2.linkk != '' "
			class="ethereum_price_posts">
			<a v-bind:href=homebannerdetail2.linkk target = '_blank'>	
				<img v-bind:src=
				"'https://www.socialist-armenia.org/images/ban/' + homebannerdetail2.img" 
				class='marginbottom11 maximg'
				v-bind:alt = homebannerdetail2.name />
			</a>
			</div>
			
			<div v-else class="ethereum_price_posts"> 
			<img v-bind:src=
			"'https://www.socialist-armenia.org/images/ban/' + homebannerdetail2.img" class='maximg marginbottom11'
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
	name: 'app-left3',
	
	data: function() 
	{
		return {
			proddetail1: {}, 

			homebannerdetail1: {},
			homebannerdetail2: {},
			
			ViewPort:{  
				id: null,			
				title: null,
				cat: null,
				sub: null,
			},
			tags: [],
			showimg1: true,
			showimg2: false,
			imagex: {}, 
		}
	},
	
	computed: {
	
		image1()
		{
			return this.showimg1;
		},
		image2()
		{
			return this.showimg2;
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
		let app = this;
		if(app.$route.params.id)
		{
			let id1x = app.$route.params.id;
			this.ViewPort.id = id1x;
			this.fetchProddetail();
		}
		
		this.fetchhomeban1();
		this.fetchhomeban2();
		
		if(app.$route.params.cat)
		{	
			let catt = app.$route.params.cat;
			this.ViewPort.cat = catt;
		}
		if(app.$route.params.sub)
		{	
			let subb = app.$route.params.sub;
			this.ViewPort.sub = subb;
		}
		if(app.$route.params.title)
		{	
			title1 = app.$route.params.title;
			this.ViewPort.title = title1;
		}
	},
	
	methods: 
	{
		
		onImageChange(img) 
		{
			this.showimg1 = false;
			this.showimg2 = true;	
			this.imagex =  img;
			//var elmnt = document.getElementById("largeimg");
			//elmnt.scrollIntoView();
			 $('html, body').animate({
				scrollTop: $("#largeimg").offset().top - 100
			}, 2000);		
        },
		
		fetchProddetail() 
		{
			var apper = this;
			var url  ='';
			let idd = apper.ViewPort.id;
			url = '/api/politicdetailjson/'+idd;
			axios.get(url).then((res) => 
			{
				console.log( ' linne 235 ' + res.data);
				this.proddetail1 = res.data;
				this.tags = res.data.tagg.split(",");
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
	},
}
</script>