<template>
	<form method="POST" class="moreinfo-tovar-body-reviews__form moreinfo-tovar-body-reviews-form">
		<div class="moreinfo-tovar-body-reviews-form__title">
			Написать отзыв
		</div>
		<div class="moreinfo-tovar-body-reviews-form__rating moreinfo-tovar-body-reviews-form-rating">
			<label for="moreinfoTovarBodyReviewsFormRatingFife" class="moreinfo-tovar-body-reviews-form-rating__label">Оценить товар<span>*</span>: <span v-if="isRating" class="_message _error">{{ errorMassageRating }}</span></label>
			<div class="moreinfo-tovar-body-reviews-form-rating__body">
				<div class="moreinfo-tovar-body-reviews-form-rating__content">
					<div :style="{ 'width': ratingActiveWidth }" class="moreinfo-tovar-body-reviews-form-rating__active"></div>
					<div class="moreinfo-tovar-body-reviews-form-rating__items">
						<input v-for="index in 5" :key="index" :disabled="isReadOnly" @click="clickRating(index)" @mouseenter="mouseenterRating(index)" @mouseleave="mouseleaveRating" type="radio" class="moreinfo-tovar-body-reviews-form-rating__item" :id="index == 5 ? 'moreinfoTovarBodyReviewsFormRatingFife' : ''" :value="index" name="rating">
					</div>
				</div>
				<div class="moreinfo-tovar-body-reviews-form-rating__value">{{ ratingValue }}</div>
			</div>
		</div>
		<div class="moreinfo-tovar-body-reviews-form__username moreinfo-tovar-body-reviews-form-username">
			<label for="moreinfoTovarBodyReviewsFormUsernameInput" class="moreinfo-tovar-body-reviews-form-username__label">ФИО<span>*</span>: <span v-if="isUserName" v-for="errorMassage in errorMassageUserName" :key="errorMassage" class="_message _error">{{ errorMassage }} </span></label>
			<input v-model="userName" :readonly="isReadOnly" autocomplete="off" type="text" name="username" placeholder="ФИО" id="moreinfoTovarBodyReviewsFormUsernameInput" class="moreinfo-tovar-body-reviews-form-username__input">
		</div>
		<div class="moreinfo-tovar-body-reviews-form__message moreinfo-tovar-body-reviews-form-message">
			<label for="moreinfoTovarBodyReviewsFormMessageTextarea" class="moreinfo-tovar-body-reviews-form-message__label">Сообщение<span>*</span>: <span v-if="isMessage" v-for="errorMassage in errorMassageMessage" :key="errorMassage" class="_message _error">{{ errorMassage }} </span></label>
			<textarea v-model="message" :readonly="isReadOnly" autocomplete="off" name="message" placeholder="Сообщение..." id="moreinfoTovarBodyReviewsFormMessageTextarea" class="moreinfo-tovar-body-reviews-form-message__textarea"></textarea>
		</div>
		<div class="moreinfo-tovar-body-reviews-form__checkbox moreinfo-tovar-body-reviews-form-checkbox" :class="{ '_error': isCheckbox }">
			<input id="formAgreement" :disabled="isReadOnly" v-model="checked" type="checkbox" name="agreement" class="moreinfo-tovar-body-reviews-form-checkbox__input">
			<label for="formAgreement" class="moreinfo-tovar-body-reviews-form-checkbox__label moreinfo-tovar-body-reviews-form-checkbox-label">
				<span class="moreinfo-tovar-body-reviews-form-checkbox-label__inputcheckbox"></span>
				<span class="moreinfo-tovar-body-reviews-form-checkbox-label__text">
					Сохранить моё имя и адрес сайта в этом браузере для последующих моих комментариев.
				</span>
			</label>
		</div>
		<div class="moreinfo-tovar-body-reviews-form__innerbutton">
			<button @click.prevent="send" :disabled="isReadOnly" type="submit" class="moreinfo-tovar-body-reviews-form__button moreinfo-tovar-body-reviews-form-button" :class="{ '_loading': loading , '_sending': result, '_error': errorResult}">
				<span class="moreinfo-tovar-body-reviews-form-button__title">Отправить</span>
				<span class="moreinfo-tovar-body-reviews-form-button__result">{{ resulMassage }}</span>
			</button>
		</div>
	</form>
</template>

<script>
	export default {
		name: 'FormComponent',
		data() {
			return {
				ratingValue: 0,

				localStorageName: 'username',
				ratingActiveWidth: 0,
				isRating: false,
				errorMassageRating: 'Обязательно оцените товар!',

				isUserName: false,
				userName: '',
				errorMassageUserName: [],

				isMessage: false,
				message: '',
				errorMassageMessage: [],

				checked: true,
				isCheckbox: false,

				isValidated: true,

				errorMassageRequire: 'Заполните обязательное поле!',

				isReadOnly: false,

				loading: false,
				result: false,
				errorResult: false,
				resulMassage: '',
			};
		},
		mounted() {
			if (localStorage.getItem(this.localStorageName) && localStorage.getItem(this.localStorageName) !== '') {
				this.userName = localStorage.getItem(this.localStorageName);
			}
		},
		updated() {
		},
		methods: {
			send() {
				this.isReadOnly = true
				this.loading = true;
				this.isValidated = true
				this.isRating = false;
				this.isUserName = false;
				this.isMessage = false;
				this.isCheckbox = false

				if (this.ratingValue == 0) {
					this.isValidated = false
					this.isRating = true;
				}
				if (!this.userName || this.userName < 3 || this.userName > 60) {
					this.isValidated = false
					this.isUserName = true;
					this.errorMassageUserName = [];
					if (!this.userName) {
						this.errorMassageUserName.push(this.errorMassageRequire);
					}
					if (this.userName.length < 3) {
						this.errorMassageUserName.push('Не менее 3 символов!');
					}
					if (this.userName.length > 60) {
						this.errorMassageUserName.push('Должен содержать не более 60 символов!');
					}
				}
				if (!this.message  || this.message.length < 5 || this.message.length > 255) {
					this.isValidated = false
					this.isMessage = true;
					this.errorMassageMessage = [];
					if (!this.message) {
						this.errorMassageMessage.push(this.errorMassageRequire);
					}
					if (this.message.length < 5) {
						this.errorMassageMessage.push('Не менее 5 символов!');
					}
					if (this.message.length > 255) {
						this.errorMassageMessage.push('Должен содержать не более 255 символов!');
					}
				}
				if (!this.checked) {
					this.isValidated = false
					this.isCheckbox = true
				}
				if (this.isValidated) {
					this.setCommentary(this.ratingValue, this.userName, this.message)
				} else {
					this.finishResult('Ошибка валидации', true)
				}
			},
			async setCommentary(rating, name, message) {
				localStorage.setItem(this.localStorageName, name)
				try {
					let response = await axios.post('/api/commentaries', {product_id: this.$route.params.id, rating: rating, name: name, message: message});
					if (response && response.data && response.data.length > 0) {
						let commentaries = this.$store.getters.commentaries;
						commentaries.unshift(...response.data);
						this.$store.commit("setCommentaries", commentaries)
						this.$store.commit("setCommentariesCount", Number(this.$store.getters.commentariesCount) + 1)
						this.finishResult('Добавленно')
					}
				} catch (error) {
					this.finishResult(error.response.data.error, true)
				}
			},
			finishResult(message, errorStatus = false) {
				setTimeout(() => {
					this.resulMassage = message
					this.result = true
					this.loading = false;
					if (errorStatus) {
						this.errorResult = true
					}
					setTimeout(() => {
						this.result = false
						if (errorStatus) {
							this.errorResult = false
						} else {
							this.ratingValue = 0;
							this.mouseenterRating(0)
							this.message = '';
						}
						setTimeout(() => {
							this.isReadOnly = false
						}, 600);
					}, 1200);
				}, 600);
			},
			setRatingActiveWidth(index = this.ratingValue) {
				const ratingActiveWidth = index / 0.05;
				this.ratingActiveWidth = `${ratingActiveWidth}%`;
			},
			clickRating(index) {
				this.ratingValue = this.ratingValue == index ? 0 : index;
				this.setRatingActiveWidth();
			},
			mouseenterRating(index) {
				this.setRatingActiveWidth(index)
			},
			mouseleaveRating() {
				this.setRatingActiveWidth();
			},
		},
		computed: {
		},
		components: {
		},
	}
</script>