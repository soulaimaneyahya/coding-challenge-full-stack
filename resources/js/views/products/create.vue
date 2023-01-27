<template>
  <section>
    <header>
      <div class="d-flex align-items-center justify-content-between">
        <h3>Create Product</h3>
      </div>
    </header>
    <div class="my-4">
      <div class="form-group mb-3">
        <label for="name" class="text-muted">Product Name</label>
        <input v-model="product.name" type="text" name="name" placeholder="Product Name" class="form-control"
          :class="{ 'is-invalid': errorFor('name') }" />
        <div v-if="errorFor('name')">
          <v-errors :errors="errorFor('name')" />
        </div>
      </div>

      <div class="form-group mb-3">
        <label for="description" class="text-muted">Product Description</label>
        <textarea v-model="product.description" name="description" placeholder="Product Description"
          class="form-control" :class="{ 'is-invalid': errorFor('description') }" />
        <div v-if="errorFor('description')">
          <v-errors :errors="errorFor('description')" />
        </div>
      </div>

      <div class="form-group mb-3">
        <label for="price" class="text-muted">Price</label>
        <input v-model.number="product.price" type="number" min="1" step=".01" name="price" placeholder="Price"
          class="form-control" :class="{ 'is-invalid': errorFor('Price') }" />
        <div v-if="errorFor('price')">
          <v-errors :errors="errorFor('price')" />
        </div>
      </div>

      <div class="mb-3">
        <label for="category_id">Choose Category</label>
        <div v-for="category in allCategories" :key="'category' + category.id" class="form-check">
          <input :id="'category-' + category.id" v-model="product.categories" class="form-check-input"
            :class="{ 'is-invalid': errorFor('category_id') }" type="checkbox" :value="category.id" />
          <label class="form-check-label" :for="'category-' + category.id">{{ category.name }}</label>
        </div>
        <div v-if="errorFor('category_id')">
          <v-errors :errors="errorFor('category_id')" />
        </div>
      </div>

      <div class="mb-3">
        <label for="image" class="form-label">Attache Image</label>
        <input id="image" class="form-control" :class="{ 'is-invalid': errorFor('image') }" type="file" name="image"
          accept="image/png, image/gif, image/svg, image/jpg, image/jpeg" @change="uploadImage" />
        <div v-if="errorFor('image')">
          <v-errors :errors="errorFor('image')" />
        </div>
      </div>

      <button class="btn btn-sm btn-dark mb-3" :disabled="loading" @click="create">
        <span v-if="!loading">Create</span>
        <span v-if="loading">
          <i class="bi bi-arrow-repeat" /> Creating...
        </span>
      </button>
    </div>
  </section>
</template>

<script>
import axios from 'axios'

export default {
  data() {
    return {
      product: {
        name: null,
        description: null,
        price: null,
        image: null,
        categories: [],
      },
      allCategories: [],
      loading: false,
      status: null,
      errors: null,
    }
  },
  async created() {
    try {
      this.allCategories = (await axios.get(`/all-categories`)).data
    } catch (err) {
      console.error(err)
    }
  },
  methods: {
    uploadImage(event) {
      this.product.image = event.target.files[0]
    },
    create() {
      this.loading = true
      axios.post('/products', this.product, {
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      }).then(res => {
        this.status = res.status
        this.$router.push({
          name: 'products.index',
        })
      }).catch(error => {
        if (error.response.status === 422) {
          this.errors = error.response.data.errors
        }
      })
      this.loading = false
    },
    errorFor(field) {
      return (this.errors !== null && this.errors[field]) ? this.errors[field] : null
    },
  },
}
</script>
