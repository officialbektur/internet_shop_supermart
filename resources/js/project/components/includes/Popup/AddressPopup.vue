<template>
	<!-----------------------------------  Popup  --Start--  ----------------------------------->
	<div id="popup__map" aria-hidden="true" class="popup">
		<div class="popup__wrapper">
			<div class="popup__body">
				<div class="popup__header">
					<div class="popup__title">
						Наш адрес
					</div>
					<button data-close type="button" class="popup__close popup-close">
						<span class="popup-close__icon">
							<svg viewBox="0 0 320 512" xmlns="http://www.w3.org/2000/svg"><path d="M310.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 210.7 54.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L114.7 256 9.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 301.3l105.4 105.3c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L205.3 256l105.3-105.4z"/></svg>
						</span>
					</button>
				</div>
				<div class="popup__main">
					<div v-if="infos && infos.adresses && infos.adresses.length > 0" class="popup__map popup-map">
						<div class="popup-map__image">
							<iframe :src="infos.adresses[0].map" id="map" allowfullscreen="" loading="lazy"></iframe>
						</div>
						<div class="popup-map__items popup-map-items">
							<a v-for="(info, index) in infos.adresses" :key="index" :href="info.href" class="popup-map__item popup-map-item">
								<span class="popup-map-item__title">
									Адреc № {{++index }}:
								</span>
								<span class="popup-map-item__textinfo">
									{{ info.title }}
								</span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-----------------------------------  Popup  --End--  ----------------------------------->
</template>

<script>
	import axios from 'axios';
	export default {
		name: 'AddressPopup',
		data() {
			return {
			};
		},
		mounted() {
		},
		updated() {
		},
		methods: {
		},
		computed: {
			infos() {
				return this.$store.getters.app
			}
		},
		components: {
		},
    }
</script>

<style scoped>
</style>
