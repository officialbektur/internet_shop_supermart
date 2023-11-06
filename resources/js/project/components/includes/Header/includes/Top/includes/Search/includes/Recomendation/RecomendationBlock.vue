<template>
	<history-block></history-block>
	<hint-block></hint-block>
</template>

<script>
	import axios from 'axios';
	import HistoryBlock from "./includes/History/HistoryBlock.vue";
	import HintBlock from "./includes/Hint/HintBlock.vue";
    export default {
		name: 'RecomendationBlock',

		data() {
			return {
			};
		},
		mounted() {
		},
		methods: {

		},

		components: {
			"history-block": HistoryBlock,
			"hint-block": HintBlock,
		}
    }
</script>