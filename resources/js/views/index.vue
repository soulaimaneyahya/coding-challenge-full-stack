<template>
    <div>
        <Nav class="py-3 shadow-sm bg-white" />
        <RouterView class="py-3 container mx-auto" />
    </div>
</template>

<script>
import Nav from './partials/Nav.vue';
export default {
    components: { Nav }
}
</script>
