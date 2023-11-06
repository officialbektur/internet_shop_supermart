<template>
	<div class="moreinfo-tovar-body__reviews moreinfo-tovar-body-reviews">
		<div class="moreinfo-tovar-body__reviews moreinfo-tovar-body-reviews__content">
			<form-component></form-component>
			<commentary-component></commentary-component>
		</div>
	</div>
</template>

<script>
	import axios from 'axios';
	import FormComponent from "./includes/FormComponent.vue";
	import CommentaryComponent from "./includes/CommentaryComponent.vue";
    export default {
		name: 'Commentary',

		components: {
			'form-component': FormComponent,
			'commentary-component': CommentaryComponent,
		}
    }
</script>