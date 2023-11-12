<template>
	<div class="moreinfo-tovar-body-reviews__commentary moreinfo-tovar-body-reviews-comentary">
		<div class="moreinfo-tovar-body-reviews-comentary__title">Отзывы: <span>{{ commentariesCount }}</span></div>
		<div class="moreinfo-tovar-body-reviews-comentary__body">
			<template v-if="commentaries && commentaries.length > 0">
				<commentary-block></commentary-block>
				<a href data-popup="#commentaries" class="moreinfo-tovar-body-reviews-comentary__button">
					Показавать все отзывы
				</a>
			</template>
			<div v-else class="moreinfo-tovar-body-reviews-comentary__nocomentary moreinfo-tovar-body-reviews-comentary-nocomentary">
				<div class="moreinfo-tovar-body-reviews-comentary-nocomentary__image">
					<img src="/storage/project/111.gif" alt="loading"/>
				</div>
				<div class="moreinfo-tovar-body-reviews-comentary-nocomentary__text">
					«Отзывов пока нет»
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import CommentaryBlock from "@/project/components/includes/Block/CommentaryBlock.vue";
    export default {
		name: 'CommentaryComponent',
		data(){
			return {
			}
		},
		mounted() {
		},
		methods: {
		},
		computed: {
			commentaries() {
				return this.$store.getters.commentaries;
			},
			commentariesCount() {
				return this.$store.getters.commentariesCount;
			},
		},
		components: {
			'commentary-block': CommentaryBlock,
		}
    }
</script>