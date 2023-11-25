import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
	plugins: [
		laravel({
			input: [
				'resources/css/app.css',
				'resources/js/app.js',
				'resources/sass/admin/app.scss',
				'resources/js/admin/app.js',
				'resources/sass/project/app.scss',
				'resources/js/project/app.js',
			],
			refresh: true,
		}),
		vue({
			template: {
				transformAssetUrls: {
					base: null,
					includeAbsolute: false,
				},
			},
		}),
	],
	resolve: {
		alias: {
			vue: 'vue/dist/vue.esm-bundler.js',
		},
	},
});
