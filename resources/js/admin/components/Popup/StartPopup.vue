<template>
	<!-----------------------------------  Popup  --Start--  ----------------------------------->
	<div id="start" aria-hidden="true" class="popup">
		<div class="popup__wrapper">
			<div class="popup__body">
				<div class="popup__header">
					<div class="popup__title">
						Start
					</div>
					<button data-close type="button" class="popup__close popup-close">
						<span class="popup-close__icon">
							<svg viewBox="0 0 320 512" xmlns="http://www.w3.org/2000/svg"><path d="M310.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 210.7 54.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L114.7 256 9.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 301.3l105.4 105.3c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L205.3 256l105.3-105.4z"/></svg>
						</span>
					</button>
				</div>
				<div class="popup__main">

				</div>
			</div>
		</div>
	</div>
	<!-----------------------------------  Popup  --End--  ----------------------------------->
</template>

<script>
	export default {
		name: 'StartPopup',
		data() {
			return {
			};
		},
		mounted() {
		},
		updated() {
		},
		methods: {
			async get() {
				try {
					let response = await axios.get('/api/');
					if (response && response.data && response.data.length > 0) {
					} else {
					}
				} catch (error) {
				}
			},
		},
		computed: {
		},
		components: {
		},
	}
</script>
<style scoped lang="scss">
</style>