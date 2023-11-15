<template>
	<div class="block">
		<div class="block__title">Добавить новый рекомендаций в поиске</div>
		<form method="POST" class="block__content block__form block-form">
			<div class="block-form__items">
				<div
					class="block-form__item"
					:class="{ '_error': $store.getters.isName }">
					<label for="name" class="block-form__label">
						Название рекомендаций*:
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
							:readonly="$store.getters.isReadOnly"
							class="block-form-input__input"
							placeholder="Название рекомендаций...">
					</div>
				</div>
				<div
					class="block-form__item">
					<button
						type="submit"
						@click.prevent="$store.dispatch('sendSearchHint', 'storeSearchHint')"
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
	</div>
</template>

<script>
	import API from '@/admin/api';
    export default {
		name: 'Create',
		data() {
			return {
			}
		},
		mounted() {
			this.$store.dispatch("zeroingSearchHint")
			this.$store.dispatch("getSearchHints")
		},
		methods: {
		},
		computed: {
		},
		components: {
		}
    }
</script>