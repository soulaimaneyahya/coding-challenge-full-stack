<template>
  <tr>
    <td>
      <img :src="productImage" :alt="product.name" style="width: 70px; height: 70px; object-fit: cover;" class="img-fluid rounded" />
    </td>
    <td>{{ product.name }}</td>
    <td>{{ product.price }}$</td>
    <td>Added <span class="fw-bold">{{ product.created_at }} </span></td>
    <td />
  </tr>
</template>

<script>
export default {
  props: {
    product: Object,
  },
  computed: {
    productImage() {
      return this.product.image ? this.product.image.url : 'https://dummyimage.com/250x250/f7f7f7/8f8f8f.png'
    },
  },
}
</script>
