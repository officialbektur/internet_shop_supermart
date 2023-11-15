<template>
	<div class="block-form__item">
		<div class="block__title">Создать новый сеть</div>
		<form method="post" class="mrb-admin__form mrb-admin-form">
			<div class="mrb-admin-form__item">
				<label
					for="name"
					class="mrb-admin-form__label"
					:class="{ '_error': isName }">
					Название*:
					<template v-if="isName">
						<span v-for="message in name_valid_message" :key="message">
							{{ message + ' ' }}
						</span>
					</template>
				</label>
				<div class="mrb-admin-form__input">
					<textarea
						v-model="name"
						id="name"
						name="name"
						:readonly="isReadOnly"
						placeholder="Введите название..."
					></textarea>
				</div>
			</div>
			<div class="mrb-admin-form__item">
				<label
					for="icon"
					class="mrb-admin-form__label"
					:class="{ '_error': isIcon }">
					Иконка*:
					<template v-if="isIcon">
						<span v-for="message in icon_valid_message" :key="message">
							{{ message + ' ' }}
						</span>
					</template>
				</label>
				<div class="mrb-admin-form__input">
					<textarea
						v-model="icon"
						id="icon"
						name="icon"
						:readonly="isReadOnly"
						placeholder="Введите иконку..."
					></textarea>
				</div>
			</div>
			<div class="mrb-admin-form__item">
				<label
					for="soc_href"
					class="mrb-admin-form__label"
					:class="{ '_error': isSocHref }">
					Ссылку на соц. сеть*:
					<template v-if="isSocHref">
						<span v-for="message in soc_href_valid_message" :key="message">
							{{ message + ' ' }}
						</span>
					</template>
				</label>
				<div class="mrb-admin-form__input">
					<textarea
						v-model="soc_href"
						id="soc_href"
						name="soc_href"
						:readonly="isReadOnly"
						placeholder="Введите ссылку..."
					></textarea>
				</div>
			</div>
			<div class="mrb-admin-form__innerbutton">
				<button
					type="submit"
					@click.prevent="sendSoc"
					:disabled="isReadOnly"
					class="block-form__button block-form__submit block-form-submit"
					:class="{
						'_loading': loading,
						'_sending': result,
						'_error': isErrorResult
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
		name: 'AddSoc',
		data() {
			return {
				name: '',
				isName: false,
				name_valid_message: [],

				icon: '',
				isIcon: false,
				icon_valid_message: [],

				soc_href: '',
				isSocHref: false,
				soc_href_valid_message: [],

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
			storeSoc() {
				const data = {
					name: this.name,
					icon: this.icon,
					href: this.soc_href
				};
				API.post(`/api/admin/app/socs`, data)
				.then( response => {
					if (response && response.data) {
						if (response.data.message && response.data.id) {
							this.finishResult(response.data.message);
							let getSocs = this.$parent.socs;
							getSocs.push({
								id: response.data.id,
								name: this.name,
								icon: this.icon,
								href: this.soc_href
							})
							this.$parent.socs = getSocs;

							this.name = ''
							this.icon = ''
							this.soc_href = ''

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
			sendSoc() {
				this.isReadOnly = true
				this.loading = true

				this.isName = false
				this.name_valid_message = []

				this.isIcon = false
				this.icon_valid_message = []

				this.isSocHref = false
				this.soc_href_valid_message = []

				if (this.name.length === 0) {
					this.isName =  true
					this.name_valid_message.push('Заполните название!')
				} else if (this.name.length > 255) {
					this.isName = true
					this.name_valid_message.push('Название вашего соц. сети должно cодержать менее 255 символов!')
				}

				if (this.icon.length === 0) {
					this.isIcon =  true
					this.icon_valid_message.push('Вставьте иконку!')
				}

				if (this.soc_href.length === 0) {
					this.isSocHref =  true
					this.soc_href_valid_message.push('Заполните ссылку!')
				}

				if (!this.isName && !this.isIcon && !this.isSocHref) {
					this.storeSoc()
				} else {
					this.finishResult('Ошибка валидации', true);
				}
			},
			finishResult(message, errorStatus = false) {
				setTimeout(() => {
					this.resultMessage = message;
					this.result = true;
					this.loading = false;
					if (errorStatus) {
						this.isErrorResult = true;
					}
					setTimeout(() => {
						this.result = false;
						if (errorStatus) {
						this.isErrorResult = false;
						}
						setTimeout(() => {
						this.isReadOnly = false;
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