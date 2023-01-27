import '@/bootstrap'
import router from '@/router'
import { createApp } from 'vue'

const app = createApp({})

import index from '@/views/index.vue'
import pagination from '@/views/components/pagination.vue'
import filters from '@/views/components/filters.vue'
import validationErrors from "./views/components/validationErrors.vue";

app.component('Index', index)
app.component('pagination', pagination)
app.component('filters', filters)
app.component("v-errors", validationErrors);

app.use(router)

app.mount('#app')
