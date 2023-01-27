<template>
  <tr>
    <td>{{ category.name }}</td>
    <td>
      <span v-if="category.parent_category_id && category.parent">{{ category.parent.name }}</span>
      <span v-else class="text-muted">Doesn't have Parent Category</span>
    </td>
    <td>{{ category.products_count }}</td>
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
