<template>
	<div class="block">
		<div class="block__title">Связать характеристики с категорией</div>
		<form method="POST" class="block__content block__form block-form">
			<div class="block-form__items">
				<div
					class="block-form__item"
					:class="{ '_error': $store.getters.isLinkingSpecificationIds }">
					<label class="block-form__label">
						Выберите характеристику*:
						<template v-if="$store.getters.isLinkingSpecificationIds">
							<span v-for="message in $store.getters.linkingSpecificationsIdValidMessage" :key="message">
								{{ message + ' ' }}
							</span>
						</template>
					</label>
					<ul class="block-form-item__content">
						<specifications v-if="specifications.length > 0" v-for="specification in specifications" :specification="specification" :key="specification"></specifications>
					</ul>
				</div>
				<div
					class="block-form__item">
					<button
						type="submit"
						:disabled="$store.getters.isReadOnly"
						@click.prevent="$store.dispatch('sendLinking', 'sendLinkingStore')"
						class="block-form__button block-form__submit block-form-submit"
						:class="{
								'_loading': $store.getters.loading,
								'_sending': $store.getters.result,
								'_error': $store.getters.isErrorResult
							}">
						<span class="block-form-submit__title">Привизать</span>
						<span class="block-form-submit__result">{{ $store.getters.resulMassage }}</span>
					</button>
				</div>
			</div>
		</form>
	</div>
</template>

<script>
	import * as flsFunctions from "@/admin/files/functions.js";
	import Specification from "./includes/Specifications/Specifications.vue";
	import API from '@/admin/api';
	export default {
		name: 'LinkSpecification',
		data() {
			return {
				ids: [],
				array_specifications: [],
				clickListenerAdded: false,
			}
		},
		mounted() {
			this.$store.dispatch("zeroingLinking")
			this.$store.commit("setLinkingCategoryIds", this.$route.params.id)
			this.getSpecification()
			this.$store.dispatch("getCategories")
			if (!this.clickListenerAdded) {
				this.addClickListener();
				this.clickListenerAdded = true;
			}
		},
		beforeDestroy() {
			this.removeClickListener();
		},
		methods: {
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
					parent.classList.toggle('_active');
				}
			},
			getSpecification() {
				API.get('/api/admin/category_specifications/' + this.$route.params.id)
				.then( response => {
					if (response && response.data && response.data.length > 0) {
						this.arrayIds(response.data);
						this.arraySpecifications(response.data);
						this.$store.commit("setLinkingCategory", this.ids);
						this.$store.commit("setLinkingSpecificationsIds", this.array_specifications);
					}
					this.$store.dispatch("getSpecificationsChildrens")
				})
				.catch( error => {
					this.$store.dispatch("getSpecificationsChildrens")
				});
			},
			arrayIds(data) {
				data.forEach(element => {
					this.ids.push(element.id)
					if (element.children) {
						this.arrayIds(element.children)
					}
				});
			},
			arraySpecifications(data) {
				data.forEach(element => {
					if (element.children) {
						this.arraySpecifications(element.children)
					}
					if (!element.children) {
						this.array_specifications.push(element.id)
					}
				});
			}
		},
		computed: {
			specifications() {
				return this.$store.getters.specifications
			}
		},
		components: {
			'specifications': Specification
		}
	}
</script>