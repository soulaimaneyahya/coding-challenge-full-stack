<template>
    <div>
      <div class="font-bold text-danger" v-for="(error, index) in errors" :key="index">{{ error }}</div>
    </div>
</template>
<script>
export default {
    props: ["errors"],
};
</script>
