<template>
  <div class="py-5 container mx-auto">
    <div class="d-flex align-items-center justify-content-between">
      <h3>Products</h3>
      <router-link :to="{name: 'products.create'}" class="btn btn-sm btn-dark">Create</router-link>
    </div>
    <filters
      :all-categories="allCategories"
      @selected:filter="selectedFilter($event)"
    />
    <div class="py-3">
      <table class="table m-0 p-0">
        <thead>
          <tr class="fw-bold">
            <th scope="col">Image</th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Created</th>
            <th scope="col" />
          </tr>
        </thead>
        <tbody v-if="products && products.length">
          <product
            v-for="(product, index) in products"
            :key="index"
            :product="product"
            @product:deleted="fetchProducts()"
          />
        </tbody>
        <tbody v-else>
          <tr>
            <td class="text-center" colspan="5">No product Found</td>
          </tr>
        </tbody>
      </table>
      <div class="mt-2">
        <pagination :links="links" route-name="products.index" />
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import product from '@/views/products/partials/product.vue'

export default {
  components: { product },
  data() {
    return {
      loading: true,
      products: [],
      links: [],
      allCategories: [],
      selectedSort: null,
      selectedOrder: null,
      selectedCategory: null,
    }
  },
  watch: {
    '$route.query.page': {
      immediate: true,
      handler() {
        this.fetchProducts()
      },
    },
  },
  async created() {
    try {
      this.fetchProducts()
      this.allCategories = (await axios.get('all-categories')).data
    } catch (err) {
      console.error(err)
    }
  },
  methods: {
    fetchProducts() {
      axios.get('/products', {
        params: {
          page: this.$route.query.page || 1,
          sort_by: this.selectedSort,
          order: this.selectedOrder,
          category: this.selectedCategory,
        },
      })
        .then(res => {
          this.products = res.data.data
          this.links = res.data.links
        })
      this.loading = false
    },
    selectedFilter(event) {
      this.selectedSort = event.selectedSort
      this.selectedOrder = event.selectedOrder
      this.selectedCategory = event.selectedCategory
      this.fetchProducts()
    },
  },
}
</script>
