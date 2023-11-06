<template>
	<!-----------------------------------  Popup  --Start--  ----------------------------------->
	<div id="commentaries" aria-hidden="true" class="popup">
		<div class="popup__wrapper">
			<div class="popup__body">
				<div class="popup__header">
					<div class="popup__title">
						Коментарий: {{ commentariesCount }}
					</div>
					<button data-close type="button" class="popup__close popup-close">
						<span class="popup-close__icon">
							<svg viewBox="0 0 320 512" xmlns="http://www.w3.org/2000/svg"><path d="M310.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 210.7 54.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L114.7 256 9.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 301.3l105.4 105.3c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L205.3 256l105.3-105.4z"/></svg>
						</span>
					</button>
				</div>
				<div class="popup__main">
					<commentary-block></commentary-block>
					<div ref="targetElement" @click="$store.dispatch('loadMoreButtonCommentaries')" class="more__loading more-loading" :class="{ '_show': isLoading }">
						<div class="more-loading__content">
							<div class="more-loading__icon">
								<img src="/storage/project/loading.gif" alt="loading">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-----------------------------------  Popup  --End--  ----------------------------------->
</template>

<script>
	import { ref, watchEffect } from 'vue';
	import { useStore } from 'vuex';
	import CommentaryBlock from "@/project/components/includes/Block/CommentaryBlock.vue";
	import LoadingBlock from "@/project/components/includes/Block/LoadingBlock.vue";
	export default {
		name: 'CommentaryPopup',
		computed: {
			commentariesCount() {
				return this.$store.getters.commentariesCount;
			},
			isLoading() {
				return this.$store.getters.isLoading;
			}
		},
		setup() {
			const store = useStore();
			const targetElement = ref(null);

			// Создаем Intersection Observer
			const observer = new IntersectionObserver((entries) => {
				// Если элемент становится видимым, вызываем функцию
				if (entries[0].isIntersecting && store.getters.isLoading) {
					store.dispatch('getProducts');
				}
			});

			watchEffect(() => {
				// Начинаем наблюдение за элементом, когда компонент монтируется
				if (targetElement.value) {
					observer.observe(targetElement.value);
				}
			});

			return { targetElement };
		},
		data(){
			return {
			}
		},
		mounted() {
		},
		methods: {
		},
		components: {
			'commentary-block': CommentaryBlock,
			'loading-block': LoadingBlock,
		},
    }
</script>

<style scoped>
</style>