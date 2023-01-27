<template>
  <main>
    <NavBar class="py-3 shadow-sm bg-white" />
    <RouterView class="py-3 container mx-auto" />
  </main>
</template>

<script>
import NavBar from '@/views/partials/NavBar.vue'
export default {
  components: { NavBar },
}
</script>
