import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';

const app = createApp({});

import store from './store/index.js';


const router = createRouter({
	history: createWebHistory(),
	routes: [
		{
			path: '/',
			component: () => import('./components/Product/Index.vue'),
			name: 'index'
		},
		{
			path: '/search',
			component: () => import('./components/Product/Search.vue'),
			name: 'search'
		},
		{
			path: '/histories',
			component: () => import('./components/Product/History.vue'),
			name: 'histories'
		},
		{
			path: '/favorites',
			component: () => import('./components/Product/Favorite.vue'),
			name: 'favorites'
		},
		// {
		// 	path: '/categories/:id',
		// 	component: () => import('./components/Product/Category.vue'),
		// 	name: 'categories'
		// },
		{
			path: '/trash',
			component: () => import('./components/Product/Trash.vue'),
			name: 'trash'
		},
		{
			path: '/hits',
			component: () => import('./components/Product/Hit.vue'),
			name: 'hits'
		},
		{
			path: '/discounts',
			component: () => import('./components/Product/Discount.vue'),
			name: 'discounts'
		},
		{
			path: '/nowproducts',
			component: () => import('./components/Product/Nowproduct.vue'),
			name: 'nowproducts'
		},
		{
			path: '/abouts',
			component: () => import('./components/About/About.vue'),
			name: 'abouts'
		},
		{
			path: '/products/:id',
			component: () => import('./components/Product/Show.vue'),
			name: 'show'
		},
		{
			path: '/',
			component: () => import('./components/404/404.vue'),
			name: '404'
		}
	]
});


export default router;