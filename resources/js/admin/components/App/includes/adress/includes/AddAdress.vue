<template>
	<div class="block-form__item">
		<div class="block__title">Создать новый адрес</div>
		<form method="post" class="mrb-admin__form mrb-admin-form">
			<div class="mrb-admin-form__item">
				<label
					for="map"
					class="mrb-admin-form__label"
					:class="{ '_error': isMap }">
					Ссылка на iframe*:
					<template v-if="isMap">
						<span v-for="message in map_valid_message" :key="message">
							{{ message + ' ' }}
						</span>
					</template>
				</label>
				<div class="mrb-admin-form__input">
					<textarea
						v-model="map"
						id="map"
						name="map"
						:readonly="isReadOnly"
						placeholder="Ссылка на iframe..."
					></textarea>
				</div>
			</div>
			<div class="mrb-admin-form__item">
				<label
					for="title"
					class="mrb-admin-form__label"
					:class="{ '_error': isTitle }">
					Адрес*:
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
						:readonly="isReadOnly"
						placeholder="Адрес..."
					></textarea>
				</div>
			</div>
			<div class="mrb-admin-form__item">
				<label
					for="adress_href"
					class="mrb-admin-form__label"
					:class="{ '_error': isAdressHref }">
					Ссылка на адрес*:
					<template v-if="isAdressHref">
						<span v-for="message in adress_href_valid_message" :key="message">
							{{ message + ' ' }}
						</span>
					</template>
				</label>
				<div class="mrb-admin-form__input">
					<textarea
						v-model="adress_href"
						id="adress_href"
						name="adress_href"
						:readonly="isReadOnly"
						placeholder="Ссылка на адрес..."
					></textarea>
				</div>
			</div>
			<div class="mrb-admin-form__innerbutton">
				<button
					type="submit"
					@click.prevent="sendAdress"
					:disabled="isReadOnly"
					class="block-form__button block-form__submit block-form-submit"
					:class="{
						'_loading': loading,
						'_sending': result,
						'_error':  isErrorResult
					}">

					<span class="block-form-submit__title">Добавить</span>
					<span class="block-form-submit__result">{{ resultMessage }}</span>
				</button>
			</div>
		</form>
	</div>
</template>

<script>
	import API from '@/admin/api';
	export default {
		name: 'AddAdress',
		data() {
			return {
				map: '',
				isMap: false,
				map_valid_message: [],

				title: '',
				isTitle: false,
				title_valid_message: [],

				adress_href: '',
				isAdressHref: false,
				adress_href_valid_message: [],

				isReadOnly: false,

				loading: false,
				result: false,
				isErrorResult: false,

				resultMessage: '',
			};
		},
		mounted() {
		},
		updated() {
		},
		methods: {
			storeAdress() {
				const data = {
					map: this.map,
					title: this.title,
					href: this.adress_href
				};
				API.post(`/api/admin/app/adresses`, data)
				.then( response => {
					if (response && response.data) {
						if (response.data.message && response.data.id) {
							this.finishResult(response.data.message);
							let getAdresses = this.$parent.adresses;
							getAdresses.push({
								id: response.data.id,
								map: this.map,
								title: this.title,
								href: this.adress_href
							})
							this.$parent.adresses = getAdresses;

							this.map = ''
							this.title = ''
							this.adress_href = ''

						} else if (response.data.error) {
							this.finishResult(response.data.error, true);
						} else {
							this.finishResult('Непредвиденная ошибка', true);
						}
					} else {
						this.finishResult('Непредвиденная ошибка', true);
					}
				})
				.catch( error => {
					if (error.response && error.response.data && error.response.data.error) {
						this.finishResult(error.response.data.error, true);
					} else if (error.response && error.response.data && error.response.data.message) {
						this.finishResult(error.response.data.message, true);
					} else {
						this.finishResult('Непредвиденная ошибка', true);
					}
				});
			},
			sendAdress() {
				this.isReadOnly = true
				this.loading = true

				this.isMap = false
				this.map_isTitlevalid_message = []

				this.isTitle = false
				this.title_valid_message = []

				this.isAdressHref = false
				this.adress_href_valid_message = []

				if (this.map.length === 0) {
					let message = this.map_valid_message;
					message.push('Введите iframe!')

					this.isMap =  true
					this.map_valid_message = message
				}

				if (this.title.length === 0) {
					this.isTitle =  true
					this.title_valid_message.push('Введите название вашего местоположение!')
				} else if (this.title.length > 255) {
					this.isTitle =  true
					this.title_valid_message.push('Название вашего местоположение должно cодержать менее 255 символов!')
				}

				if (this.adress_href.length === 0) {
					this.isAdressHref =  true
					this.adress_href_valid_message.push('Введите ссылку на ваше местоположение!')
				}

				if (!this.isMap && !this.isTitle && !this.isAdressHref) {
					this.storeAdress()
				} else {
					this.finishResult('Ошибка валидации', true);
				}
			},
			finishResult(message, errorStatus = false) {
				setTimeout(() => {
					this.resultMessage = message
					this.result = true
					this.loading = false


					if (errorStatus) {
						this.isErrorResult = true
					}
					setTimeout(() => {
						this.result = false
						if (errorStatus) {
							this.isErrorResult = false
						}
						setTimeout(() => {
							this.isReadOnly = false
						}, 600);
					}, 2400);
				}, 600);
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