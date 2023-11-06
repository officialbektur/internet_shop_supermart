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
						<tr
							v-if="products.length > 0 && !notProducts"
							v-for="(product, index) in products"
							:key="index"
							class="block-table__tr">
							<td class="block-table__td block-table__tdcode">
								{{ product.id }}
							</td>
							<td class="block-table__td block-table__tdtitle block-table-tdtitle">
								<div class="block-table__title block-table-title">
									<div class="block-table-title__image block-table-title-image">
										<div class="block-table-title-image__img">
											<img :data-src="product.image" src="/storage/project/loading.gif" @error="$store.dispatch('handleImageError', $event)" :alt="`${product.title}_${product.id}`">
										</div>
									</div>
									<div class="block-table-title__infotext block-table-titleinfotext">
										<div class="block-table-title-infotext__category">
											Категория<template v-for="category in Array.isArray(product.categories) ? product.categories : []"> > {{ category.name }}</template>
										</div>
										<div class="block-table-title-infotext__title">
											{{ product.title }}
										</div>
										<div class="block-table-title-infotext__price block-table-title-infotext-price">
											<span class="block-table-title-infotext-price__number">{{ product.price_now }}</span><span class="block-table-title-infotext-price__text">сом</span>
										</div>
									</div>
								</div>
								<div class="block-table-tdtitle__menu">
									<div class="block-table-tdtitle__sticker block-table-tdtitle__hit" :class="{ '_show': product.hit }">Хит</div>
									<router-link :to="{ name: 'commentaries.index', query: { q: product.id, sort: 4 } }" class="block-table-tdtitle__sticker block-table-tdtitle__title a-hover-bgc">Коментарий: {{ product.commentaries }}</router-link>
									<div class="block-table-tdtitle__sticker block-table-tdtitle__discount" :class="{ '_show': product.discount }">Акция</div>
								</div>
							</td>
							<td class="block-table__td block-table__tddelete">
								<div class="block-table__delete block-table-delete">
									<div class="mrb-admin-form__chekbox mrb-admin-form-chekbox">
										<div class="mrb-admin-form-chekbox__input">
											<input
												:disabled="isReadOnly"
												@click="deleteProduct(product.id, index)"
												:id="'delete_' + index"
												:checked="product.status == 1"
												type="checkbox"
												name="delete">
											<label :for="'delete_' + index"></label>
											<div class="mrb-admin-form-chekbox__status mrb-admin-form-chekbox-status">
												<div class="mrb-admin-form-chekbox-status__not">Нет</div>
												<div class="mrb-admin-form-chekbox-status__yes">Да</div>
											</div>
										</div>
									</div>
								</div>
							</td>
							<td class="block-table__td block-table__tdedit">
								<router-link :to="{ name: 'tovars.edit', params: {id: product.id} }" class="block-table__edit block-table-edit">
									<div class="block-table-edit__button block-table-edit-button a-hover-bgc">
										<span class="block-table-edit-button__icon">
											<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M490.3 40.4C512.2 62.27 512.2 97.73 490.3 119.6L460.3 149.7L362.3 51.72L392.4 21.66C414.3-.2135 449.7-.2135 471.6 21.66L490.3 40.4zM172.4 241.7L339.7 74.34L437.7 172.3L270.3 339.6C264.2 345.8 256.7 350.4 248.4 353.2L159.6 382.8C150.1 385.6 141.5 383.4 135 376.1C128.6 370.5 126.4 361 129.2 352.4L158.8 263.6C161.6 255.3 166.2 247.8 172.4 241.7V241.7zM192 63.1C209.7 63.1 224 78.33 224 95.1C224 113.7 209.7 127.1 192 127.1H96C78.33 127.1 64 142.3 64 159.1V416C64 433.7 78.33 448 96 448H352C369.7 448 384 433.7 384 416V319.1C384 302.3 398.3 287.1 416 287.1C433.7 287.1 448 302.3 448 319.1V416C448 469 405 512 352 512H96C42.98 512 0 469 0 416V159.1C0 106.1 42.98 63.1 96 63.1H192z"/></svg>
										</span>
									</div>
								</router-link>
							</td>
						</tr>
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

			const deleteProduct = async (id, index) => {
				isReadOnly.value = true;
				try {
					const response = await API.delete(`/api/admin/products/${id}`);
					if (response && response.data) {
						const updatedProducts = products.value;
						updatedProducts[index].status = response.data.status;
						products.value = updatedProducts;
						isReadOnly.value = false;
					} else {
						isReadOnly.value = false;
					}
				} catch (error) {
					isReadOnly.value = false;
				}
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
				deleteProduct,
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
			this.$store.dispatch("lazyMedia")
		}
	};
</script>
<style scoped lang="scss">
</style>