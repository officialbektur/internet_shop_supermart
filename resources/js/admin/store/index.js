import { createApp } from "vue";
import { createStore } from "vuex";
import Index from './modules/index.js';
import Form from './modules/form.js';
import Category from './modules/category.js';
import Tag from './modules/tag.js';
import Specification from './modules/specification.js';
import Linking from './modules/linking.js';
import SearchHint from './modules/searchhint.js';
import Log from './modules/log.js';

const app = createApp({});

const store = createStore({
	modules: {
		Index,
		Form,
		Category,
		Tag,
		Specification,
		Linking,
		SearchHint,
		Log,
	}
})

export default store;