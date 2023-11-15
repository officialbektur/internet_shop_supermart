<template>
	<div class="block">
		<div class="block__mincontainer">
			<button
				type="button"
				@click.prevent="$parent.spollers($event)"
				class="block-form__spollers block-form-spollers">
				<div class="block-form-spollers__title">Соц. сети</div>
				<div class="block-form-spollers__button block-form-spollers-button">
					<span class="block-form-spollers-button__icon">
						<svg viewBox="0 0 384 512" xmlns="http://www.w3.org/2000/svg"><path d="M352 352c-8.188 0-16.38-3.125-22.62-9.375L192 205.3 54.6 342.7c-12.5 12.5-32.75 12.5-45.25 0s-12.5-32.75 0-45.25l160-160c12.5-12.5 32.75-12.5 45.25 0l160 160c12.5 12.5 12.5 32.75 0 45.25-6.2 6.2-14.4 9.3-22.6 9.3z"/></svg>
					</span>
				</div>
			</button>
			<div hidden class="block__body">
				<div class="block__content block__form block-form">
					<div class="block-form__evaluation block-form-evaluation">
						<div class="block-form-evaluation__content">
							<div
								@click.prevent="funcEvaluationCheck(true)"
								class="block-form-evaluation__item"
								:class="{ '_active': table}">
								Изменить
							</div>
							<div
								@click.prevent="funcEvaluationCheck(false)"
								class="block-form-evaluation__item"
								:class="{ '_active': !table}">
								Добавить
							</div>
							<div
								class="block-form-evaluation__check"
								:style="styleEvaluationCheck"></div>
						</div>
					</div>
					<template v-if="table">
						<template v-if="socs.length > 0">
							<socblock
								v-for="(soc, index) in socs"
								:key="index"
								:index="++index"
								:soc="soc"></socblock>
						</template>
					</template>
					<template v-else>
						<add-soc></add-soc>
					</template>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import API from '@/admin/api';
	import SocBlock from './includes/SocBlock.vue';
	import AddSoc from './includes/AddSoc.vue';
	export default {
		name: 'IndexComponent',
		data() {
			return {
				socs: [],
				table: true,
				styleEvaluationCheck: ''
			};
		},
		watch: {
			getSocs(newSocs, oldSocs) {
				this.socs = newSocs;
			}
		},
		mounted() {
		},
		updated() {
		},
		methods: {
			funcEvaluationCheck(index) {
				this.table = index;
				this.styleEvaluationCheck = {
					'left': (index ? 0 : 1) / (2) * 100 + '%'
				};
			}
		},
		computed: {
			getSocs() {
				return this.$parent.app.socs;
			}
		},
		components: {
			'socblock': SocBlock,
			'add-soc': AddSoc,
		},
	}
</script>
<style scoped lang="scss">
</style>