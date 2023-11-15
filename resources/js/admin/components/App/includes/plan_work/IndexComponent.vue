<template>
	<div class="block">
		<div class="block__mincontainer">
			<button
				type="button"
				@click.prevent="$parent.spollers($event)"
				class="block-form__spollers block-form-spollers">
				<div class="block-form-spollers__title">График</div>
				<div class="block-form-spollers__button block-form-spollers-button">
					<span class="block-form-spollers-button__icon">
						<svg viewBox="0 0 384 512" xmlns="http://www.w3.org/2000/svg"><path d="M352 352c-8.188 0-16.38-3.125-22.62-9.375L192 205.3 54.6 342.7c-12.5 12.5-32.75 12.5-45.25 0s-12.5-32.75 0-45.25l160-160c12.5-12.5 32.75-12.5 45.25 0l160 160c12.5 12.5 12.5 32.75 0 45.25-6.2 6.2-14.4 9.3-22.6 9.3z"/></svg>
					</span>
				</div>
			</button>
			<div hidden class="block__body">
				<div class="block__content block__form block-form">
					<div class="block-form__item">
						<form method="post" class="mrb-admin__form mrb-admin-form">
							<div class="mrb-admin-form__item">
								<label
									for="mode"
									class="mrb-admin-form__label"
									:class="{ '_error': isMode }">
									Время работы*:
									<template v-if="isMode">
										<span v-for="message in mode_valid_message" :key="message">
											{{ message + ' ' }}
										</span>
									</template>
								</label>
								<div class="mrb-admin-form__input">
									<textarea
										v-model="mode"
										id="mode"
										name="mode"
										:readonly="isReadOnly"
										placeholder="Введите время работы..."
									></textarea>
								</div>
							</div>
							<div class="mrb-admin-form__item">
								<label
									for="hours"
									class="mrb-admin-form__label"
									:class="{ '_error': isHours }">
									График работы*:
									<template v-if="isHours">
										<span v-for="message in hours_valid_message" :key="message">
											{{ message + ' ' }}
										</span>
									</template>
								</label>
								<div class="mrb-admin-form__input">
									<textarea
										v-model="hours"
										id="hours"
										name="hours"
										:readonly="isReadOnly"
										placeholder="Введите график работы..."
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

									<span class="block-form-submit__title">Изменить</span>
									<span class="block-form-submit__result">{{ resultMessage }}</span>
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import API from '@/admin/api';
	export default {
		name: 'IndexComponent',
		data() {
			return {
				id: null,

				mode: '',
				isMode: false,
				mode_valid_message: [],

				hours: '',
				isHours: false,
				hours_valid_message: [],

				isReadOnly: false,

				loading: false,
				result: false,
				isErrorResult: false,

				resultMessage: '',
			};
		},
		watch: {
			getPlanWorks(newPlanWorks, oldPlanWorks) {
				this.id = newPlanWorks.id;
				this.mode = newPlanWorks.mode;
				this.hours = newPlanWorks.hours;
			}
		},
		mounted() {
		},
		updated() {
		},
		methods: {
			updatePlanWorks() {
				API.patch(`/api/admin/app/plan_works`, {
					id: this.id,
					mode: this.mode,
					hours: this.hours,
				})
				.then(response => {
					if (response && response.data) {
						if (response.data.message) {
							this.finishResult(response.data.message);
						} else if (response.data.error) {
							this.finishResult(response.data.error, true);
						} else {
							this.finishResult('Непредвиденная ошибка', true);
						}
					} else {
						this.finishResult('Непредвиденная ошибка', true);
					}
				})
				.catch(error => {
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

				this.isMode = false
				this.mode_valid_message = []

				this.isHours = false
				this.hours_valid_message = []

				if (this.mode.length === 0) {
					this.isMode =  true
					this.mode_valid_message.push('Заполните время работы!')
				} else if (this.mode.length > 255) {
					this.isMode = true
					this.mode_valid_message.push('Время работы должно cодержать менее 255 символов!')
				}

				if (this.hours.length === 0) {
					this.isHours =  true
					this.hours_valid_message.push('Заполните график работы!')
				} else if (this.hours.length > 255) {
					this.isHours = true
					this.hours_valid_message.push('График работы должно cодержать менее 255 символов!')
				}
				if (!this.isMode && !this.isHours) {
					this.updatePlanWorks()
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
			getPlanWorks() {
				return this.$parent.app.plan_works;
			}
		},
		components: {
		},
	}
</script>
<style scoped lang="scss">
</style>