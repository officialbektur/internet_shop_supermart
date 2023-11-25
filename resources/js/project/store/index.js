import { createApp } from "vue";
import { createStore } from "vuex";

import App from './modules/app.js';
import Product from './modules/product.js';
import Header from './modules/header.js';
import Sidbar from './modules/sidbar.js';
import Commentary from './modules/commentary.js';

const app = createApp({});

const store = createStore({
	modules: {
		App,
        Product,
		Header,
		Sidbar,
		Commentary,
	}
})

app.use(store);
export default store;
