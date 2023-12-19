
<template>
<div>
     <div class="header_top_area"> 
        <div class="container"> 
            <div class="header_top_inner d-sm-flex justify-content-sm-between">
                <ul class="left_info"> 
                    <li>
						<router-link :to="{ name: 'ArmenianBlog' }" > 
							Home
						</router-link> 
					</li>
                    <li>
					<router-link :to="{ name: 'Armenian-FreeLance-Web-Developer-Lebanese-Website-Development' }" > 
					Contact
					</router-link> 
					</li>
                    <li>	
					<router-link :to="{ name: 'links' }" > 
					Links
					</router-link> 
					</li>
                    <li>
					<router-link :to="{ name: 'Armenian-blog-Lebanese-politics/Nationalism/Socialism/Social-Justice' }" > 
					About
					</router-link> 
					</li>
                    <li>
					<router-link :to="{ name: 'video' }" > 
					Videos
					</router-link> 
					</li>
					<li>
					<router-link :to="{ name: 'Web-Development-FreeLance-Lebanese-Web-Developer-Website-SEO' }" > 
					Web Services
					</router-link> 
					</li>
					<li>
					<router-link :to="{ name: 'Lebanese/Armenian/Freelance/PHP/Web/Developer/Website/Development/Armenia/Lebanon' }" > 
					Web Development
					</router-link> 
					</li>
                </ul> 
                <ul class="header_social">
                    <li><a 
					href="https://www.facebook.com/National-Patriotic-Democratic-Socialism-Armenia-Lebanon-101944049200231"
					target ='_blank'>
					<i class="fa fa-facebook"></i></a></li> 
                    <li><a href="https://twitter.com/petermanoukian5"
					target ='_blank'><i class="fa fa-twitter"></i></a></li>
                    <li><a href="/rss-feed" title="RSS" target = "_blank">RSS</a></li> 	
                </ul> 
            </div>
        </div> 
    </div>

    <header class="main_header_area" id="header"> 
       <div class="container">
            <div class="header_menu"> 
                <nav class="navbar navbar-expand-lg">    
					<router-link :to="{ name: 'ArmenianBlog' }" class="navbar-brand"> 
					<img src="images/Lebanese-Armenian-National-Movement-Blog.jpg" alt="">
					</router-link> 
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar_supported"  aria-expanded="false" aria-label="Toggle navigation"> 
                        <i class="fa fa-bars" aria-hidden="true"></i>
                    </button>    
                    <div class="collapse navbar-collapse navbar_supported">
                        <ul class="navbar-nav"> 
							<li class="dropdown"> 
								<router-link class="nav-link dropdown-toggle" :to="{ name: 'political' }"> 
								All Articles
								</router-link>
							</li>
							<li  v-for="cat, index in catsnav.data" class="dropdown"> 
								<router-link class="nav-link dropdown-toggle" :to="{ name: 'political', params: { catid: cat.id , cat:cat.name } }"> 
									{{ cat.name }} 
									<ul class="dropdown-menu">
										<li v-for="sub, index in cat.subs">
										<router-link  
										:to="{ name: 'political', 
										params: { catid: cat.id , cat:cat.name , subid: sub.id , sub:sub.name} }"> 
										{{ sub.name }} 
										</router-link> 
										 </li> 
									</ul>
								</router-link> 
							</li>	
                        </ul>  
                    </div>
                </nav>  
                <ul class="search_button_content nav">
                    <li class="dropdown search_dropbown">
                        <a class="nav-link dropdown-toggle" href="" role="button" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-search"></i></a>
                        <ul class="dropdown-menu">
                            <li>
                                <input type="text" placeholder="Search..">
                                <span><i class="fa fa-search"></i></span> 
                            </li>
                        </ul>
                    </li>  
                </ul>  
           </div>
        </div>
    </header>
</div>
</template>
<script>
import router from '../app2.js'

import Vue from 'vue'
import Router from 'vue-router'

export default 
{
	name: 'app-header',
	data: function() 
	{
		return {
			catsnav: {}, 
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
		this.fetchCatsNav();
	},
	
	methods: 
	{
		fetchCatsNav() 
		{
			axios.get('/api/catnav').then((res) => 
			{
				//console.log( ' linne 172 ' + res);
				this.catsnav = res;
			});
		},
	},
}
</script>