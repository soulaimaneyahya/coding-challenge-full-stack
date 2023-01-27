<template>
  <div class="d-flex align-items-center justify-content-start my-3">
    <div class="d-flex align-items-center justify-content-start">
      <div class="form-group">
        <select name="categories" v-model="selectedCategory" id="categories" class="form-select"
          @change="selectedFilter()">
          <option :value="null" :selected="selectedCategory === null">Select a category</option>
          <option v-for="category in allCategories" :key="category.id" :value="category.id"
            :selected="category.id === selectedCategory">{{ category.name }}</option>
        </select>
      </div>
      <div class="form-group mx-2">
        <select name="sort_by" v-model="selectedSort" id="sort_by" class="form-select"
          @change="selectedFilter()">
          <option :value="null" :selected="selectedSort === null">Sort By</option>
          <option :selected="selectedSort === 'name'" value="name">Product Name</option>
          <option :selected="selectedSort === 'price'" value="price">Product Price</option>
        </select>
      </div>
      <div class="form-group">
        <select name="order" v-model="selectedOrder" id="order" class="form-select"
          @change="selectedFilter()">
          <option :value="null" :selected="selectedOrder === null">Order By</option>
          <option :selected="selectedOrder === 'asc'" value="asc">ASC</option>
          <option :selected="selectedOrder === 'desc'" value="desc">DESC</option>
        </select>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  emits: ['selected:filter'],
  props: {
    allCategories: Object
  },
  data() {
    return {
      selectedSort: null,
      selectedOrder: null,
      selectedCategory: null,
    }
  },
  methods: {
    selectedFilter() {
      this.$emit('selected:filter', {
        'selectedSort': this.selectedSort,
        'selectedOrder': this.selectedOrder,
        'selectedCategory': this.selectedCategory,
      })
    }
  }
}
</script>
