import './bootstrap';
import { createApp } from 'vue';

const app = createApp({});

import index from './views/index.vue';
app.component('index', index);

app.mount('#app');
