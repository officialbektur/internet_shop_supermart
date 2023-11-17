<template>
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
				try {
					let response =  await axios.get('/api/abouts');
					if (response && response.data && response.data.content) {
						this.content = response.data.content;
					} else {
						this.content = 'Данных нет!';
					}
				} catch (error) {
					this.content = 'Данных нет!';
				}
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