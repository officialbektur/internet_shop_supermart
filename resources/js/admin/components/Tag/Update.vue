<template>
	<preloader :class="{ '_hidde': isPreloader }"></preloader>
	<div class="block">
		<div class="block__header df">
			<div class="block__title">
				Редактирование тега:
			</div>
			<button
				v-if="isTag"
				:disabled="$store.getters.isReadOnly"
				@click.prevent="$store.dispatch('deleteTag', $route.params.id)"
				type="button"
				class="mrb-button-delete"
				:class="{ '_active': $store.getters.isDeleteTag }">
				<span class="mrb-button-delete__icon">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M135.2 17.69C140.6 6.848 151.7 0 163.8 0H284.2C296.3 0 307.4 6.848 312.8 17.69L320 32H416C433.7 32 448 46.33 448 64C448 81.67 433.7 96 416 96H32C14.33 96 0 81.67 0 64C0 46.33 14.33 32 32 32H128L135.2 17.69zM394.8 466.1C393.2 492.3 372.3 512 346.9 512H101.1C75.75 512 54.77 492.3 53.19 466.1L31.1 128H416L394.8 466.1z"/></svg>
				</span>
				<div class="mrb-button-delete__agreement">?</div>
			</button>
		</div>
		<form v-if="isTag" method="POST" class="block__content block__form block-form">
			<div class="block-form__items">
				<div
					class="block-form__item"
					:class="{ '_error': $store.getters.isName }">
					<label for="name" class="block-form__label">
						Название тега*:
						<template v-if="$store.getters.isName">
							<span v-for="message in $store.getters.name_valid_message" :key="message">
								{{ message + ' ' }}
							</span>
						</template>
					</label>
					<div class="block-form-item__content block-form-input">
						<div class="block-form-input__icon">
							<svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg"><path d="M9.219 350.5C11.38 351.5 13.69 352 16 352c3.688 0 7.312-1.25 10.25-3.719l96-80C125.9 265.3 128 260.7 128 255.1S125.9 246.8 122.3 243.7l-96-80c-4.781-4-11.41-4.781-17.03-2.219C3.594 164.2 0 169.8 0 176v160C0 342.2 3.594 347.8 9.219 350.5zM32 96h384c17.67 0 32-14.33 32-32S433.7 32 416 32H32C14.33 32 0 46.33 0 63.1S14.33 96 32 96zM416 416H32c-17.67 0-32 14.33-32 31.1S14.33 480 32 480h384c17.67 0 32-14.33 32-32S433.7 416 416 416zM416 288h-192C206.3 288 192 302.3 192 319.1S206.3 352 224 352h192c17.67 0 32-14.33 32-32S433.7 288 416 288zM416 160h-192C206.3 160 192 174.3 192 191.1S206.3 224 224 224h192c17.67 0 32-14.33 32-32S433.7 160 416 160z"/></svg>
						</div>
						<input
							type="text"
							@input="$store.dispatch('inputWatchName', $event)"
							:value="$store.getters.name"
							id="name"
							autocomplete="off"
							:readonly="$store.getters.isReadOnly || $store.getters.table !== 1"
							class="block-form-input__input"
							placeholder="Название тега...">
					</div>
				</div>
				<div
					class="block-form__item">
					<button
						type="submit"
						@click.prevent="$store.dispatch('sendTag', 'updateTag')"
						:disabled="$store.getters.isReadOnly"
						class="block-form__button block-form__submit block-form-submit"
						:class="{
								'_loading': $store.getters.loading,
								'_sending': $store.getters.result,
								'_error': $store.getters.isErrorResult
							}">
						<span class="block-form-submit__title">Добавить</span>
						<span class="block-form-submit__result">{{ $store.getters.resultMessage }}</span>
					</button>
				</div>
			</div>
		</form>
		<div v-else class="block__title text-center">
			<span class="_error">Нету данных!</span>
		</div>
	</div>
</template>

<script>
	import Preloader from './../includes/PreloaderComponent.vue';
    export default {
		name: 'Create',
		beforeCreate() {
			document.documentElement.classList.add('lock');
		},
		data() {
			return {
				isPreloader: false,
				isTag: true,
			}
		},
		mounted() {
			this.$store.dispatch("zeroingTag")
			this.$store.dispatch("getTags")
			this.getTag()
		},
		methods: {
			preloader() {
				document.documentElement.classList.remove('lock');
				this.isPreloader = true;
			},
			async getTag() {
				try {
					let response = await axios.get('/api/tags/' + this.$route.params.id);
					if (response && response.data && response.data.id && response.data.name) {
						this.$store.commit("setTag", response.data);
						this.$store.commit("setName", response.data.name)
					} else {
						this.isTag = false;
					}
				} catch (error) {
					this.isTag = false;
				} finally {
					this.preloader()
				}
			},
		},
		computed: {
		},
		components: {
			'preloader': Preloader,
		}
    }
</script>