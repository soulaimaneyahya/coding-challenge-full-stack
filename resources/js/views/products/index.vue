<template>
  <div class="py-5 container mx-auto">
    <div class="d-flex align-items-center justify-content-between">
      <h3>Products</h3>
    </div>
    <di class="py-3">
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
            v-for="(product, index) in products" :key="index"
            :product="product"
          />
        </tbody>
        <tbody v-else>
          <tr>
            <td class="text-center" colspan="5">No product Found</td>
          </tr>
        </tbody>
      </table>
      <div class="mt-2">
        <pagination :links="links" />
      </div>
    </di>
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
    }
  },
  created() {
    this.fetchProducts()
  },
  methods: {
    fetchProducts() {
      axios.get('/products')
        .then(res => {
          this.products = res.data.data
          this.links = res.data.links
        })
      this.loading = false
    },
  },
}
</script>
