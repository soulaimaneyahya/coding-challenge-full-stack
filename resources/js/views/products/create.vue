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
        <input type="text" name="name" placeholder="Product Name" class="form-control"
          :class="{ 'is-invalid': errorFor('name') }" v-model="product.name" />
        <div v-if="errorFor('name')">
          <v-errors :errors="errorFor('name')"></v-errors>
        </div>
      </div>

      <div class="form-group mb-3">
        <label for="description" class="text-muted">Product Description</label>
        <textarea name="description" placeholder="Product Description" class="form-control"
          :class="{ 'is-invalid': errorFor('description') }" v-model="product.description"></textarea>
        <div v-if="errorFor('description')">
          <v-errors :errors="errorFor('description')"></v-errors>
        </div>
      </div>

      <div class="form-group mb-3">
        <label for="price" class="text-muted">Price</label>
        <input type="number" min="1" step=".01" name="price" placeholder="Price" class="form-control"
          :class="{ 'is-invalid': errorFor('Price') }" v-model.number="product.price" />
        <div v-if="errorFor('price')">
          <v-errors :errors="errorFor('price')"></v-errors>
        </div>
      </div>

      <div class="mb-3">
        <label for="category_id">Choose Category</label>
        <div class="form-check" v-for="category in allCategories" :key="'category' + category.id">
          <input class="form-check-input" :class="{ 'is-invalid': errorFor('category_id') }" type="checkbox"
            :id="'category-' + category.id" :value="category.id" v-model="product.categories" />
          <label class="form-check-label" :for="'category-' + category.id">{{ category.name }}</label>
        </div>
        <div v-if="errorFor('category_id')">
          <v-errors :errors="errorFor('category_id')"></v-errors>
        </div>
      </div>

      <div class="mb-3">
        <label for="image" class="form-label">Attache Image</label>
        <input class="form-control" :class="{ 'is-invalid': errorFor('image') }" type="file" name="image"
          accept="image/png, image/gif, image/svg, image/jpg, image/jpeg" @change="uploadImage" id="image">
        <div v-if="errorFor('image')">
          <v-errors :errors="errorFor('image')"></v-errors>
        </div>
      </div>

      <button class="btn btn-sm btn-dark mb-3" @click="create" :disabled="loading">
        <span v-if="!loading">Create</span>
        <span v-if="loading">
          <i class="bi bi-arrow-repeat"></i> Creating...
        </span>
      </button>
    </div>
  </section>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      product: {
        name: null,
        description: null,
        price: null,
        image: null,
        categories: []
      },
      allCategories: [],
      loading: false,
      status: null,
      errors: null,
    }
  },
  methods: {
    uploadImage(event) {
      this.product.image = event.target.files[0];
    },
    create() {
      this.loading = true
      axios.post("/products", this.product, {
        headers: {
          "Content-Type": "multipart/form-data"
        }
      }).then(res => {
        this.status = res.status
        this.$router.push({
          name: "products.index",
        });
      }).catch(error => {
        if (error.response.status === 422) {
          this.errors = error.response.data.errors
        }
      });
      this.loading = false
    },
    errorFor(field) {
      return (this.errors !== null && this.errors[field]) ? this.errors[field] : null;
    },
  },
}
</script>
