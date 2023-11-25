<template>
	<preloader rgba="rgba(0, 0, 0, 0.95)" :class="{ '_hidde': isPreloader }"></preloader>
	<section class="content">
		<div class="content__container">
			<h2 class="_title mx-body">
				О нас
			</h2>
			<div class="content__body mx-body ql-editor" v-html="content"></div>
		</div>
	</section>
</template>

<script>
	import Preloader from '@/project/plugins/Preloader/Preloader.vue';

	export default {
		name: 'About',
		beforeCreate() {
			document.documentElement.classList.add('lock');
		},
		data(){
			return {
				isPreloader: false,
				content: null
			}
		},
		mounted() {
			this.getAbout();
		},
		methods: {
			async getAbout() {
				try {
					let response =  await axios.get('/api/abouts');
					if (response && response.data && response.data.content) {
						this.content = response.data.content;
					} else {
						this.content = 'Данных нет!';
					}
				} catch (error) {
					this.content = 'Данных нет!';
				} finally {
					this.preloader();
				}
			},
			preloader() {
				document.documentElement.classList.remove('lock');
				this.isPreloader = true;
			},
		},
		updated() {
		},
		computed: {
		},
		components: {
			'preloader': Preloader,
		}
    }
</script>