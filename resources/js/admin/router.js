import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';

import API from '@/admin/api';

import store from './store/index.js';


const app = createApp({});
const router = createRouter({
	history: createWebHistory(),
	routes: [

		/* ===================================  User Login  --Start--  =================================== */
		// {
		// 	path: '/admin/login',
		// 	component: () => import('./components/User/Login.vue'),
		// 	name: 'users.login'
		// },
		/* ===================================  User Login  --End--  =================================== */



		/* ===================================  User Registration --Start--  =================================== */
		// {
		// 	path: '/admin/registration',
		// 	component: () => import('./components/User/Registration.vue'),
		// 	name: 'users.registration'
		// },
		// {
		// 	path: '/admin/resetpassword',
		// 	component: () => import('./components/User/ResetPassword.vue'),
		// 	name: 'users.resetpassword'
		// },
		/* ===================================  User Registration --End--  =================================== */


		/* ===================================  Index  --Start--  =================================== */
		{
			path: '/admin/',
			component: () => import('./components/Tovar/Index.vue'),
			name: 'index'
		},
		/* ===================================  Index --End--  =================================== */



		/* ===================================  Setting  --Start--  =================================== */
		{
			path: '/admin/',
			component: () => import('./components/Setting/Index.vue'),
			name: 'settings.index'
		},
		/* ===================================  Setting  --End--  =================================== */



		/* ===================================  App  --Start--  =================================== */
		{
			path: '/admin/app',
			component: () => import('./components/App/Index.vue'),
			name: 'app.index'
		},
		/* ===================================  App  --End--  =================================== */



		/* ===================================  Tovar  --Start--  =================================== */
		{
			path: '/admin/tovars',
			component: () => import('./components/Tovar/Index.vue'),
			name: 'tovars.index'
		},
		{
			path: '/admin/tovars/create',
			component: () => import('./components/Tovar/Create.vue'),
			name: 'tovars.create'
		},
		{
			path: '/admin/tovars/edit/:id',
			component: () => import('./components/Tovar/Edit.vue'),
			name: 'tovars.edit'
		},
		/* ===================================  Tovar  --End--  =================================== */



		/* ===================================  Tovar  --Start--  =================================== */
		{
			path: '/admin/commentaries',
			component: () => import('./components/Commentary/Index.vue'),
			name: 'commentaries.index'
		},
		/* ===================================  Tovar  --End--  =================================== */



		/* ===================================  Category  --Start--  =================================== */
		{
			path: '/admin/categories',
			component: () => import('./components/Category/Index.vue'),
			name: 'categories.index'
		},
		{
			path: '/admin/categories/edit',
			component: () => import('./components/Category/Edit.vue'),
			name: 'categories.edit'
		},
		{
			path: '/admin/categories/deletes',
			component: () => import('./components/Category/Deletes.vue'),
			name: 'categories.delete'
		},
		{
			path: '/admin/categories/:id/update',
			component: () => import('./components/Category/Update.vue'),
			name: 'categories.update'
		},
		{
			path: '/admin/categories/create',
			component: () => import('./components/Category/Create.vue'),
			name: 'categories.create'
		},
		/* ===================================  Category  --End--  =================================== */

		/* ===================================  Specification  --Start--  =================================== */
		{
			path: '/admin/specifications',
			component: () => import('./components/Specification/Index.vue'),
			name: 'specifications.index'
		},
		{
			path: '/admin/specifications/edit',
			component: () => import('./components/Specification/Edit.vue'),
			name: 'specifications.edit'
		},
		{
			path: '/admin/specifications/deletes',
			component: () => import('./components/Specification/Deletes.vue'),
			name: 'specifications.delete'
		},
		{
			path: '/admin/specifications/:id/update',
			component: () => import('./components/Specification/Update.vue'),
			name: 'specifications.update'
		},
		{
			path: '/admin/specifications/create',
			component: () => import('./components/Specification/Create.vue'),
			name: 'specifications.create'
		},
		/* ===================================  Specification  --End--  =================================== */

		/* ===================================  СategorySpecification  --Start--  =================================== */
		{
			path: '/admin/categoryspecifications',
			component: () => import('./components/СategorySpecification/Index.vue'),
			name: 'categoryspecifications.index'
		},
		{
			path: '/admin/categoryspecifications/:id/specifications',
			component: () => import('./components/СategorySpecification/LinkingSpecification.vue'),
			name: 'categoryspecifications.specifications'
		},
		{
			path: '/admin/categoryspecifications/edit',
			component: () => import('./components/СategorySpecification/Edit.vue'),
			name: 'categoryspecifications.edit'
		},
		{
			path: '/admin/categoryspecifications/:id/update',
			component: () => import('./components/СategorySpecification/Update.vue'),
			name: 'categoryspecifications.update'
		},
		{
			path: '/admin/categoryspecifications/create',
			component: () => import('./components/СategorySpecification/Create.vue'),
			name: 'categoryspecifications.create'
		},
		{
			path: '/admin/categoryspecifications/:id/store',
			component: () => import('./components/СategorySpecification/Store.vue'),
			name: 'categoryspecifications.store'
		},
		/* ===================================  СategorySpecification  --End--  =================================== */

		/* ===================================  Tag  --Start--  =================================== */
		{
			path: '/admin/tags',
			component: () => import('./components/Tag/Index.vue'),
			name: 'tags.index'
		},
		{
			path: '/admin/tags/:id/update',
			component: () => import('./components/Tag/Update.vue'),
			name: 'tags.update'
		},
		{
			path: '/admin/tags/deletes',
			component: () => import('./components/Tag/Deletes.vue'),
			name: 'tags.delete'
		},
		{
			path: '/admin/tags/create',
			component: () => import('./components/Tag/Create.vue'),
			name: 'tags.create'
		},
		/* ===================================  Tag  --End--  =================================== */

		/* ===================================  SearchHints  --Start--  =================================== */
		{
			path: '/admin/searchhints',
			component: () => import('./components/SearchHints/Index.vue'),
			name: 'searchhints.index'
		},
		{
			path: '/admin/searchhints/:id/update',
			component: () => import('./components/SearchHints/Update.vue'),
			name: 'searchhints.update'
		},
		{
			path: '/admin/searchhints/create',
			component: () => import('./components/SearchHints/Create.vue'),
			name: 'searchhints.create'
		},
		/* ===================================  SearchHints  --End--  =================================== */

		/* ===================================  About  --Start--  =================================== */
		{
			path: '/admin/abouts',
			component: () => import('./components/About/Edit.vue'),
			name: 'abouts.edit'
		},
		/* ===================================  About  --End--  =================================== */

		/* ===================================  404  --Start--  =================================== */
		{
			path: '/:catchAll(.*)',
			component: () => import('./components/Setting/Index.vue'),
			name: '404'
		}
		/* ===================================  404  --End--  =================================== */
	]
});

router.beforeEach((to, from, next) => {
	const accessToken = localStorage.getItem('access_token');

	if (!accessToken) {
		localStorage.removeItem('access_token');
		store.commit("setIsVerify", false)
		store.commit("setIsPreloader", false)
		store.dispatch("getScanLogCount")
		document.documentElement.classList.add('lock');
	}

	next();
});

export default router;