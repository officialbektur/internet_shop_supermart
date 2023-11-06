import './bootstrap';
import './script';
import { createApp } from 'vue';
import store from './store/index.js';
import router from './router';

const app = createApp({});


import Index from './components/Index.vue';
app.component('Index', Index);


app.use(store);
app.use(router);

app.mount('#app');