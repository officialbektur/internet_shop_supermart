<template>
	<div v-if="!category.children" class="bkt-catygory-menu-main__list bkt-catygory-menu-main-list">
		<button type="button" @click="addCategoriesClassActive(category.id, $event)" class="bkt-catygory-menu-main-list__button bkt-catygory-menu-main-list-button a-hover-bgc" :class="'category_id_'+category.id">
			<span class="bkt-catygory-menu-main-list-button__title">
				{{ category.name }}
			</span>
		</button>
	</div>
	<div v-else class="bkt-catygory-menu-main__sublist bkt-catygory-menu-main-sublist">
		<button type="button" class="bkt-catygory-menu-main-sublist__button bkt-catygory-menu-main-sublist-button a-hover-bgc">
			<span class="bkt-catygory-menu-main-sublist-button__title">
				{{ category.name }}
			</span>
			<span class="bkt-catygory-menu-main-sublist-button__icon">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
					<path d="M352 352c-8.188 0-16.38-3.125-22.62-9.375L192 205.3l-137.4 137.4c-12.5 12.5-32.75 12.5-45.25 0s-12.5-32.75 0-45.25l160-160c12.5-12.5 32.75-12.5 45.25 0l160 160c12.5 12.5 12.5 32.75 0 45.25C368.4 348.9 360.2 352 352 352z" />
				</svg>
			</span>
		</button>
		<div hidden class="bkt-catygory-menu-main-sublist__menulist bkt-catygory-menu-main-sublist-menulist">
			<div class="bkt-catygory-menu-main__defaultlist bkt-catygory-menu-main-defaultlist">
				<button @click="addCategoriesClassActive(category.id, $event)" type="button" class="bkt-catygory-menu-main-defaultlist__button bkt-catygory-menu-main-defaultlist-button a-hover-bgc" :class="'category_id_'+category.id">
					Всё в категории <span class="bkt-catygory-menu-main-defaultlist-button__categoryname">{{ category.name }}</span>
				</button>
			</div>
			<categories v-for="category in category.children" :category="category" :key="category"></categories>
		</div>
	</div>
</template>
<script>
	export default {
		name: 'Categories',
		props: {
			category: Object,
		},
		data() {
			return {
			};
		},
		mounted() {
			this.addCategoriesClassActiveMounted()
		},
		methods: {
			addCategoriesClassActive(id, event) {
				let element = null;
				if (event && event.target) {
					element = event.target;
				} else if (event && event.parentElement) {
					element = event;
				} else {
					return false;
				}

				let title = '';

				this.$store.dispatch("removeActiveClass");

				this.$store.commit("setCategoryId", id);

				if (element.classList.contains("bkt-catygory-menu-main-list__button")) {
					title = element.innerText.trim()
				} else if (element.parentElement.parentElement.parentElement.firstElementChild.classList.contains("bkt-catygory-menu-main-sublist__button")) {
					title = element.parentElement.parentElement.parentElement.firstElementChild.innerText.trim()
				}

				this.$store.commit("setCategoryTitle", title);
				this.$store.commit("setIsActiveMenuFillter", false);
			},
			addCategoriesClassActiveMounted() {
				if (this.$store.getters.categoryId !== '') {
					if (document.querySelector(`.category_id_${this.$store.getters.categoryId}`)) {
						let category = document.querySelector(`.category_id_${this.$store.getters.categoryId}`);
						this.addCategoriesClassActive(this.$store.getters.categoryId, category)
					}
				}
			}
		},
		updated() {
		}
	};
</script>
