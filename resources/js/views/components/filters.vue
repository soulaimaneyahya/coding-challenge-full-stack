<template>
  <div class="d-flex align-items-center justify-content-start my-3">
      <div class="d-flex align-items-center justify-content-start">
        <div class="form-group">
          <select class="form-select" id="sort_by">
            <option value="name">Product Name</option>
            <option value="price">Product Price</option>
          </select>
        </div>
        <div class="form-group mx-2">
          <select class="form-select" id="order">
            <option value="asc">ASC</option>
            <option value="desc">DESC</option>
          </select>
        </div>
        <button type="submit" class="btn btn-secondary">Filter</button>
        <div class="mx-2">
          <a class="btn btn-secondary">Clear</a>
        </div>
      </div>
    </div>
</template>

<script>
export default {

}
</script>

