<template>
	<div class="block">
		<div class="block__averagecontainer">
			<h2 class="block__title">Создать товар</h2>

			<div class="page__content">
				<form method="post" class="mrb-admin__form mrb-admin-form" enctype="multipart/form-data">
					<div class="mrb-admin-form__item">
						<div class="mrb-admin-form__labelinner">
							<label class="mrb-admin-form__label">
								Выберите изображение:
							</label>
							<button
								:disabled="$store.getters.isReadOnly"
								@click.prevent="resetImageInputs"
								type="button"
								data-admin-image-button-reset
								class="mrb-admin-form__label mrb-admin-form__label_resetimages">
								Очистить все медиа.
							</button>
						</div>
						<div
							ref="draganandgrop"
							data-draganandgrop-style="1"
							class="mrb-admin-form__media mrb-admin-form-media">
							<div
								v-for="(image, index) in imagesCount"
								:key="index"
								data-draganandgrop-cell
								class="mrb-admin-form-media__block mrb-admin-form-media-block">
								<div
									data-draganandgrop-card
									draggable="true"
									class="mrb-admin-form-media__content">
									<input
										@change="handleFileChange($event)"
										:ref="`inputImages_${index}`"
										:readonly="$store.getters.isReadOnly"
										:disabled="$store.getters.isReadOnly"
										accept=".jpg, .png, .jpeg, .webp"
										type="file"
										name="images[]"
										multiple
										class="mrb-admin-form-media-block__input">
									<div class="mrb-admin-form-media-block__preview"></div>
									<button
										:disabled="$store.getters.isReadOnly"
										@click.prevent="resetImageInput(index)"
										type="button"
										class="mrb-admin-form-media-block__close">
										<svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg"><path d="M432 256c0 17.69-14.33 32.01-32 32.01H256v144c0 17.69-14.33 31.99-32 31.99s-32-14.3-32-31.99v-144H48c-17.67 0-32-14.32-32-32.01s14.33-31.99 32-31.99h144v-144C192 62.32 206.33 48 224 48s32 14.32 32 32.01v144h144c17.7-.01 32 14.29 32 31.99z"/></svg>
									</button>
									<div class="mrb-admin-form-media-block__hello mrb-admin-form-media-block-hello">
										<div class="mrb-admin-form-media-block-hello__icon">
											<svg viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M30 6l3.66 4H40c2.2 0 4 1.8 4 4v24c0 2.2-1.8 4-4 4H8c-2.2 0-4-1.8-4-4V14c0-2.2 1.8-4 4-4h6.34L18 6h12zm-6 13.6a6.4 6.4 0 100 12.8 6.4 6.4 0 000-12.8zM24 36c-5.52 0-10-4.48-10-10s4.48-10 10-10 10 4.48 10 10-4.48 10-10 10z"/></svg>
										</div>
										<div class="mrb-admin-form-media-block-hello__title">
											Добавьте фото
										</div>
									</div>
									<button
										:disabled="$store.getters.isReadOnly"
										@click.prevent="addBossBlock(index)"
										type="button"
										class="mrb-admin-form-media-block__buttonlvl">
										Сделать Главным
									</button>
								</div>
								<div v-if="index == 0" class="mrb-admin-form-media-block__bosstitle">Главная</div>
							</div>
						</div>
					</div>
					<div class="mrb-admin-form__item">
						<label
							for="title"
							class="mrb-admin-form__label"
							:class="{ '_error': isTitle }">
							Название*:
							<template v-if="isTitle">
								<span v-for="message in title_valid_message" :key="message">
									{{ message + ' ' }}
								</span>
							</template>
						</label>
						<div class="mrb-admin-form__input">
							<textarea
								v-model="title"
								id="title"
								name="title"
								:readonly="$store.getters.isReadOnly"
								:disabled="$store.getters.isReadOnly"
								placeholder="Название..."
							></textarea>
						</div>
					</div>
					<div class="mrb-admin-form__item">
						<div class="mrb-admin-form__labelinner">
							<label
								class="mrb-admin-form__label"
								:class="{ '_error': isCategory }">
								Категория*:
								<template
									v-if="isCategory">
									<span
										v-for="message in category_valid_message"
										:key="message">
										{{ message + ' ' }}
									</span>
								</template>
							</label>
						</div>
						<a
							href
							:data-popup="$store.getters.isReadOnly ? $store.getters.isReadOnly : '#categories_tovar__popup'"
							class="block-form-item__select block-form-item-select"
							:class="{ '_show': $store.getters.categoryTitle.toString().length > 0 }"
							>
							<div class="block-form-item-select__title">{{ $store.getters.categoryTitle.toString().length > 0 ? $store.getters.categoryTitle : 'Выберите категорию' }}</div>
							<div class="block-form-item-select__button block-form-item-select-button">
								<div class="block-form-item-select-button__icon">
									<svg viewBox="0 0 384 512" xmlns="http://www.w3.org/2000/svg"><path d="M352 352c-8.188 0-16.38-3.125-22.62-9.375L192 205.3 54.6 342.7c-12.5 12.5-32.75 12.5-45.25 0s-12.5-32.75 0-45.25l160-160c12.5-12.5 32.75-12.5 45.25 0l160 160c12.5 12.5 12.5 32.75 0 45.25-6.2 6.2-14.4 9.3-22.6 9.3z"/></svg>
								</div>
								<button
									:disabled="$store.getters.isReadOnly"
									@click.prevent="$store.dispatch('clearCategory')"
									type="button"
									class="block-form-item-select-button__clear a-hover-bgc">
									<svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg"><path d="M432 256c0 17.69-14.33 32.01-32 32.01H256v144c0 17.69-14.33 31.99-32 31.99s-32-14.3-32-31.99v-144H48c-17.67 0-32-14.32-32-32.01s14.33-31.99 32-31.99h144v-144C192 62.32 206.33 48 224 48s32 14.32 32 32.01v144h144c17.7-.01 32 14.29 32 31.99z"/></svg>
								</button>
							</div>
						</a>
						<categories-popup></categories-popup>
					</div>
					<div class="mrb-admin-form__item">
						<label
							for="title"
							class="mrb-admin-form__label"
							:class="{ '_error': isSpecification }">
							Дополнительные данные*:
							<template v-if="isSpecification">
								<span v-for="message in specification_valid_message" :key="message">
									{{ message + ' ' }}
								</span>
							</template>
						</label>
						<div class="mrb-admin-form__specification mrb-admin-form-specification">
							<template v-if="parent_id !== null">
								<template v-if="!isSpecifications">
									<div v-if="specifications.length > 0" v-for="(specification, index) in specifications" :key="index" class="mrb-admin-form-specification__item">
										<label
											:for="'specification_' + index"
											class="mrb-admin-form-specification__name mrb-admin-form__label">
											> {{ specification.name }}:
										</label>
										<div class="mrb-admin-form-specification__select">
											<multiselect
												v-model="specification.specification_value"
												:readonly="$store.getters.isReadOnly"
												:disabled="$store.getters.isReadOnly"
												placeholder="Выберите данные..."
												label="name"
												track-by="id"
												:id="'specification_' + index"
												:options="specification.children"
												:multiple="false"
												:taggable="false"
												selectLabel="Выбрать данные"
												selectedLabel="Выбрано"
												deselectLabel="Убрать данные"
											></multiselect>
										</div>
									</div>
									<div v-else class="mrb-admin-form-specification__item _error">
										Нету свзязанных характеристик
									</div>
								</template>
								<div v-else class="mrb-admin-form-specification__item _loading"></div>
							</template>
							<div v-else class="mrb-admin-form-specification__item _error">
								Выберите категорию
							</div>
						</div>
					</div>
					<div class="mrb-admin-form__item">
						<div class="mrb-admin-form__labelinner">
							<label for="price"
								class="mrb-admin-form__label"
								:class="{ '_error': isPrice }">
								Цена*:
								<template v-if="isPrice">
									<span v-for="message in price_valid_message" :key="message">
										{{ message + ' ' }}
									</span>
								</template>
							</label>
							<label
								:disabled="$store.getters.isReadOnly"
								@click.prevent="priceChange"
								for="pricedp"
								class="mrb-admin-form__label mrb-admin-form__label_dp">
								(+) Добавить прежнюю цену
							</label>
						</div>
						<div v-if="!isPriceOld" class="mrb-admin-form__input">
							<input
								v-model="price_now"
								:readonly="$store.getters.isReadOnly"
								:disabled="$store.getters.isReadOnly"
								autocomplete="off"
								type="text"
								name="price"
								id="price"
								placeholder="Цена...">
						</div>
						<div v-else class="mrb-admin-form__price mrb-admin-form-price">
							<div class="mrb-admin-form-price__warning">
								«<span>Внимание!</span> Если вы закроете данную вкладку, то введеные вами данные не будут добавлены в базу данных!»
							</div>
							<div class="mrb-admin-form-price__old mrb-admin-form-price-old">
								<label for="priceold" class="mrb-admin-form-price-old__label">Прощлая цена:</label>
								<div class="mrb-admin-form-price-old__input">
									<input
										v-model="price_old"
										:readonly="$store.getters.isReadOnly"
										:disabled="$store.getters.isReadOnly"
										autocomplete="off"
										type="text"
										name="price"
										id="priceold"
										placeholder="Прощлая цена...">
								</div>
							</div>
							<div class="mrb-admin-form-price__now mrb-admin-form-price-now">
								<label for="pricenow" class="mrb-admin-form-price-now__label">Новая цена:</label>
								<div class="mrb-admin-form-price-now__input">
									<input
										v-model="price_now"
										:readonly="$store.getters.isReadOnly"
										:disabled="$store.getters.isReadOnly"
										autocomplete="off"
										type="text"
										name="price"
										id="pricenow"
										placeholder="Новая цена...">
								</div>
							</div>
						</div>
					</div>
					<div class="mrb-admin-form__item">
						<div class="mrb-admin-form__labelinner">
							<label
								:for="'tags'"
								class="mrb-admin-form__label"
								:class="{ '_error': isTag }">
								Теги*:
								<template v-if="isTag">
									<span v-for="message in tag_valid_message" :key="message">
										{{ message + ' ' }}
									</span>
								</template>
							</label>
						</div>
						<multiselect
							v-model="tags_values"
							:readonly="$store.getters.isReadOnly"
							:disabled="$store.getters.isReadOnly"
							tag-placeholder="Создать новый тег"
							placeholder="Найти или создать тег..."
							label="name"
							track-by="id"
							:id="'tags'"
							:options="tags"
							:multiple="true"
							:taggable="true"
							selectLabel="Выбрать тег"
							selectedLabel="Выбрано"
							deselectLabel="Убрать тег"
							@tag="addTag"
						></multiselect>
					</div>
					<div class="mrb-admin-form__item">
						<div class="mrb-admin-form__chekbox mrb-admin-form-chekbox">
							<div class="mrb-admin-form-chekbox__title">Оно хит продажи ?</div>
							<div class="mrb-admin-form-chekbox__input">
								<input
									v-model="hit"
									:readonly="$store.getters.isReadOnly"
									:disabled="$store.getters.isReadOnly"
									id="hit"
									type="checkbox"
									name="hit">
								<label for="hit"></label>
								<div class="mrb-admin-form-chekbox__status mrb-admin-form-chekbox-status">
									<div class="mrb-admin-form-chekbox-status__not">Нет</div>
									<div class="mrb-admin-form-chekbox-status__yes">Да</div>
								</div>
							</div>
						</div>
					</div>
					<div class="mrb-admin-form__item">
						<div class="mrb-admin-form__radio mrb-admin-form-radio">
							<div class="mrb-admin-form-radio__title">Статус товара:</div>
							<div class="mrb-admin-form-radio__items">
								<div class="mrb-admin-form-radio__item mrb-admin-form-radio-item">
									<div class="mrb-admin-form-radio-item__innerinput">
										<input
											v-model="status"
											:readonly="$store.getters.isReadOnly"
											:disabled="$store.getters.isReadOnly"
											type="radio"
											value="1"
											id="status1"
											checked
											name="status"
											class="mrb-admin-form-radio-item__input">
										<div class="mrb-admin-form-radio-item__button"></div>
										<label class="mrb-admin-form-radio-item__label" for="status1">Активный</label>
									</div>
								</div>
								<div class="mrb-admin-form-radio__item mrb-admin-form-radio-item">
									<div class="mrb-admin-form-radio-item__innerinput">
										<input
											v-model="status"
											:readonly="$store.getters.isReadOnly"
											:disabled="$store.getters.isReadOnly"
											type="radio"
											value="0"
											id="status_2"
											name="status"
											class="mrb-admin-form-radio-item__input">
										<div class="mrb-admin-form-radio-item__button"></div>
										<label class="mrb-admin-form-radio-item__label" for="status_2">Ожидание</label>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="mrb-admin-form__item">
						<div class="mrb-admin-form__labelinner">
							<label
								:for="'editorContent'"
								class="mrb-admin-form__label">
								Дополнительные данные:
							</label>
							<button
								:disabled="$store.getters.isReadOnly"
								@click.prevent="addDescription"
								type="button"
								data-admin-image-button-reset
								class="mrb-admin-form__label mrb-admin-form__label_resetimages">
								Добавить описание
							</button>
						</div>
						<div v-show="isDescription" class="mrb-admin-form__description mrb-admin-form-description">
							<quill-editor
								ref="myQuillEditor"
								v-model:content="editorContent"
								:readOnly="$store.getters.isReadOnly"
								:content="'String'"
								:contentType="'html'"
								:options="editorOptions"
								:id="'editorContent'"
							></quill-editor>
						</div>
					</div>
					<div class="mrb-admin-form__item mrb-admin-form__innerbutton">
						<button
							type="submit"
							@click.prevent="sendTovar"
							:disabled="$store.getters.isReadOnly"
							class="block-form__button block-form__submit block-form-submit"
							:class="{
								'_loading': $store.getters.loading,
								'_sending': $store.getters.result,
								'_error':  $store.getters.isErrorResult
							}">
							<span class="block-form-submit__title">Изменить</span>
							<span class="block-form-submit__result">{{ $store.getters.resultMessage }}</span>
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</template>
<script>
	import { QuillEditor } from '@vueup/vue-quill'


	import Multiselect from 'vue-multiselect'

	import CategoriesPopup from './../Popup/CategoryTovarPopup.vue';

	import API from '@/admin/api';

	export default {
		name: 'Create',
		data() {
			return {
				imagesCount: 12,
				isImages: false,

				title: '',
				isTitle: false,
				title_valid_message: [],

				isCategory: false,
				category_valid_message: [],

				specifications: [],
				isSpecifications: false,
				isSpecification: false,
				specification_valid_message: [],

				isPriceOld: false,
				price_old: null,
				price_now: null,

				isPrice: false,
				price_valid_message: [],

				tags_values: [],
				isTag: false,
				tag_valid_message: [],

				hit: false,
				status: 1,

				isDescription: false,

				editorContent: '',
				editorOptions: {
					modules: {
						toolbar: [
							{ header: [1, 2, 3, 4, 5, 6, false] }, { 'font': [] },
							'bold', 'italic', 'underline', 'strike',
							{ 'list': 'ordered' }, { 'list': 'bullet' },
							{ 'color': [] }, { 'background': [] },
							'blockquote',
							{ 'script': 'sub'}, { 'script': 'super' },
							{ 'direction': 'rtl' },
							{ 'align': [] },
							'link',
							'clean',
						],
					},
					placeholder: 'Дополнительные данные...',
				},
			}
		},
		watch: {
			parent_id(newParentId, oldParentId) {
				this.isSpecifications = true;
				this.getSpecifications(newParentId);
			}
		},
		mounted() {
			this.$store.dispatch("zeroingCategory")
			this.$store.dispatch("zeroingTag")
			this.$store.dispatch("getTags")
			this.dragAndDrop();
			this.dragAndImage();
		},
		updated() {
		},
		methods: {
			resetQuillContent() {
				const quillEditor = this.$refs.myQuillEditor;
				if (quillEditor && quillEditor.setText) {
					quillEditor.setText('');
				}
			},
			storeTovar() {
				const data = {
					images: this.getImages(),
					title: this.title.trim(),
					category_id: this.$store.getters.parent_id,
					specification_ids: this.specifications.map(specification => specification.specification_value.id),
					price_old: this.isPriceOld ? this.price_old : 0,
					price_now: this.price_now,
					tags: this.tags_values,
					hit: this.hit ? 1 : 0,
					content: this.isDescription ? this.editorContent : '',
					status: this.status
				}
				API.post('/api/admin/products', data, {
					headers: {
						"Content-Type": "multipart/form-data",
					}
				})
				.then( response => {
					if (response && response.data) {
						if (response.data.message) {
							setTimeout(() => {
								this.$store.dispatch("zeroingCategory")
								this.$store.dispatch("zeroingTag")
								this.$store.dispatch("getTags")
								this.$store.dispatch("removeHiddenCategories");
								this.resetImageInputs();
								this.isImages = false;

								this.title = '';
								this.isTitle = false;
								this.title_valid_message = [];

								this.isCategory = false;
								this.category_valid_message = [];

								this.specifications = [];
								this.isSpecifications = false;
								this.isSpecification = false;
								this.specification_valid_message = [];

								this.isPriceOld = false;
								this.price_old = null;
								this.price_now = null;

								this.isPrice = false;
								this.price_valid_message = [];

								this.tags_values = [];
								this.isTag = false;
								this.tag_valid_message = [];

								this.hit = false;
								this.status = 1;

								this.isDescription = false;

								this.resetQuillContent();
							}, 1400);
							this.$store.dispatch("finishResult", { message: response.data.message });
						} else if (response.data.error) {
							this.$store.dispatch("finishResult", {
								message: response.data.error,
								errorStatus: true,
							});
						} else {
							dispatch("finishResult", {
								message: 'Непредвиденная ошибка',
								errorStatus: true,
							});
						}
					} else {
						this.$store.dispatch("finishResult", {
							message: 'Непредвиденная ошибка',
							errorStatus: true,
						});
					}
				})
				.catch( error => {
					if (error.response && error.response.data && error.response.data.error) {
						this.$store.dispatch("finishResult", {
							message: error.response.data.error,
							errorStatus: true,
						});
					} else if (error.response && error.response.data && error.response.data.message) {
						this.$store.dispatch("finishResult", {
							message: error.response.data.message,
							errorStatus: true,
						});
					} else {
						this.$store.dispatch("finishResult", {
							message: 'Непредвиденная ошибка',
							errorStatus: true,
						});
					}
				});
			},
			sendTovar() {
				this.$store.commit("setIsReadOnly", true)
				this.$store.commit("setLoading", true)

				this.isTitle =  false
				this.title_valid_message = []

				this.isCategory =  false
				this.category_valid_message = []

				this.isSpecification =  false
				this.specification_valid_message = []

				this.isPrice =  false
				this.price_valid_message = []

				this.isTag =  false
				this.tag_valid_message = []

				if (this.title.toString().length < 3) {
					this.isTitle =  true
					this.title_valid_message.push('Не менее 3 символов!')
				} else if (this.title.toString().length > 250) {
					this.isTitle =  true
					this.title_valid_message.push('Не более 250 символов!')
				}
				if (!this.$store.getters.parent_id) {
					this.isCategory =  true
					this.category_valid_message.push('Выберите категорию!')
				}
				if (this.validSpecificationsValues()) {
					this.isSpecification =  true
					this.specification_valid_message.push('Выберите дополнительные данные!')
				}
				if (!this.isPriceOld) {
					if (!this.price_now) {
						this.isPrice = true
						this.price_valid_message.push('Заполните обезательное поле!')
					} else if (this.price_now.toString().length > 11) {
						this.isTitle =  true
						this.title_valid_message.push('Не более 11 символов!')
					}
				} else {
					if (!this.price_old) {
						this.isPrice = true
						this.price_valid_message.push('Заполните обезательное поле!')
					} else if (this.price_old.toString().length > 11) {
						this.isTitle =  true
						this.title_valid_message.push('Не более 11 символов!')
					}
				}
				if (this.tags_values.length === 0) {
					this.isTag =  true
					this.tag_valid_message.push('Выберите тег!')
				}

				if (!this.isTitle && !this.isCategory && !this.isSpecification && !this.isPrice && !this.isTag) {
					this.storeTovar()
				} else {
					this.$store.dispatch("finishResult", {
						message: 'Ошибка валидации',
						errorStatus: true,
					});
				}
			},
			async getSpecifications(id) {
				try {
					let response = await axios.get('/api/category_specifications/' + id);
					if (response && response.data && response.data.length > 0) {
						let data = response.data;

						this.specifications = data;
					} else {
						this.specifications = [];
					}
				} catch (error) {
					this.specifications = [];
				} finally {
					this.isSpecifications = false;
				}
			},
			getImages() {
				const inputsImages = this.$refs[`draganandgrop`].querySelectorAll(".mrb-admin-form-media-block__input");
				const images = [];
				for (let index = 0; index < inputsImages.length; index++) {
					const inputImage = inputsImages[index];
					if (inputImage.files.length > 0) {
						images.push(inputImage.files[0]);
					}
				}
				return images;
			},
			validSpecificationsValues() {
				if (this.specifications.length === 0) {
					return true;
				}
				return !this.specifications.every(specification => specification.specification_value !== undefined);
			},
			addTag(newTag) {
				const tag = {
					name: newTag,
					code: newTag.substring(0, 2) + Math.floor((Math.random() * 10000000))
				}
				let tags = this.tags;
				tags.push(tag)
				this.$store.commit('setTags', tags)
				this.tags_values.push(tag)
			},
			dragAndDrop() {
				if (!this.$refs['draganandgrop']) {
					return false;
				}
				const draganandgrop = this.$refs['draganandgrop'];
				const cards = draganandgrop.querySelectorAll("[data-draganandgrop-card]");
				const cells = draganandgrop.querySelectorAll("[data-draganandgrop-cell]");

				let lockdragStart = false;



				if (draganandgrop.hasAttribute("data-draganandgrop-idnodrop")) {
					let idNodrop = draganandgrop.getAttribute("data-draganandgrop-idnodrop");
					for (let index = 0; index < cards.length; index++) {
						const element = cards[index];
						if (index == Number(idNodrop)) {
							element.setAttribute("data-draganandgrop-nodrop", "");
						}
					}
				}


				let card = [];
				function dragStart() {
					if (document.documentElement.classList.contains("_pc")) {
						lockdragStart = true;
						card = this;
						this.parentElement.classList.add("_show");
						setTimeout(function () {
							card.classList.add("_hidden");
						}, 0);
					}
				}

				function dragEnd() {
					if (document.documentElement.classList.contains("_pc")) {
						if (card.parentElement.classList.contains("_show")) {
							card.parentElement.classList.remove("_show");
						}
						this.classList.remove("_hidden");
						lockdragStart = false;
					}
				}

				function dragOver(event) {
					event.preventDefault();
				}

				function dragEnter(event) {
					event.preventDefault();
					if (document.documentElement.classList.contains("_pc") && lockdragStart) {
						if (!this.querySelector("[data-draganandgrop-nodrop]")) {
							this.classList.add("_hovered");
						}
					}
				}

				function dragLeave(event) {
					event.preventDefault();
					if (document.documentElement.classList.contains("_pc") && lockdragStart) {
						this.classList.remove("_hovered");
					}
				}

				function dragDrop(event) {
					event.preventDefault();
					if (document.documentElement.classList.contains("_pc") && lockdragStart) {
						if (!this.querySelector("[data-draganandgrop-nodrop]")) {
							if (draganandgrop.getAttribute("data-draganandgrop-style") == "0") {
								if (!this.querySelector("[data-draganandgrop-card]")) {
									this.append(card);
								} else {
									lockdragStart = false;
									let cell = this;

									cell.classList.add("_errornull");
									for (let index = 0; index < cards.length; index++) {
										const element = cards[index];
										element.removeAttribute("draggable");
									}
									setTimeout(function () {
										cell.classList.remove("_errornull");

										lockdragStart = true;
										for (let index = 0; index < cards.length; index++) {
											const element = cards[index];
											element.setAttribute("draggable", "true");
										}
									}, 920);
								}
							} else {
								if (!this.querySelector("[data-draganandgrop-card]")) {
									if (card.parentElement) {
										this.append(card);
										if (card.parentElement.classList.contains("_show")) {
											card.parentElement.classList.remove("_show");
										}
									}
								} else {
									if (card.parentElement) {
										if (card.parentElement.classList.contains("_show")) {
											card.parentElement.classList.remove("_show");
										}
										card.parentElement.append(this.querySelector("[data-draganandgrop-card]"));
										this.append(card.parentElement.querySelector("[data-draganandgrop-card]"));
									}
								}
							}
						}
						this.classList.remove("_hovered");
					}
				}
				for (let index = 0; index < cells.length; index++) {
					const element = cells[index];

					element.addEventListener("dragover", dragOver);
					element.addEventListener("dragenter", dragEnter);
					element.addEventListener("dragleave", dragLeave);
					element.addEventListener("drop", dragDrop);
				}

				for (let index = 0; index < cards.length; index++) {
					const element = cards[index];

					if (element.hasAttribute("data-draganandgrop-nodrop")) {
						element.removeAttribute("data-draganandgrop-card");
						element.parentElement.removeAttribute("data-draganandgrop-cell");

						element.removeAttribute("draggable");
					}

					element.addEventListener("dragstart", dragStart);
					element.addEventListener("dragend", dragEnd);
				}
			},
			dragAndImage() {
				let body = document.querySelector('body');

				body.addEventListener('dragenter', (e) => {
					e.preventDefault();
				})
				body.addEventListener('dragleave', (e) => {
					e.preventDefault();
				})
				body.addEventListener('dragover', (e) => {
					e.preventDefault();
				})

				body.addEventListener('drop', (e) => {
					e.preventDefault();
					if (e.dataTransfer.files.length > 0) {
						const inputImages = [];
						for (let index = 0; index < this.imagesCount; index++) {
							const inputImage = this.$refs[`inputImages_${index}`][0];
							const inputValue = inputImage.value;
							const imageDataValue = inputImage.getAttribute('data-image-value');

							if (inputValue === '' && !imageDataValue) {
								inputImages.push(inputImage);
							}
						}
						if (inputImages.length > 0) {
							this.addImageInput(e.dataTransfer);
						}
					}
				})
			},
			handleFileChange(event) {
				const selectedFiles = event.target.files;
				if (selectedFiles.length > 0) {
					if (selectedFiles.length > 1) {
						this.addImageInput(event.target);
					} else {
						this.uploadFile(event.target);
					}
				}
			},
			addImageInput(valueInput) {
				const files = valueInput.files;
				const newFiles = [];
				for (let i = 0; i < files.length; i++) {
					newFiles.push(files[i]);
				}
				if (newFiles.length > 0) {
					valueInput.value = "";
					let inputImages = [];
					for (let index = 0; index < this.imagesCount; index++) {
						if (this.$refs[`inputImages_${index}`][0].value == '') {
							inputImages.push(this.$refs[`inputImages_${index}`][0])
						}
					}
					let newFilesLength = newFiles.length;
					if (newFiles.length >= inputImages.length) {
						newFilesLength = inputImages.length;
					}
					for (let i = 0; i < newFilesLength; i++) {
						const newFileList = new ClipboardEvent("").clipboardData || new DataTransfer();
						if (newFiles[i]) {
							newFileList.items.add(newFiles[i]);
							inputImages[i].files = newFileList.files;
							this.uploadFile(inputImages[i]);
						}
					}
				} else {
					valueInput.value = null;
				}
			},
			uploadFile(file) {
				if (!file) {
					return false;
				}
				if (!["image/jpeg", "image/png", "image/webp"].includes(file.files[0].type)) {
					alert("Разрешены толко изображения.");
					file.value = "";
					return false;
				}
				// Проверим размер файла (< 2 mb)
				if (file.files[0].size > 2 * 1024 * 1024) {
					alert("Файл должен быть менее 2 mb, а ваш файл состовляет: " + Math.ceil(file.files[0].size / 1024 / 1024) + "mb");
					file.value = "";
					return false;
				}
				let reader = new FileReader();
				reader.onload = function (e) {
					file.parentElement.querySelector(".mrb-admin-form-media-block__preview").innerHTML = "";

					file.parentElement.querySelector(".mrb-admin-form-media-block__preview").innerHTML += `<img src="${e.target.result}" alt="img">`;

					file.parentElement.classList.add("_active");
				};
				reader.readAsDataURL(file.files[0]);
			},
			addBossBlock(index) {
				let clickBlock = this.$refs[`inputImages_${index}`][0];
				clickBlock.parentElement.parentElement.append(this.$refs['draganandgrop'].querySelector("[data-draganandgrop-cell] [data-draganandgrop-card]"));
				this.$refs['draganandgrop'].querySelector("[data-draganandgrop-cell]").append(clickBlock.parentElement);
			},
			resetImageInputs() {
				for (let index = 0; index < this.imagesCount; index++) {
					let input = this.$refs[`inputImages_${index}`][0];
					input.value = null
					input.parentElement.classList.remove("_active");
					input.parentElement.querySelector('.mrb-admin-form-media-block__preview').innerHTML = '';
				}
			},
			resetImageInput(index) {
				let input = this.$refs[`inputImages_${index}`][0];
				input.value = null
				input.parentElement.classList.remove("_active");
				input.parentElement.querySelector('.mrb-admin-form-media-block__preview').innerHTML = '';
			},
			priceChange() {
				this.isPriceOld = !this.isPriceOld;
			},
			addDescription() {
				this.isDescription = !this.isDescription;
			}
		},
		computed: {
			parent_id() {
				return this.$store.getters.parent_id;
			},
			tags() {
				return this.$store.getters.tags
			}
		},
		components: {
			'quill-editor': QuillEditor,
			'multiselect': Multiselect,
			'categories-popup': CategoriesPopup
		},
	}
</script>

<style>
</style>