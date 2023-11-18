<template>
	<preloader :class="{ '_hidde': isPreloader }"></preloader>
	<div class="block">
		<h2 class="block__title">Изменить о нас</h2>
		<div class="page__content">
			<form method="post" class="mrb-admin__form mrb-admin-form max-width-100">
				<div class="mrb-admin-form__item">
					<label
						:for="'editorContent'"
						class="mrb-admin-form__label"
						:class="{ '_error': isAbout }">
						Данные*:
						<template v-if="isAbout">
							<span v-for="message in about_valid_message" :key="message">
								{{ message + ' ' }}
							</span>
						</template>
					</label>
					<div class="mrb-admin-form__about mrb-admin-form-about">
						<quill-editor
							v-model:content="editorContent"
							:content="'String'"
							:contentType="'html'"
							:options="editorOptions"
							:id="'editorContent'"
							:disabled="$store.getters.isReadOnly"
						></quill-editor>
					</div>
				</div>
				<div class="mrb-admin-form__item mrb-admin-form__innerbutton">
					<button
						type="submit"
						@click.prevent="sendAbout"
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
</template>
<script>
	import { QuillEditor } from '@vueup/vue-quill'


	import Preloader from '@/admin/plugins/Preloader/Preloader.vue';

	import API from '@/admin/api';

	export default {
		name: 'Edit',
		beforeCreate() {
			document.documentElement.classList.add('lock');
		},
		data() {
			return {
				isPreloader: false,

				isAbout: false,
				about_valid_message: [],

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
		mounted() {
			this.getAbout();
		},
		updated() {
		},
		methods: {
			preloader() {
				document.documentElement.classList.remove('lock');
				this.isPreloader = true;
			},
			async getAbout() {
				try {
					let response = await axios.get('/api/abouts');
					if (response && response.data && response.data.content) {
						this.editorContent = response.data.content;
					}
				} catch (error) {
				} finally {
					this.preloader();
				}
			},
			async updateAbout() {
				try {
					let response = await API.patch('/api/admin/abouts', { content: this.editorContent });
					if (response && response.data) {
						if (response.data.message) {
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
				} catch (error) {
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
				} finally {
					this.preloader();
				}
			},
			sendAbout() {
				this.$store.commit("setIsReadOnly", true)
				this.$store.commit("setLoading", true)

				this.isAbout =  false
				this.about_valid_message = []
				if (this.editorContent.length === 0) {
					this.isAbout = true;
					this.about_valid_message.push('Заполните обезательное поле!');
				}

				if (!this.isAbout) {
					this.updateAbout()
				} else {
					this.$store.dispatch("finishResult", {
						message: 'Ошибка валидации',
						errorStatus: true,
					});
				}
			},
		},
		computed: {
		},
		components: {
			'preloader': Preloader,
			'quill-editor': QuillEditor,
		},
	}
</script>

<style>
</style>