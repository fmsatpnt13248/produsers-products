import './bootstrap';

import { createApp } from 'vue';
import Producers from './components/Producers.vue';
import Products from './components/Products.vue';
import Orders from './components/Orders.vue';
import ProductSelection from './components/ProductSelection.vue';
import OrderItems from './components/OrderItems.vue';

const app = createApp({});
app.component("producers", Producers);
app.component("products", Products);
app.component("orders", Orders);
app.component("product-selection", ProductSelection);
app.component("order-items", OrderItems);
app.mount("#app");
