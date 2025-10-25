<script setup lang="ts">
defineProps({});
</script>

<template>
    <div
        data-slot="sidebar-inset"
        class="wrapper d-flex flex-column min-vh-100"
    >
        <slot/>
    </div>
</template>
