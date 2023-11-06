<template>
	<div ref="targetElement" @click="$store.dispatch('loadMoreButton')" class="more__loading more-loading" :class="{ '_show': isLoading }">
		<div class="more-loading__content">
			<div class="more-loading__icon">
				<img src="/storage/project/loading.gif" alt="loading">
			</div>
		</div>
	</div>
</template>

<script>
import { ref, watchEffect } from 'vue';
import { useStore } from 'vuex';
export default {
	name: 'LoadingBlock',
	computed: {
		isLoading() {
			return this.$store.getters.isLoading
		},
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
};
</script>