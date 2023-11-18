<template>
	<div class="block">
		<div class="block__title">Товары</div>
		<div class="block__content">
			<div class="block__header block-header">
				<form method="post" class="block-header__form">
					<input
						v-model="search_input"
						:readonly="isReadOnly"
						autocomplete="off"
						type="text"
						name="form"
						placeholder="Найти по название, коду, сумме, категорий и тегу..."
						class="block-header__input">
						<button
							type="button"
							@click.prevent="clearSearch"
							class="block-header__clear block-header-clear a-hover-bgc"
							:class="{ '_active': search_input !== '' }">
							<span class="block-header-clear__icon">
								<svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg"><path d="M432 256c0 17.69-14.33 32.01-32 32.01H256v144c0 17.69-14.33 31.99-32 31.99s-32-14.3-32-31.99v-144H48c-17.67 0-32-14.32-32-32.01s14.33-31.99 32-31.99h144v-144C192 62.32 206.33 48 224 48s32 14.32 32 32.01v144h144c17.7-.01 32 14.29 32 31.99z"/></svg>
							</span>
						</button>
						<div class="block-header__innersubmit">
							<button
								type="submit"
								:disabled="isReadOnly"
								@click.prevent="search"
								class="block-header__button block-header__submit block-header-submit">
								Найти
							</button>
						</div>
				</form>
				<div class="block-header__sidebar">
					<div class="block-header__sorting block-header-sorting">
						<button
							type="button"
							@click.prevent="filtesContent = !filtesContent"
							class="block-header-sorting__button block-header-sorting-button a-hover-bgc">
							<span class="block-header-sorting-button__icon">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M0 416c0 17.7 14.3 32 32 32l54.7 0c12.3 28.3 40.5 48 73.3 48s61-19.7 73.3-48L480 448c17.7 0 32-14.3 32-32s-14.3-32-32-32l-246.7 0c-12.3-28.3-40.5-48-73.3-48s-61 19.7-73.3 48L32 384c-17.7 0-32 14.3-32 32zm128 0a32 32 0 1 1 64 0 32 32 0 1 1 -64 0zM320 256a32 32 0 1 1 64 0 32 32 0 1 1 -64 0zm32-80c-32.8 0-61 19.7-73.3 48L32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l246.7 0c12.3 28.3 40.5 48 73.3 48s61-19.7 73.3-48l54.7 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-54.7 0c-12.3-28.3-40.5-48-73.3-48zM192 128a32 32 0 1 1 0-64 32 32 0 1 1 0 64zm73.3-64C253 35.7 224.8 16 192 16s-61 19.7-73.3 48L32 64C14.3 64 0 78.3 0 96s14.3 32 32 32l86.7 0c12.3 28.3 40.5 48 73.3 48s61-19.7 73.3-48L480 128c17.7 0 32-14.3 32-32s-14.3-32-32-32L265.3 64z"/></svg>
							</span>
							<span class="block-header-sorting-button__title">
								Фильтрация
							</span>
						</button>
						<div
							class="block-header-sorting__content"
							:class="{ '_show': filtesContent }">
							<div
								v-for="(list, index) in filter_lists"
								:key="index"
								:disabled="isReadOnly"
								@click.prevent="filterAdd(index)"
								class="block-header-sorting__list a-hover-bgc"
								:class="{ '_active': (index == filter) }">
								{{ list }}
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="block__tovars">
				<table class="block__table block-table">
					<thead class="block-table__header block-table-header">
						<tr>
							<th class="block-table-header__list block-table-header__code">
								#
							</th>
							<th class="block-table-header__list block-table-header__title">
								Название
							</th>
							<th class="block-table-header__list block-table-header__delete">
								Статус
							</th>
							<th class="block-table-header__list block-table-header__edit">
								Изменить
							</th>
						</tr>
					</thead>
					<tbody class="block-table__body">
						<tr
							v-if="notProducts"
							class="block-table__tr">
							<td colspan="4" class="block-table__notd">Нету товаров!</td>
						</tr>
						<tovar-component
							v-if="products.length > 0 && !notProducts"
							v-for="(product, index) in products"
							:index="index"
							:product="product"
							:key="index"></tovar-component>
					</tbody>
				</table>
			</div>
		</div>
		<div @click.prevent="sendMore" ref="targetElementLoading" class="more__loading more-loading" :class="{ '_show': lazyLoading && !notProducts }">
			<div class="more-loading__content">
				<div class="more-loading__icon">
					<img src="/storage/project/loading.gif" alt="loading">
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import API from "@/admin/api";
	import { ref, reactive, watchEffect, onMounted } from "vue";

	import TovarComponent from "./includes/Index/IndexComponent.vue";

	export default {
		name: "Index",
		setup() {
			const products = ref([]);
			const notProducts = ref(false);

			const filter = ref(0);
			const filtesContent = ref(false);
			const filter_lists = [
				"По умолчанию",
				"Показать свзязанный по коду",
				"Сначала по акции",
				"Сначала часто покупаемые",
				"Сначала новые",
				"Сначала дешевле",
				"Сначала дороже",
				"Сначала удаленные",
			];

			const search_input = ref("");
			const page = ref(1);

			const isLoading = ref(false);
			const isReadOnly = ref(false);

			const lazyLoading = ref(true);

			const targetElementLoading = ref(null);

			// Create an Intersection Observer
			const observer = new IntersectionObserver((entries) => {
				if (entries[0].isIntersecting && lazyLoading.value) {
					getProducts();
				}
			});

			watchEffect(() => {
				if (targetElementLoading.value) {
					observer.observe(targetElementLoading.value);
				}
			});

			const getProducts = async () => {
				if (!lazyLoading) {
					return false;
				}

				isLoading.value = false;

				const search =
					search_input.value.length > 0 ? `?q=${search_input.value}` : "";
				const filterQuery =
					search_input.value.length > 0 ? `&sort=${filter.value}` : `?sort=${filter.value}`;
				const pageQuery = `&page=${page.value}`;

				page.value++;

				try {
					const response = await API.get(`/api/admin/products${search}${filterQuery}${pageQuery}`);
					if (response && response.data && response.data.length > 0) {
						notProducts.value = false;
						const arrayProducts = products.value;
						arrayProducts.push(...response.data);
						products.value = arrayProducts;
						isReadOnly.value = false;
						isLoading.value = true;

						if (response.data.length !== 20) {
							lazyLoading.value = false;
							isReadOnly.value = false;
						}
					} else {
						if (response.data.length === 0) {
							lazyLoading.value = false;
							isReadOnly.value = false;

							if (products.value.length === 0) {
								notProducts.value = true;
							}
						} else {
							isReadOnly.value = false;
						}
					}
				} catch (error) {
					isReadOnly.value = false;

					if (products.value.length === 0) {
						notProducts.value = true;
					}
				}
			};

			const getSearchHref = (query) => {
				if (query) {
					const queryParams = new URLSearchParams(query);

					if (queryParams.has('q')) {
						search_input.value = queryParams.get('q').trim()
					}
					if (queryParams.has('sort')) {
						filter.value = queryParams.get('sort');
					}

					search()
				}
			};

			const search = () => {
				isReadOnly.value = true;
				isLoading.value = true;
				lazyLoading.value = true;

				if (filter.value >= 0) {
					products.value = [];
					page.value = 1;
					getProducts();
				} else {
					isReadOnly.value = false;
				}
			};

			const clearSearch = () => {
				search_input.value = "";
			};

			const sendMore = () => {
				if (lazyLoading) {
					getProducts();
				}
			};

			const filterAdd = (index) => {
				filtesContent.value = false;
				filter.value = index;
				search();
			};

			return {
				products,
				notProducts,
				filter,
				filtesContent,
				filter_lists,
				search_input,
				isLoading,
				isReadOnly,
				lazyLoading,
				targetElementLoading,
				getProducts,
				getSearchHref,
				search,
				clearSearch,
				sendMore,
				filterAdd,
			};
		},
		mounted() {
			if (this.$route.query) {
				this.getSearchHref(this.$route.query);
			} else {
				this.getProducts();
			}
		},
		updated() {
		},
		components: {
			'tovar-component': TovarComponent
		},
	};
</script>
<style scoped lang="scss">
</style>