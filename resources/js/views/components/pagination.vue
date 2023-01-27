<template>
  <div class="d-flex justify-content-center gap-1">
    <router-link
      v-for="(link, index) in links" 
      :key="index" 
      class="py-2 px-4 rounded-md" 
      :class="{'link-active': link.active}"
      :to="{ name: 'products.index', query: {page: index} }"
      v-html="link.label"
    />
  </div>
</template>

<script>
export default {
  props: {
    links: Array,
  },
}
</script>

<style>
.link-active {
    color: dark;
    font-weight: 600;
    text-decoration: underline;
}
</style>
