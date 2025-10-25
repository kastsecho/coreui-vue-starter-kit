<script setup lang="ts">
defineProps<{
    title: string;
    description?: string;
}>();
</script>

<template>
    <header class="d-grid gap-1">
        <h3 class="mb-0 fs-5 fw-medium">{{ title }}</h3>
        <p v-if="description" class="mb-0 text-muted">
            {{ description }}
        </p>
    </header>
</template>
