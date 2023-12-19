require('./bootstrap');
import Vue from 'vue';
import VueRouter from 'vue-router';
import VueCarousel from '@chenfengyuan/vue-carousel';
import Vuex from 'vuex';
import VeeValidate from 'vee-validate'
//import {routes} from './routes.js';
import storeData from './store.js';

import MainHome from './components/Main.vue';
import Home from './components/Home.vue';
import About from './components/About.vue';
import Homebanner from './components/Homebanner.vue';
import Political from './components/Political.vue';
import Politicaltag from './components/Politicaltag.vue';
import Politicaldetail from './components/Politicaldetail.vue';
import Politicalsearch from './components/Politicalsearch.vue';
import Contact from './components/Contact.vue';
import Link from './components/Link.vue';
import Video from './components/Video.vue';
import Webservice from './components/Webservice.vue';
import Webdev from './components/Webdev.vue';


import Gallery from './components/Gallery.vue';


Vue.component('pagination', require('laravel-vue-pagination'));

export const routes = [

	{
		path: '/',
		name: 'home1',
		component: Home,
	},
	{
		path: '/home',
		name: 'home',
		component: Home,
	},
	
	{
		path: '/ArmenianBlog/',
		name: 'ArmenianBlog',
		component: Home,
	},
	
	{
		path: '/about',
		name: 'about',
		component: About,
	},
	
	{
		path: '/Armenian-blog-Lebanese-politics/Nationalism/Socialism/Social-Justice/',
		name: 'Armenian-blog-Lebanese-politics/Nationalism/Socialism/Social-Justice',
		component: About,
	},

	{
		path: '/contact',
		name: 'contact',
		component: Contact,
	},
	
	{
		path: '/Armenian-FreeLance-Web-Developer-Lebanese-Website-Development',
		name: 'Armenian-FreeLance-Web-Developer-Lebanese-Website-Development',
		component: Contact,
	},
	

	
	{
		path: '/links',
		name: 'links',
		component: Link,
		props: true,
	}
	,
	
	
	{
		path: '/Web-Development-FreeLance-Lebanese-Web-Developer-Website-SEO/',
		name: 'Web-Development-FreeLance-Lebanese-Web-Developer-Website-SEO',
		component: Webservice,
		props: true,
	}
	,
	{
		path: '/Lebanese/Armenian/Freelance/PHP/Web/Developer/Website/Development/Armenia/Lebanon',
		name: 'Lebanese/Armenian/Freelance/PHP/Web/Developer/Website/Development/Armenia/Lebanon',
		component: Webdev,
		props: true,
	}
	,
	
	{
		path: '/video',
		name: 'video',
		component: Video,
		props: true,
	}
	,
	
	
	
	
	
	
	
	{
		path: '/political/:catid?/:cat?/:subid?/:sub?/',
		name: 'political',
		component: Political,
		props: true,
	}
	,
	
	
	{
		path: '/politicaltag/:tag/',
		name: 'politicaltag',
		component: Politicaltag,
		props: true,
	}
	,
	
	
	{

		path: '/politicaldetail/:id/:title?/:cat?/:sub?/',
		name: 'politicaldetail',
		component: Politicaldetail,
		props: true,
	}
	,
	
	{

		path: '/politicalsearch/',
		name: 'politicalsearch',
		component: Politicalsearch,
		props: true,
	}
	,
	

	
	

]

Vue.use(VeeValidate);
Vue.use(VueRouter);
Vue.use(Vuex);
Vue.use(VueCarousel);
const router = new VueRouter({
	routes,
	mode: 'history'
});

const store = new Vuex.Store(storeData);

Vue.mixin({
  data: function() {
    return {
      globalURL:'https://national-armenia.org/'
    }
  }
})


const app2 = new Vue({
	el: '#app2',
	router,
	store,
	created: function() {
    
  },
	
	
	components: 
	{
		MainHome
	}
});