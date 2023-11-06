<template>
	<!-----------------------------------  Popup  --Start--  ----------------------------------->
	<div id="specifications__popup" aria-hidden="true" class="popup">
		<div class="popup__wrapper">
			<div class="popup__body">
				<div class="popup__header">
					<div class="popup__title">
						Характеристики
					</div>
					<button data-close type="button" class="popup__close popup-close">
						<span class="popup-close__icon">
							<svg viewBox="0 0 320 512" xmlns="http://www.w3.org/2000/svg"><path d="M310.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 210.7 54.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L114.7 256 9.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 301.3l105.4 105.3c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L205.3 256l105.3-105.4z"/></svg>
						</span>
					</button>
				</div>
				<div class="popup__main">
					<ul ref="data-category-menu"  class="popup__menu" data-category-menu>
						<li
							data-close
							data-category-link
							@click.prevent="$store.dispatch('addClickSpecification', { id: 0, event: $event})"
							class="block-list__default block-list-default block-list">
							<div class="block-list__name block-list-default__title">
								На главную
							</div>
						</li>
						<template v-if="specifications.length > 0" v-for="specification in specifications" :key="specification">
							<li
								v-if="$store.getters.specification.length > 0 ? specification.id !== $store.getters.specification[$store.getters.specification.length - 1].id : true"
								data-close
								data-category-link
								@click.prevent="$store.dispatch('addClickSpecification',  { id: specification.id, event: $event})"
								class="block-list"
								:class="{ '_show': $store.getters.specification.some(item => item.id === specification.id) }">
								<div class="block-list__name block-list__title">
									{{ specification.name }}
								</div>
							</li>
						</template>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-----------------------------------  Popup  --End--  ----------------------------------->
</template>

<script>
	import API from '@/admin/api';
	import * as flsFunctions from "@/admin/files/functions.js";
	export default {
		name: 'SpecificationPopup',
		data() {
			return {
				specifications: [],
				clickListenerAdded: false,
			};
		},
		mounted() {
			this.getSpecifications()
			if (!this.clickListenerAdded) {
				this.addClickListener();
				this.clickListenerAdded = true;
			}
		},
		updated() {
		},
		beforeDestroy() {
			this.removeClickListener();
		},
		methods: {
			async getSpecifications() {
				try {
					let response = await API.get('/api/admin/specifications');
					if (response && response.data && response.data.length > 0) {
						this.specifications = response.data
					}
				} catch (error) {
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
			},
			isSubMenuIcon(target) {
				return target.classList.contains('block-sublist__button');
			},
			toggleSubMenu(target) {
				const submenu = target.nextElementSibling;
				const parent = target;
				if (!submenu.classList.contains("_slide")) {
					flsFunctions._slideToggle(submenu);
					parent.classList.toggle('_show');
				}
			},
		},
		computed: {
		},
		components: {
		},
	}
</script>
<style scoped lang="scss">
</style>