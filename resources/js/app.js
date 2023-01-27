import '@/bootstrap'
import router from '@/router'
import { createApp } from 'vue'

const app = createApp({})

import index from '@/views/index.vue'
import pagination from '@/views/components/pagination.vue'

app.component('Index', index)
app.component('Pagination', pagination)

app.use(router)

app.mount('#app')
