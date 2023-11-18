import './bootstrap';
import './script';
import { createApp } from 'vue';
import store from './store/index.js';
import router from './router';

import Index from './components/Index.vue';
import VueProgressBar from "@aacassandra/vue3-progressbar";

const app = createApp({});

const optionsProgressBar = {
	color: "rgba(0,0,0,0)",
	thickness: "4px",
	transition: {
		speed: "1.6s",
		opacity: "0.6s",
		termination: 300,
	},
};

app.component('Index', Index);

app.use(VueProgressBar, optionsProgressBar);
app.use(store);
app.use(router);

app.mount('#app');