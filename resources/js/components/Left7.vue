<template>	
<div class="col-lg-8 left_sidebar">
	<!-- Tranding Area Post -->
	<div class="row tranding_post_area">
		<div class="col-12 tranding_tittle marginbottom5"> 
			<h2>Contact Us</h2> <br>
		</div>
		<div class = 'row margintopbottom4'>
		
		<div class="row feature_post_area margintopbottom4 marginleft2percent">
			<div class="col-11 marginleft2percent">

				<div class ='displayinlineblockclear100'>
				<form @submit.prevent="contacter" id="main_contact_form" method = 'post' enctype="multipart/form-data">
					<div class="contact_input_area">
						<div id="success_fail_info"></div>
						<div class="row">
							<!-- Form Group -->
							<div class="col-12">
								<div class="form-group">
									<input type="text" class="form-control mb-30" name="name" id="name" placeholder="Your Name"
									v-model="formContact.name"  required>
								</div>
							</div>
							<!-- Form Group -->
							<div class="col-12">
								<div class="form-group">
									<input type="text" class="form-control mb-30" name="name" id="name2" placeholder="Last Name"
									v-model="formContact.name2"  required>
								</div>
							</div>

							<div class="col-12">
								<div class="form-group">
									<input type="email" class="form-control mb-30" name="email" id="email" placeholder="E-mail"
									v-model="formContact.email" required >
								</div>
							</div>

							<div class="col-12">
								<div class="form-group">
									<input type="text" class="form-control mb-30" name="phone" id="phone" placeholder="Your Number"
									v-model="formContact.phone"  >
								</div>
							</div>

							<div class="col-12">
								<div class="form-group">
									<textarea name="message" class="form-control mb-30" id="message" cols="30" rows="6" 
									v-model="formContact.message" required placeholder="Your Message *"></textarea>
								</div>
							</div>
							
							<div class="col-12">
								<div class="form-group">
									<input type="file" v-on:change="onImageChange" class="form-control" id = 'filer' 
									 ref="file" name="file" 
									 accept=".doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,image/png, image/jpeg, image/jpg, image/gif,application/pdf,text/plain"> 
									 <b class='black'>Allowed file types: gif, jpeg, png, plain text, word, pdf only </b>
								</div>
							</div>		
						
							<div class="col-12"  id = 'result2'>
								<button type="submit" 
								class="btn button1 primary confer-btn submit_btn ">Send Message 
								<i class="zmdi zmdi-long-arrow-right"></i></button>
							</div>
							<div class="col-12" id = 'result'>
							</div>
							
						</div>
					</div>
				</form>
				</div>

				<div class ='displayinlineblockclear100 margintopbottom8'>
					<div>	
						<p>
						Contact This web site, for your articles,<br>
						Or if you require my web development services for your web site<br>
						PHP Laravel VueJS jquery JavaScript CSS Full Stack web developer<br>
						Free Lance Web Development<br>
						I design and developer your web site from A to Z, either through a ready template<br>
						Or with a custom Design with the help of a web designer<br>
						SEO Services<br>
						Free Lance web development Lebanon / Armenia</p>
						<p>
							<a href = 'mailto:webdeveloper@socialist-armenia.org' target = '_blank' >
							&raquo; webdeveloper@socialist-armenia.org </a>
						</p>
						<p>
						<a href = 'mailto:webdeveloper@national-armenia.org' target = '_blank' >
							&raquo; webdeveloper@national-armenia.org </a>
						</p>
	
					</div>
				
				
				</div>
			
				
			</div>
			
			
			<div class="col-10 center margintopbottom8">
		   <div 
			v-if ="homebannerdetail1.linkk &&  homebannerdetail1.linkk != null  && homebannerdetail1.linkk != '' " 
		   class='center'>
			<a v-bind:href=homebannerdetail1.linkk target = '_blank' class='center'>
			<img v-bind:src=
			"'https://www.socialist-armenia.org/images/ban/' + homebannerdetail1.img" 
			v-bind:alt = homebannerdetail1.name 
			class='margintopbottom8 maximg center '/> </a>	
		   </div>
		   
		   	<div v-else class='center'>
			<img v-bind:src=
			"'https://www.socialist-armenia.org/images/ban/' + homebannerdetail1.img" 
			v-bind:alt = homebannerdetail1.name class='marginbottom11 maximg center '/>
		   </div>   
		</div>
		
		<!--ethereum_price_posts -->
		<div class="col-10 margintopbottom8 center"> 
			<div 
			v-if ="homebannerdetail2.linkk &&  homebannerdetail2.linkk != null  && homebannerdetail2.linkk != '' "
			class='center'>
			<a v-bind:href=homebannerdetail2.linkk target = '_blank' class='center'>	
				<img v-bind:src=
				"'https://www.socialist-armenia.org/images/ban/' + homebannerdetail2.img" 
				class='marginbottom11 maximg center '
				v-bind:alt = homebannerdetail2.name />
			</a>
			</div>
			
			<div v-else class='center'> 
			<img v-bind:src=
			"'https://www.socialist-armenia.org/images/ban/' + homebannerdetail2.img" 
			class='marginbottom11 maximg center '
			v-bind:alt = homebannerdetail2.name />
			</div>
		</div>

			
		</div></div>

	</div>
</div>

</template>


<script>

import router from '../app2.js'
import Vue from 'vue'
import Router from 'vue-router'

export default 
{
	name: 'app-left7',
	
	data: function() 
	{
		return {
			prods: {}, 
			
			homebannerdetail1: {},
			homebannerdetail2: {},
			keywords: null,
			
				formContact:{
				name:'',
				name2:'',
				phone:'',
				email:'',
				message:'',
				attachment: '' ,
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
		
	
		this.fetchhomeban1();
		this.fetchhomeban2();
		
		let app = this;

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
		
		

		onImageChange(e) {
			//alert(1);
			//this.formContact.attachment = this.$refs.file.files[0];
			this.formContact.attachment = e.target.files[0];
		
			
		},
		createImage(file) {
			//alert(2);
			let reader = new FileReader();
			let vm = this;
			reader.onload = (e) => {
				vm.formContact.attachment = e.target.result;

			};
			reader.readAsDataURL(file);
		},
		
		contacter(){
		
			$("#result").html("<p><b class='red'>  ..... </b></p>");
            let formData = {
                name:this.formContact.name,
				name2:this.formContact.name2,
				phone:this.formContact.phone,
                email:this.formContact.email,
                message:this.formContact.message,
            };
			/*
            return axios.post('/api/contacter/', formData).then(data => {
              // Change to notify the user
              console.log('Message sent');
            });
			*/
				let formDatax = new FormData();
				//var form = new FormData();
				formDatax.append('name', this.formContact.name);
				formDatax.append('name2', this.formContact.name2);
				formDatax.append('phone', this.formContact.phone);
				formDatax.append('email', this.formContact.email);
				formDatax.append('attachment', this.formContact.attachment);
				formDatax.append('message', this.formContact.message);
				
				
				//formDatax.append('file', this.formContact.attachment);
				
				
			    axios.post('/api/contacterattach', formDatax,
				{
					headers: {
						'Content-Type': 'multipart/form-data'
					}
				}
				
				
				
				).then(function (resp) {
				
				console.log('Message sent' + resp);
				 $("#result").html("<p><b class='red'> " +   resp.data + " </b></p>");
				 $('html, body').animate({
					scrollTop: $("#result").offset().top - 512
				}, 2000);
				 
				 
				})
				.catch(function (resp) {
					console.log(resp);
					alert("Could not contact" + resp);
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


<style>
  #result {
    align-items: center;
	font-size:16px;
	color:red;
	margin:5px 3px 8px 3px;
	display:inline-block;
	width:93%;
	min-height:10px;
	padding:4px;
  }

  #result p {
	font-size:16px;
	color:red;
  }
  
  #result b {
	font-size:16px;
	color:red;
  }
  
  .red
  {
	color:red;
  }
  .3rddiv
  {
	min-height:10px;
  }
</style>