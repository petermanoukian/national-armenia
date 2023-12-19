<template>


<div>
	
   <!-- Home Banner Area --> 
    <section class="home_banner_area">
        <div class="container">
            <div class="row home_banner_inner ">
                <!-- Slicer col -->
                <div class="carousel slide banner_slider col-12 " data-ride="carousel">
                    <div class="carousel-inner ">
                        <div  v-for="prod, index in prodban.data"
						class="carousel-item" v-bind:class="{ 'active' : index == 1}">
                            <img 
							v-bind:src="'https://www.socialist-armenia.org/images/news/' + prod.img" 
							v-bind:alt = prod.name 
							/>

                            <div class="slider_caption"> 
                             
								
								<p v-if ="prod.subid &&  prod.subid != null  && prod.subid != '' 
								&& prod.sub['name'] &&  prod.sub['name'] != null  && prod.sub['name'] != ''">
							<router-link   class="wow fadeInUp animated button1 marginbottom10" 
							data-wow-delay="0.4s"
:to="{ name: 'politicaldetail', params: { id: prod.id , title:prod.title , cat: prod.cat['name'] , sub:prod.sub['name']} }"> 
{{ prod.name }}  &raquo;  Read More</router-link> <br><br> 
							{{ prod.des }}
								</p>
								<p v-else>
								<router-link  class="wow fadeInUp animated button1 marginbottom10" 
								data-wow-delay="0.4s" 
:to="{ name: 'politicaldetail', params: { id: prod.id , title:prod.title , cat: prod.cat['name'] } }"> 
{{ prod.name }} &raquo;  Read More</router-link> <br><br>
								
								{{ prod.des }}							
								
								</p>

                            </div>
                        </div>
                  
                    </div> 
                    <a class="carousel-control-prev" href=".banner_slider" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="carousel-control-next" href=".banner_slider" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>
				
				
             				
            </div>
        </div>
    </section>
</div>
</template>


<script>
import router from '../app2.js'
import Vue from 'vue'
import Router from 'vue-router'

export default 
{
	name: 'home-banner2',	
	data: function() 
	{
		return {
			prodban: {}, 
			homecatdetail1: {
			},
			homecatdetail2: {
			},	
		}
	},
	
	computed: {

	},

	created: function()
	{
		const vr1 = this.$router;
	},
	 mounted: function()
	{
		const vr2 = this.$router;
		this.fetchProdBan();
		this.fetchhomecat1();
		this.fetchhomecat2();
	},
	
	methods: 
	{
		fetchProdBan() 
		{
			axios.get('/api/prodban').then((res) => 
			{
				//console.log( ' linne 172 ' + res);
				this.prodban = res;
			});
		},	
		fetchhomecat1() 
		{
			axios.get('/api/homecat1').then((res) => 
			{	
				this.homecatdetail1 = res.data;
				console.log( ' linne 156 ' + res);
				console.log( ' linne 157 ' + res.data);
			});
		},
		fetchhomecat2() 
		{
			axios.get('/api/homecat2').then((res) => 
			{	
				this.homecatdetail2 = res.data;
				console.log( ' linne 156 ' + res);
				console.log( ' linne 157 ' + res.data);
			});
		},	
	},
}
</script>