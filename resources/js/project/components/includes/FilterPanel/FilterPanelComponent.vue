<template>
	<!-- <section class="filter-panel">
		<div class="filter-panel__container">
			<form action="" method="post" class="filter-panel__body mx-body">
				<div class="filter-panel__row">
					<div class="filter-panel__categories filter-panel-categories">
						<div class="filter-panel-categories__label">
							Категорий
						</div>
						<div class="filter-panel-categories__content" :class="{ '_active': $store.getters.isActiveMenuFilterPanel }">
							<div
								@click.prevent="changeIsActiveMenuFilterPanel($event)"
								class="filter-panel-categories__button filter-panel-categories-button a-hover-bgc"
								:class="{ '_active': $store.getters.categoryTitle }">
								<span class="filter-panel-categories-button__title">
									{{ $store.getters.categoryTitle !== '' ? $store.getters.categoryTitle : 'Выберите категорию' }}
								</span>
								<span class="filter-panel-categories-button__icon">
									<svg viewBox="0 0 384 512" xmlns="http://www.w3.org/2000/svg"><path d="M352 352c-8.188 0-16.38-3.125-22.62-9.375L192 205.3 54.6 342.7c-12.5 12.5-32.75 12.5-45.25 0s-12.5-32.75 0-45.25l160-160c12.5-12.5 32.75-12.5 45.25 0l160 160c12.5 12.5 12.5 32.75 0 45.25-6.2 6.2-14.4 9.3-22.6 9.3z"/></svg>
								</span>
								<span @click="$store.dispatch('clearCategoryTitle')" class="filter-panel-categories-button__clear a-hover-bgc">
									<svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg"><path d="M432 256c0 17.69-14.33 32.01-32 32.01H256v144c0 17.69-14.33 31.99-32 31.99s-32-14.3-32-31.99v-144H48c-17.67 0-32-14.32-32-32.01s14.33-31.99 32-31.99h144v-144C192 62.32 206.33 48 224 48s32 14.32 32 32.01v144h144c17.7-.01 32 14.29 32 31.99z"/></svg>
								</span>
							</div>
							<div class="filter-panel-categories__menu filter-panel-categories-menu">
								<div
									ref="data-category-menu"
									class="filter-panel-categories-menu__lists"
									data-category-menu>
									<template v-if="$store.getters.categories.length > 0">
										<categories v-for="category in $store.getters.categories" :category="category" :key="category"></categories>
									</template>
									<template v-else>
										<div class="filter-panel-categories-menu__null">Нету данных!</div>
									</template>
								</div>
							</div>
						</div>
					</div>
					<div class="filter-panel__search filter-panel-search">
						<div class="filter-panel-search__label filter-panel-categories__label">
							Поиск
						</div>
						<div class="filter-panel-categories__content filter-panel-search__content">
							<input
								autocomplete="off"
								type="text"
								name="search"
								@input="withSearchInput($event)"
								:value="$store.getters.searchInput"
								class="filter-panel-search__input"
								placeholder="Поиск по сайту...">
							<div
								@click="$store.dispatch('buttonClearSearchInput')"
								class="header-top-search__clear header-top-search-clear a-hover-bgc"
								:class="{ '_active': $store.getters.searchInput.length > 0 }">
								<button type="button" class="header-top-search-clear__button header-top-search-clear-button">
									<span class="header-top-search-clear-button__icon">
										<svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg"><path d="M432 256c0 17.69-14.33 32.01-32 32.01H256v144c0 17.69-14.33 31.99-32 31.99s-32-14.3-32-31.99v-144H48c-17.67 0-32-14.32-32-32.01s14.33-31.99 32-31.99h144v-144C192 62.32 206.33 48 224 48s32 14.32 32 32.01v144h144c17.7-.01 32 14.29 32 31.99z"/></svg>
									</span>
								</button>
							</div>
							<button type="submit" @click.prevent="changeUrlQuery()" class="filter-panel-search__button">Поиск</button>
						</div>
					</div>
					<div class="filter-panel__sort filter-panel-sort" :class="{ '_active': isActive }">
						<div class="filter-panel-categories__label">
							Сортировка
						</div>
						<div class="filter-panel-categories__content header-top-search-filter-menu-item__content header-top-search-filter-menu-item__sorting header-top-search-filter-menu-item-sorting">
							<div class="header-top-search-filter-menu-item-sorting__select header-top-search-filter-menu-item-sorting-select">
								<button @click="button($event)" type="button" class="header-top-search-filter-menu-item-sorting-select__button header-top-search-filter-menu-item-sorting-select-button a-hover-bgc" :class="{ '_active': isActive }">
									<span class="header-top-search-filter-menu-item-sorting-select-button__title">{{ lists[defaultList] }}</span>
									<span class="header-top-search-filter-menu-item-sorting-select-button__icon">
										<svg viewBox="0 0 384 512" xmlns="http://www.w3.org/2000/svg"><path d="M352 352c-8.188 0-16.38-3.125-22.62-9.375L192 205.3 54.6 342.7c-12.5 12.5-32.75 12.5-45.25 0s-12.5-32.75 0-45.25l160-160c12.5-12.5 32.75-12.5 45.25 0l160 160c12.5 12.5 12.5 32.75 0 45.25-6.2 6.2-14.4 9.3-22.6 9.3z"/></svg>
									</span>
								</button>
								<div class="header-top-search-filter-menu-item-sorting-select__menu header-top-search-filter-menu-item-sorting-select-menu">
									<div class="header-top-search-filter-menu-item-sorting-select-menu__lists">
										<button
											v-if="lists.length > 0"
											v-for="(list, index) in lists"
											:key="index"
											@click.prevent="sorting(index, $event)"
											type="button"
											class="header-top-search-filter-menu-item-sorting-select-menu__list a-hover-bgc"
											:class="{ '_active': (index == defaultList) }">
											{{ list }}
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="filter-panel__row flex-wrap-wrap">
					<div class="filter-panel__price">
						<div class="filter-panel-categories__label">
							Цена
						</div>
						<div class="filter-panel-categories__content header-top-search-filter-menu-item__content header-top-search-filter-menu-item__price header-top-search-filter-menu-item-price">
							<div class="header-top-search-filter-menu-item-price__input header-top-search-filter-menu-item-price-input">
								<input
									autocomplete="off"
									type="number"
									id="1"
									placeholder="Цена от"
									@input="withMaxPrice($event)"
									:value="formattedMaxPrice"
								/>
							</div>
							<div class="header-top-search-filter-menu-item-price__input header-top-search-filter-menu-item-price-input">
								<input
									autocomplete="off"
									type="number"
									id="2"
									placeholder="Цена до"
									@input="withMinPrice($event)"
									:value="formattedMinPrice"
								/>
							</div>
						</div>
					</div>
					<div class="filter-panel__save">
						<div class="header-top-search-filter-menu-item__innerbuttonsave">
							<button
								@click.prevent="changeUrlQuery()"
								type="button"
								class="header-top-search-filter-menu-item__buttonsave a-hover-bgc">
								Сохранить
							</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</section> -->
	<section class="filter-panel__filter filter-panel-filter" :class="{ '_show': isFilter }">
		<div class="filter-panel-filter__body">
			<div class="filter-panel-filter__content">
				<div class="filter-panel-filter__title">
					Фильтрация
				</div>
				<template v-if="categoryId">
					<template v-if="isSpecifications">
						<template v-if="specifications.length > 0">
							<div v-for="(specification, index) in specifications" :key="index" class="filter-panel-filter__item">
								<div class="filter-panel-filter__label">{{ specification.name }}</div>
								<ul class="filter-panel-filter__lists">
									<li v-for="(item, key) in specification.children" :key="key" class="filter-panel-filter__list">
										<div class="checkbox__1">
											<input @change="changeSelectedSpecifications(item.id)" :checked="$store.getters.selectedSpecifications.includes(item.id)" readonly :id="'checkbox-' + index + '_' + key" type="checkbox">
											<label :for="'checkbox-' + index + '_' + key">
												<span class="icon">
													<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/></svg>
												</span>
											</label>
										</div>
										<label :for="'checkbox-' + index + '_' + key" class="filter-panel-filter__name">{{ item.name }}</label>
									</li>
								</ul>
							</div>
						</template>
						<div v-else class="filter-panel-filter__item">
							<div class="filter-panel-filter__label">
								<span class="_error">
									Нету связанных характеристик
								</span>
							</div>
						</div>
					</template>
					<div v-else class="filter-panel-filter__item df jcc aic">
						<div class="filter-panel-filter__loading">
							<img src="/storage/project/loading.gif" alt="loading">
						</div>
					</div>
				</template>
				<div v-else class="filter-panel-filter__item">
					<div class="filter-panel-filter__label">
						<span class="_error">
							Выберите категорию
						</span>
					</div>
				</div>
			</div>
			<button @click.prevent="isFilter = !isFilter" type="button" class="filter-panel-filter__button filter-panel-filter-button">
				<span class="filter-panel-filter-button__icon">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M0 416c0 17.7 14.3 32 32 32l54.7 0c12.3 28.3 40.5 48 73.3 48s61-19.7 73.3-48L480 448c17.7 0 32-14.3 32-32s-14.3-32-32-32l-246.7 0c-12.3-28.3-40.5-48-73.3-48s-61 19.7-73.3 48L32 384c-17.7 0-32 14.3-32 32zm128 0a32 32 0 1 1 64 0 32 32 0 1 1 -64 0zM320 256a32 32 0 1 1 64 0 32 32 0 1 1 -64 0zm32-80c-32.8 0-61 19.7-73.3 48L32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l246.7 0c12.3 28.3 40.5 48 73.3 48s61-19.7 73.3-48l54.7 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-54.7 0c-12.3-28.3-40.5-48-73.3-48zM192 128a32 32 0 1 1 0-64 32 32 0 1 1 0 64zm73.3-64C253 35.7 224.8 16 192 16s-61 19.7-73.3 48L32 64C14.3 64 0 78.3 0 96s14.3 32 32 32l86.7 0c12.3 28.3 40.5 48 73.3 48s61-19.7 73.3-48L480 128c17.7 0 32-14.3 32-32s-14.3-32-32-32L265.3 64z"/></svg>
				</span>
			</button>
		</div>
	</section>
</template>
<script>
	import * as flsFunctions from "@/project/files/functions.js";
	import Categories from "./includes/Categories/Categories.vue";
	export default {
		name: 'FilterPanelComponent',
		data() {
			return {
				clickListenerAdded: false,

				isFilter: false,

				isSpecifications: false,
				specifications: [],

				lists: [
					"По умолчанию",
					"Показать свзязанный по коду",
					"Сначала по акции",
					"Сначала часто покупаемые",
					"Сначала новые",
					"Сначала дешевле",
					"Сначала дороже",
				],
				isActive: false
			};
		},
		mounted() {
			if (!this.clickListenerAdded) {
				this.addClickListener();
				this.clickListenerAdded = true;
			}
			if (this.$store.getters.categoryId) {
				this.getSpecifications(this.$store.getters.categoryId)
			}
		},
		watch: {
			categoryId(newCategoryId, oldCategoryId) {
				if (newCategoryId !== oldCategoryId) {
					if (oldCategoryId) {
						this.$store.commit("setSelectedSpecifications", []);
					}
					this.isSpecifications = false
					this.getSpecifications(newCategoryId);
				}
			},
			defaultList(newDefaultList, oldDefaultList) {
				if (newDefaultList !== oldDefaultList) {
					this.changeUrlQuery()
				}
			}
		},
		updated() {
		},
		beforeDestroy() {
			this.removeClickListener();
		},
		methods: {
			changeSelectedSpecifications(id) {
				let array = this.$store.getters.selectedSpecifications;

				let newArray;

				if (Array.isArray(array)) {
					const status = array.includes(id);

					if (status) {
						newArray = array.filter(item => item !== id);

					} else {
						newArray = [...array, id];
					}
				} else {
					newArray = [id];
				}

				this.$store.commit("setSelectedSpecifications", newArray);
				this.changeUrlQuery();
			},
			changeUrlQuery() {
				const specificationsParam = this.$store.getters.selectedSpecifications.length > 0
											? `[${this.$store.getters.selectedSpecifications.join(',')}]`
											: '';
				const queryParams = {
					q: this.$store.getters.searchInput,
					category_id: this.$store.getters.categoryId,
					'prices[from]': this.$store.getters.maxPrice,
					'prices[to]': this.$store.getters.minPrice,
					sort: this.$store.getters.sort,
					specifications: specificationsParam,
				};
				const filteredParams = {};
				for (const key in queryParams) {
					if (queryParams[key] !== null && queryParams[key] !== '') {
						filteredParams[key] = queryParams[key];
					}
				}
				const queryString = Object.entries(filteredParams)
											.filter(([key, value]) => key && value && key.toString().length > 0 && value.toString().length > 0 && key !== 'page')
											.map(([key, value]) => `${key}=${value}`)
											.join('&');
				const data = queryString ? `?${queryString}` : '';
				const newUrl = `${window.location.pathname}${data}`;
				this.$store.commit("setSearchHref", data);

				window.history.replaceState(null, null, newUrl);

				this.$store.dispatch('zeroingProducts');
				this.$store.commit('setMethods', 'get');
				this.$store.commit('setApiSrc', 'search'+this.$store.getters.searchHref);
				this.$store.commit('setMessage', 'Товаров пока нет!');
				this.$store.dispatch('initializeProducts');
			},
			async getSpecifications(id) {
				try {
					let response = await axios.get(`/api/category_specifications/${id}`);
					if (response && response.data) {
						let data = response.data
						this.specifications = data;
					} else {
						this.specifications = [];
					}
				} catch (error) {
					this.specifications = [];
				} finally {
					this.isSpecifications = true
				}
			},
			getReturnSpecification(data) {
				if (this.selectedSpecifications) {
					let selecteds = Object.values(this.selectedSpecifications);

					data.forEach((specification, index) => {
						if (selecteds[index] && selecteds[index]['data'] && selecteds[index]['data'][0]) {
							specification['children'].forEach((list, key) => {
								if (selecteds[index]['data'][0].id == list.id) {
									specification.specification_value = {
										id: selecteds[index]['data'][0].id,
										name: selecteds[index]['data'][0].name
									};
								}
							});
						}
					});
				}
				return data;
			},
			withSearchInput(event) {
				this.$store.commit('setSearchInput', event.target.value.trim())
			},
			sorting(index, event) {
				if (this.defaultList !== index) {
					this.$store.commit('setSort', index);
					this.isActive = !this.isActive
					this.changeUrlQuery()
				}
			},
			button(event) {
				this.isActive = !this.isActive
			},
			changeIsActiveMenuFilterPanel(event) {
				if (!event.target.closest('.filter-panel-categories-button__clear')) {
					this.$store.commit('setIsActiveMenuFilterPanel', !this.$store.getters.isActiveMenuFilterPanel)
				}
			},
			addClickListener() {
				document.documentElement.addEventListener("click", this.handleWindowClick);
			},
			removeClickListener() {
				document.documentElement.removeEventListener("click", this.handleWindowClick);
			},
			handleWindowClick(e) {
				const el = e.target;
				if (this.isSubMenuIcon(el)) {
					this.toggleSubMenu(el);
				}
				if (this.$store.getters.isActiveMenuFilterPanel && !el.closest(".filter-panel-categories__button") && !el.closest(".filter-panel-categories-menu__lists")) {
					this.$store.commit('setIsActiveMenuFilterPanel', false)
				}
				if (this.isActive && !el.closest(".header-top-search-filter-menu-item-sorting-select__button") && !el.closest(".header-top-search-filter-menu-item-sorting-select__menu")) {
					this.isActive = false
				}
				if (this.isFilter && !el.closest(".filter-panel__filter")) {
					this.isFilter = false
				}
			},
			isSubMenuIcon(target) {
				return target.classList.contains('filter-panel-categories-menu-sublist__button');
			},
			toggleSubMenu(target) {
				const submenu = target.nextElementSibling;
				const parent = target;
				if (!submenu.classList.contains("_slide")) {
					flsFunctions._slideToggle(submenu);
					parent.classList.toggle('_show');
				}
			},
			withMaxPrice(event) {
				let input = event.target.value.replace(/\D/g, '');
				let value = input.length > 0 ? input : event.target.value.length > 0 ? this.$store.getters.maxPrice : '';
				this.$store.commit('setMaxPrice', value);
			},
			withMinPrice(event) {
				let input = event.target.value.replace(/\D/g, '');
				let value = input.length > 0 ? input : event.target.value.length > 0 ? this.$store.getters.minPrice : '';
				this.$store.commit('setMinPrice', value);
			},
		},
		computed: {
			categoryId() {
				return this.$store.getters.categoryId
			},
			defaultList() {
				return this.$store.getters.sort ?? 0
			},
			formattedMaxPrice() {
				return this.$store.getters.maxPrice;
			},
			formattedMinPrice() {
				return this.$store.getters.minPrice;
			},
		},
		components: {
			'categories': Categories,
		},
	};
</script>
<script setup lang="scss">
</script>