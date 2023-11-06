import { createApp } from "vue";
import { createStore } from "vuex";
import Index from './modules/index.js';
import Products from './modules/product.js';
import Header from './modules/header.js';
import Sidbar from './modules/sidbar.js';
import Commentary from './modules/commentary.js';

const app = createApp({});

const store = createStore({
	modules: {
		Index,
		Products,
		Header,
		Sidbar,
		Commentary,
	}
})

app.use(store);
export default store;