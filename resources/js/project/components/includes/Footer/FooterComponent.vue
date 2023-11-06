<template>
	<!-----------------------------------  Footer  --Start-- ----------------------------------->
	<footer v-if="infos" class="footer">
		<section class="footer__body">
			<div class="footer__container">
				<div class="footer__content">
					<div class="footer__column footer__infoaboutus footer-infoaboutus">
						<router-link :to="{ name: 'index' }" @click="$store.dispatch('showPreloader')" class="footer-infoaboutus__logo">
							<img :src="'/storage/project/logo/logo.png'" alt="logo">
						</router-link>
						<div data-spollers="767,max" class="footer-spoller footer-infoaboutus__telephones footer-infoaboutus-telephones">
							<button data-spoller type="button" class="footer-spoller__title footer-infoaboutus-telephones__title">Контакт</button>
							<div class="footer-spoller__content footer-infoaboutus-telephones__content">
								<ul class="footer-infoaboutus-telephones__lists">
									<li v-if="infos.telephones" v-for="(info, index) in infos.telephones" :key="index" class="footer-infoaboutus-telephones__list">
										<a :href="info.href" class="footer-infoaboutus-telephones__link">{{ info.number }}</a>
									</li>
								</ul>
							</div>
						</div>
						<div data-spollers="767,max" class="footer-spoller footer-infoaboutus__gmaile footer-infoaboutus-gmaile">
							<button data-spoller type="button" class="footer-spoller__title footer-infoaboutus-gmaile__title">Почта:</button>
							<div class="footer-spoller__content footer-infoaboutus-gmaile__content">
								<ul class="footer-infoaboutus-gmaile__lists">
									<li v-if="infos.emails" v-for="(info, index) in infos.emails" :key="index"  class="footer-infoaboutus-gmaile__list">
										<a :href="info.href" class="footer-infoaboutus-gmaile__link">{{ info.email }}</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div data-spollers="767,max" class="footer-spoller footer__column footer__infoaboutworking footer-infoaboutworking">
						<button data-spoller type="button" class="footer-spoller__title footer-infoaboutworking__title">
							График работы
						</button>
						<div class="footer-spoller__content">
							<div class="footer-infoaboutworking__content footer-infoaboutworking-content">
								<div class="footer-spoller footer-infoaboutworking-content__dayworking footer-infoaboutworking-content-dayworking">
									<div class="footer-infoaboutworking-content-dayworking__title">
										Режим работы:
									</div>
									<div class="footer-infoaboutworking-content-dayworking__infotext">
										<template v-if="infos.plan_works"> {{ infos.plan_works.mode }}</template>
									</div>
								</div>
								<div class="footer-infoaboutworking-content__timework footer-infoaboutworking-content-timework">
									<div class="footer-infoaboutworking-content-timework__title">
										Время работы:
									</div>
									<div class="footer-infoaboutworking-content-timework__infotext">
										<template v-if="infos.plan_works"> {{ infos.plan_works.hours }}</template>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div data-spollers="767,max" class="footer-spoller footer__column footer__ouraddress footer-ouraddress">
						<button data-spoller type="button" class="footer-spoller__title footer-ouraddress__title">
							Наш адрес
						</button>
						<div class="footer-spoller__content">
							<div v-if="infos.adresses" v-for="(info, index) in infos.adresses" :key="index" class="footer-ouraddress__content footer-ouraddress-content">
								<div class="footer-ouraddress-content__title">
									Адрес{{ ' ' + (index + 1) }}:
								</div>
								<a :href="info.href" class="footer-ouraddress-content__infotext">
									{{ info.title }}
								</a>
							</div>
						</div>
					</div>
					<div class="footer__column footer__aboutuse footer-aboutuse">
						<div data-spollers="767,max" class="footer-spoller footer-aboutuse__info footer-aboutuse-info">
							<button data-spoller type="button" class="footer-spoller__title footer-aboutuse-info__title">
								Информация
							</button>
							<div class="footer-spoller__content">
								<div class="footer-aboutuse-info__lists">
									<a href="" class="footer-aboutuse-info__list">
										О магазине
									</a>
									<a href="#" class="footer-aboutuse-info__list">
										Политика конфиденциальности
									</a>
								</div>
							</div>
						</div>
						<div class="footer-aboutuse__soc footer-aboutuse-soc">
							<div class="footer-column__title footer-aboutuse-soc__title">
								Мы в соц сетях
							</div>
							<div class="footer-aboutuse-soc__items">
								<a v-if="infos.socs" v-for="info in infos.socs" :key="info" :href="info.href" class="footer-aboutuse-soc__item" v-html="info.icon"></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="footer__company footer-company">
			<div class="footer__container">
				<div class="footer-company__title">
					© Все права защищены
				</div>
			</div>
		</section>
	</footer>
	<!-----------------------------------  Footer  --End-- ----------------------------------->
</template>

<script>
	export default {
		name: 'FooterComponent',
		data() {
			return {
			};
		},
		mounted() {
		},
		updated() {
		},
		methods: {

		},
		computed: {
			infos() {
				return this.$store.getters.app
			}
		},
		components: {
		},
    }
</script>

<style scoped>
</style>