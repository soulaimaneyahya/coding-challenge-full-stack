<template>
  <div class="d-flex align-items-center justify-content-start my-3">
    <div class="d-flex align-items-center justify-content-start">
      <div class="form-group">
        <select
          id="categories" v-model="selectedCategory" name="categories" class="form-select"
          @change="selectedFilter()"
        >
          <option :value="null" :selected="selectedCategory === null">Select a category</option>
          <option
            v-for="category in allCategories" :key="category.id" :value="category.id"
            :selected="category.id === selectedCategory"
          >
            {{ category.name }}
          </option>
        </select>
      </div>
      <div class="form-group mx-2">
        <select id="sort_by" v-model="selectedSort" name="sort_by" class="form-select" @change="selectedFilter()">
          <option :value="null" :selected="selectedSort === null">Sort By</option>
          <option :selected="selectedSort === 'name'" value="name">Product Name</option>
          <option :selected="selectedSort === 'price'" value="price">Product Price</option>
        </select>
      </div>
      <div class="form-group">
        <select id="order" v-model="selectedOrder" name="order" class="form-select" @change="selectedFilter()">
          <option :value="null" :selected="selectedOrder === null">Order By</option>
          <option
            v-for="option in sortOptions" 
            :key="option.value"
            :value="option.value"
            :selected="selectedOrder === option.value"
          >
            {{ option.label }}
          </option>
        </select>
      </div>
      <div class="form-group mx-2">
        <button v-if="hasFilters" @click="clear()" type="reset" class="btn btn-secondary">Clear</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    allCategories: Object,
  },
  emits: ['selected:filter'],
  data() {
    return {
      selectedSort: null,
      selectedOrder: null,
      selectedCategory: null,
      sortLabels: {
        name: [
          {
            label: 'A-Z',
            value: 'desc',
          },
          {
            label: 'Z-A',
            value: 'asc',
          },
        ],
        price: [
          {
            label: 'Pricey',
            value: 'desc',
          },
          {
            label: 'Cheapest',
            value: 'asc',
          },
        ],
      }
    }
  },
  computed: {
    hasFilters() {
      return this.selectedSort || this.selectedOrder || this.selectedCategory
    },
    sortOptions() {
      return this.sortLabels[this.selectedSort]
    }
  },
  methods: {
    selectedFilter() {
      this.$emit('selected:filter', {
        'selectedSort': this.selectedSort,
        'selectedOrder': this.selectedOrder,
        'selectedCategory': this.selectedCategory,
      })
    },
    clear() {
      this.selectedSort= null
      this.selectedOrder= null
      this.selectedCategory= null
      this.selectedFilter()
    }
  },
}
</script>
