<script setup lang="ts">
defineProps<{
    title: string;
    description?: string;
}>();
</script>

<template>
    <div class="d-grid gap-1">
        <h2 class="mb-0 fs-4 fw-semibold">{{ title }}</h2>
        <p v-if="description" class="text-muted">
            {{ description }}
        </p>
    </div>
</template>
