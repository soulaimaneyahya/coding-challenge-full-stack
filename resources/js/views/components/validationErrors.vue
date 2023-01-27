<template>
  <div>
    <div v-for="(error, index) in errors" :key="index" class="font-bold text-danger">{{ error }}</div>
  </div>
</template>
<script>
export default {
  props: {
    errors: Array,
  },
}
</script>
