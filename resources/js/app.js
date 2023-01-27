import '@/bootstrap';
import router from "@/router";
import { createApp } from 'vue';

const app = createApp({});

import index from "@/views/index.vue";

app.component("index", index);

app.use(router);

app.mount('#app');
