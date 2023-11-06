<template>
	<router-link :to="{ name: 'favorites' }" class="header-top-bar__block header-top-bar-block a-hover-bgc">
		<span class="header-top-bar-block__info header-top-bar-block-info">
			<span class="header-top-bar-block-info__icon">
				<svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M47.6 300.4l180.7 168.7c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9l180.7-168.7c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141-45.6-7.6-92 7.3-124.6 39.9l-12 12-12-12c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z"/></svg>
			</span>
			<span class="header-top-bar-block-info__number">{{ $store.getters.countFavoriteTovars }}</span>
		</span>
		<span class="header-top-bar-block__title">Избранные</span>
	</router-link>
</template>

<script>
    export default {
		name: 'FavoriteBlock',
		data() {
			return {
			};
		},
		mounted() {
		},
		methods: {
		},

		components: {

		}
    }
</script>