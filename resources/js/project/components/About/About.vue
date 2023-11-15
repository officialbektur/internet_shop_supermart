<template>
	<section class="content">
		<div class="content__container">
			<h2 class="_title mx-body">
				О нас
			</h2>
			<div class="content__body mx-body">
				{{ content }}
			</div>
		</div>
	</section>
</template>

<script>

	export default {
		name: 'About',
		data(){
			return {
				content: null
			}
		},
		mounted() {
			this.getAbout();
		},
		methods: {
			async getAbout() {
				axios.get(`/api/abouts`)
				.then(res => {
					if (res && res.data && res.data.content) {
						this.content = res.data.content;
					}
				})
				this.preloader();
			},
		},
		updated() {
		},
		computed: {
		},
		components: {
		}
    }
</script>