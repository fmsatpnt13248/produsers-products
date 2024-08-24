import './bootstrap';

import { createApp } from 'vue';
import Producers from './components/Producers.vue';
import Products from './components/Products.vue';

const app = createApp({});
app.component("producers", Producers);
app.component("products", Products);
app.mount("#app");
