<template>
	<div class="header-top-search-filter-menu__item header-top-search-filter-menu-item">
		<div class="header-top-search-filter-menu-item__title">
			Сортировка
		</div>
		<div class="header-top-search-filter-menu-item__content header-top-search-filter-menu-item__sorting header-top-search-filter-menu-item-sorting">
			<div class="header-top-search-filter-menu-item-sorting__select header-top-search-filter-menu-item-sorting-select">
				<button @click="button($event)" type="button" class="header-top-search-filter-menu-item-sorting-select__button header-top-search-filter-menu-item-sorting-select-button a-hover-bgc" :class="{ '_active': isActive }">
					<span class="header-top-search-filter-menu-item-sorting-select-button__title">{{ lists[defaultList] }}</span>
					<span class="header-top-search-filter-menu-item-sorting-select-button__icon">
						<svg viewBox="0 0 384 512" xmlns="http://www.w3.org/2000/svg"><path d="M352 352c-8.188 0-16.38-3.125-22.62-9.375L192 205.3 54.6 342.7c-12.5 12.5-32.75 12.5-45.25 0s-12.5-32.75 0-45.25l160-160c12.5-12.5 32.75-12.5 45.25 0l160 160c12.5 12.5 12.5 32.75 0 45.25-6.2 6.2-14.4 9.3-22.6 9.3z"/></svg>
					</span>
				</button>
				<div hidden class="header-top-search-filter-menu-item-sorting-select__menu header-top-search-filter-menu-item-sorting-select-menu">
					<div class="header-top-search-filter-menu-item-sorting-select-menu__lists">
						<button v-if="lists.length > 0" v-for="(list, index) in lists" :key="index" @click="sorting(index, $event)" type="button" class="header-top-search-filter-menu-item-sorting-select-menu__list a-hover-bgc" :class="{ '_active': (index == defaultList) }">
							{{ list }}
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import * as flsFunctions from "@/project/files/functions.js";
	export default {
		name: 'SortingBlock',
		data() {
			return {
				lists: [
					"По умолчанию",
					"Сначала по акции",
					"Сначала часта покупаемые",
					"Сначала новые",
					"Сначала дешевле",
					"Сначала дороже",
				],
				isActive: false
			};
		},
		mounted() {
		},
		updated() {
		},
		methods: {
			sorting(index, event) {
				this.$store.commit('setSort', index);
				flsFunctions._slideToggle(event.target.parentElement.parentElement);
				this.isActive = !this.isActive
			},
			button(event) {
				if (!event.target.nextElementSibling.classList.contains("_slide")) {
					flsFunctions._slideToggle(event.target.nextElementSibling);
					this.isActive = !this.isActive
				}
			}
		},
		computed: {
			defaultList() {
				return this.$store.getters.sort ?? 0
			}
		},
		components: {
		},
    }
</script>

<style scoped>
</style>