<template>
  <div class="py-5 container mx-auto">
    <div class="d-flex align-items-center justify-content-between">
      <h3>Categories</h3>
    </div>
    <div class="py-3">
      <table class="table m-0 p-0">
        <thead>
          <tr class="fw-bold">
            <th scope="col">Name</th>
            <th scope="col">Parent Category</th>
            <th scope="col">Products Count</th>
            <th scope="col">Created</th>
            <th scope="col" />
          </tr>
        </thead>
        <tbody v-if="categories && categories.length">
          <category v-for="(category, index) in categories" :key="index" :category="category" />
        </tbody>
        <tbody v-else>
          <tr>
            <td class="text-center" colspan="5">No category Found</td>
          </tr>
        </tbody>
      </table>
      <div class="mt-2">
        <pagination :links="links" route-name="categories.index" />
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import category from '@/views/categories/partials/category.vue'

export default {
  components: { category },
  data() {
    return {
      loading: true,
      categories: [],
      links: [],
    }
  },
  watch: {
    '$route.query.page': {
      immediate: true,
      handler() {
        this.fetchCategories()
      },
    },
  },
  created() {
    this.fetchCategories()
  },
  methods: {
    fetchCategories() {
      axios.get('/categories', {
        params: {
          page: this.$route.query.page || 1,
        },
      })
        .then(res => {
          this.categories = res.data.data
          this.links = res.data.links
        })
      this.loading = false
    },
  },
}
</script>
