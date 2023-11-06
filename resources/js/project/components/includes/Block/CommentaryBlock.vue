<template>
	<div v-for="commentary in commentaries" :key="commentary" class="moreinfo-tovar-body-reviews-comentary__block moreinfo-tovar-body-reviews-comentary-block">
		<div class="moreinfo-tovar-body-reviews-comentary-block__user moreinfo-tovar-body-reviews-comentary-block-user">
			<div class="moreinfo-tovar-body-reviews-comentary-block-user__avatar">{{ commentary.name[0] }}</div>
			<div class="moreinfo-tovar-body-reviews-comentary-block-user__info">
				<div class="moreinfo-tovar-body-reviews-comentary-block-user__name">{{ commentary.name }}</div>
				<div class="moreinfo-tovar-body-reviews-comentary-block-user__ratinganddate">
					<div class="moreinfo-tovar-body-reviews-comentary-block-user__rating moreinfo-tovar-body-reviews-comentary-block-user-rating">
						<span v-for="index in 5" :key="index" class="moreinfo-tovar-body-reviews-comentary-block-user-rating__icon" :class="{ '_active': index <= commentary.rating }"></span>
					</div>
					<div class="moreinfo-tovar-body-reviews-comentary-block-user__data">{{ commentary.data }}</div>
				</div>
			</div>
		</div>
		<div class="moreinfo-tovar-body-reviews-comentary-block__massege">
			{{ commentary.message }}
		</div>
	</div>
</template>

<script>
	export default {
		name: 'CommentaryBlock',
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
			commentaries() {
				return this.$store.getters.commentaries;
			},
		},
		components: {
		},
	}
</script>
<style scoped lang="scss">
</style>