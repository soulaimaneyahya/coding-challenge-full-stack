<template>
  <tr>
    <td>{{ category.name }}</td>
    <td>Added <span class="fw-bold">{{ category.created_at }} </span></td>
    <td />
  </tr>
</template>

<script>
export default {
  props: {
    category: Object,
  },
}
</script>
