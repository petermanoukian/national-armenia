<template>

<div class="col-lg-4 right_sidebar"> 
	<div class="btc_accordion">
		<div class="item"> 
			<ul class="navbar-nav"> 
			    <li class="search_box">	
                </li>
			</ul>	
		</div>

		<div> 
			<ul class="navbar-nav"> 
			    <li class="search_box">
					<div class="input-group">
						<input class="form-control search" placeholder="Direct Search Articles"
						type="text" v-model="formSearchNews1.queryx2" v-on:keyup="autoComplete11" >
					</div>
                </li>
			</ul>

			  <div  v-if="results.length">
			   <ul>
				<li class="padtopbottom10 searchbox1res" v-for="result in results">
					<router-link :to="{ name: 'politicaldetail' , params: { id: result.id , title:result.title} }" 
					class= 'blackerlink1'>
				     &nbsp; &raquo; {{ result.name }}  </router-link>
				</li>
			   </ul>
			  </div>
		</div>
	</div> 
	
	<div class="latest_news_widget">
		<h2>Trending News</h2>
		<div class="widget" v-for="prod, index in hometrendright1.data">
			<div 
			v-if ="prod.subid &&  prod.subid != null  && prod.subid != '' 
			&& prod.sub['name'] &&  prod.sub['name'] != null  && prod.sub['name'] != ''">
				<router-link  
					:to="{ name: 'politicaldetail', 
					params: { id: prod.id , title:prod.title , cat: prod.cat['name'] , sub:prod.sub['name']} }"> 
					<img v-bind:src="'https://www.socialist-armenia.org/images/news/' + prod.img" v-bind:alt = prod.name />
				</router-link> 
				<router-link   class="w_heding"
					:to="{ name: 'politicaldetail', 
					params: { id: prod.id , title:prod.title , cat: prod.cat['name'] , sub:prod.sub['name']} }"> 
				{{ prod.name }}
				</router-link> 
			</div>
			
			<div v-else>
				<router-link  
					:to="{ name: 'politicaldetail', 
					params: { id: prod.id , title:prod.title , cat: prod.cat['name'] } }"> 
					<img v-bind:src="'https://www.socialist-armenia.org/images/news/' + prod.img" v-bind:alt = prod.name />
				</router-link> 
				<router-link   class="w_heding"
					:to="{ name: 'politicaldetail', 
					params: { id: prod.id , title:prod.title , cat: prod.cat['name'] } }"> 
				{{ prod.name }}
				</router-link> 
			</div>			
		</div>
	</div> 
	<!-- Text widget -->
	<div class="text_widget_area">
	   <div class="text_widget" v-for="prod, index in homerightlayer3.data">
			<div 
			v-if ="prod.subid &&  prod.subid != null  && prod.subid != '' 
			&& prod.sub['name'] &&  prod.sub['name'] != null  && prod.sub['name'] != ''">
				<router-link  
					:to="{ name: 'politicaldetail', 
					params: { id: prod.id , title:prod.title , cat: prod.cat['name'] , sub:prod.sub['name']} }"> 
				{{ prod.name }}
			</router-link> 
			<h6>{{ prod.dater }}, {{ prod.cat['name'] }} {{ prod.sub['name'] }}</h6>	
			</div>
			
			<div v-else>
				<router-link  
					:to="{ name: 'politicaldetail', 
					params: { id: prod.id , title:prod.title , cat: prod.cat['name']} }"> 
				{{ prod.name }}
			</router-link> 
			<h6>{{ prod.dater }}, {{ prod.cat['name'] }} </h6>	
			</div>	
	   </div>
	</div>

	<div class="advertisement">
		<div 
		v-if ="rightbannerdetail1.linkk &&  rightbannerdetail1.linkk != null  && rightbannerdetail1.linkk != '' ">
			<a v-bind:href=rightbannerdetail1.linkk target = '_blank'>	
				<img v-bind:src=
				"'https://www.socialist-armenia.org/images/ban/' + rightbannerdetail1.img" class='marginbottom11'
				v-bind:alt = rightbannerdetail1.name />
			</a>
		</div>
			
		<div v-else> 
			<img v-bind:src=
			"'https://www.socialist-armenia.org/images/ban/' + rightbannerdetail1.img" class='marginbottom11'
			v-bind:alt = rightbannerdetail1.name />
		</div>
	</div> 
	
	<div class="advertisement">
		<div 
		v-if ="rightbannerdetail2.linkk &&  rightbannerdetail2.linkk != null && rightbannerdetail2.linkk != '' ">
			<a v-bind:href=rightbannerdetail2.linkk target = '_blank'>	
		
				<img v-bind:src=
				"'https://www.socialist-armenia.org/images/ban/' + rightbannerdetail2.img" class='marginbottom11'
				v-bind:alt = rightbannerdetail2.name />
			</a>
		</div>	
		<div v-else> 
			<img v-bind:src=
			"'https://www.socialist-armenia.org/images/ban/' + rightbannerdetail2.img" class='marginbottom11'
			v-bind:alt = rightbannerdetail2.name />
		</div>
	</div> 
	

	<div class="video_widget"> 
		<div class="watch_video">
			<iframe :src =rightvidedetail1.linkk  width = '100%'/>
		</div>
	</div>
	


	<div class="advertisement">
		<div 
		v-if ="rightbannerdetail3.linkk &&  rightbannerdetail3.linkk != null && rightbannerdetail3.linkk != '' ">
			<a v-bind:href=rightbannerdetail3.linkk target = '_blank'>	
				<img v-bind:src=
				"'https://www.socialist-armenia.org/images/ban/' + rightbannerdetail3.img" class='marginbottom11'
				v-bind:alt = rightbannerdetail3.name />
			</a>
		</div>	
		<div v-else> 
			<img v-bind:src=
			"'https://www.socialist-armenia.org/images/ban/' + rightbannerdetail3.img" class='marginbottom11'
			v-bind:alt = rightbannerdetail3.name />
		</div>
	</div> 

	<div class="video_widget"> 
		<div class="watch_video">
			<iframe :src =rightvidedetail2.linkk  width = '100%'/>
		</div>
	</div>


	<div class="tabs_widge">  
		<div class="nav nav-tabs" id="nav-tab" role="tablist">
			<a class="active"  role="tab">Tags</a>	
		</div> 
		<div class="tab-content" id="nav-tabContent">
			<div class="tab-pane fade show active"> 
			   <div class='blocklear1004-4'> 
					<span  v-for="tag, index in righthometags.data" 
					class = 'bold marginleft5 floatclear97left100 blackerlink1'
					>
					<div v-if ="tag.name &&  tag.name != null &&  tag.name != null"
					class = 'floatclear97left100 blackerlink1'>
						<router-link  :to="{ name: 'politicaltag', params: { tag: tag.name } }"  
						class = 'bold blackerlink1 floatleftinline'> 
							&raquo;  {{ tag.name }} <br>
						</router-link>
						</div>
					</span>
			   </div>
			</div>
		</div>
	</div>
	
	
	<div class="advertisement margintop30 marginbottom15">
		<div id="fb-root"></div>
		<div class="fb-page" data-href="https://www.facebook.com/National-Patriotic-Democratic-Socialism-Armenia-Lebanon-101944049200231" data-tabs="timeline" data-width="380" data-height="450" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="false">
		<blockquote cite="https://www.facebook.com/National-Patriotic-Democratic-Socialism-Armenia-Lebanon-101944049200231" class="fb-xfbml-parse-ignore">
		<a href="https://www.facebook.com/National-Patriotic-Democratic-Socialism-Armenia-Lebanon-101944049200231"
		target = '_blank'>National Patriotic Democratic Socialism - Armenia - Lebanon</a></blockquote>
		</div>

	</div>
	
	<div class="advertisement margintop30 marginbottom15 twiterdiv">
		<a class="twitter-timeline" href="https://twitter.com/petermanoukian5?ref_src=twsrc%5Etfw"
		target = '_blank'>Tweets by petermanoukian5</a> 
	</div>
</div>

</template>

<script>

import router from '../app2.js'


import Vue from 'vue'
import Router from 'vue-router'

export default 
{
	name: 'app-right2',	
	data: function() 
	{
		return {
			hometrendright1: {},
			homerightlayer3: {},
			rightbannerdetail1: {},
			rightbannerdetail2: {},
			rightbannerdetail3: {},
			rightvidedetail1: {},
			rightvidedetail2: {},
			rightvidedetail3: {},
			righthometags: {},
			keywords: null,
		
			results: [],
			
			 formSearchNews1:{                    
                    queryx2: '',	
			}
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
		this.fetchProdsRightTernd1();
		this.fetchProdsRightlayer3();
		this.fetchrightban3();
		this.fetchrightban4();
		this.fetchrightban5();
		this.fetchrightvid1(1);
		this.fetchrightvid1(2);
		this.fetchrightvid1(3);
		this.fetchrighttag();
	},
	
	methods: 
	{
		fetchProdsRightTernd1() 
		{
			axios.get('/api/prodrightlayer1trend').then((res) => 
			{
				//console.log( ' linne 172 ' + res);
				this.hometrendright1 = res;
			});
		},	
		fetchProdsRightlayer3() 
		{
			axios.get('/api/prodrightlayer3').then((res) => 
			{
				//console.log( ' linne 172 ' + res);
				this.homerightlayer3 = res;
			});
		},
		
		fetchrightban3() 
		{
			axios.get('/api/bannerrightlayer3').then((res) => 
			{
				this.rightbannerdetail1 = res.data;
			});
		},
		
		fetchrightban4() 
		{
			axios.get('/api/bannerrightlayer4').then((res) => 
			{
				this.rightbannerdetail2 = res.data;
			});
		},
		fetchrightban5() 
		{
			axios.get('/api/bannerrightlayer5').then((res) => 
			{
				this.rightbannerdetail3 = res.data;
			});
		},
		
		fetchrightvid1(layer) 
		{
			axios.get('/api/videorightbylayer/'+layer).then((res) => 
			{
				console.log( ' right linne 335 - ' + layer  + res );
				console.log( ' right linne 336 - ' + layer + res.data);
				if(layer == 1)
				this.rightvidedetail1 = res.data;
				else if(layer == 2)
				this.rightvidedetail2 = res.data;
				else if(layer == 3)
				this.rightvidedetail3 = res.data;
			});
		},
		
		fetchrighttag() 
		{
			axios.get('/api/tagright1').then((res) => 
			{
				this.righthometags = res;
			});
		},
		
		autoComplete11()
		{
			this.results = [];
			if(this.formSearchNews1.queryx2.length > 2){
			//alert(this.formSearchNews1.queryx2);			
			axios.post('/api/prodsearch/search2', this.formSearchNews1).then(response => {
			this.results = response.data;
			})
            .catch(error => {});
			}
		},
		
		fetchsearchblog() 
		{
			const vr3 = this.$router;   
			vr3.push({ name: 'politicalsearch', params: { keywords: this.keywords } })
        },	
	},
}
</script>
<style>
.twiterdiv
{
	max-height:240px !important; overflow-y:auto;
}
</style>