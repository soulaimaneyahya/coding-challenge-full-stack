<template>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <router-link :to="{ name: 'home' }">Home</router-link>
        </li>
        <li class="nav-item mx-3">
          <router-link :to="{ name: 'products.index' }">Products</router-link>
        </li>
        <li class="nav-item">
          <router-link :to="{ name: 'categories.index' }">Categories</router-link>
        </li>
      </ul>
    </div>
  </nav>
</template>
<style>
.router-link-active {
    color: dark;
    font-weight: 600;
    text-decoration: underline;
}
</style>
