<template>
  <div class="d-flex justify-content-center gap-1">
    <router-link
      v-for="(link, index) in links" :key="index" class="py-2 px-4 rounded-md"
      :class="{'link-active': link.active}" :to="{ name: routeName, query: { page: nextPage(link.url) } }"
      v-html="link.label"
    />
  </div>
</template>

<script>
export default {
  props: {
    links: Array,
    routeName: String,
  },
  methods: {
    nextPage(url) {
      const page = url ? url.split('page')[1].split('=')[1] : 1
      return page
    },
  },
}
</script>

<style>
.link-active {
  color: dark;
  font-weight: 600;
  color: black;
  text-decoration: underline;
}
</style>
