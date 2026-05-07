<script setup lang="ts">
type Props = {
    title: string;
    description?: string;
    variant?: 'default' | 'small';
};

withDefaults(defineProps<Props>(), {
    variant: 'default',
});
</script>

<template>
    <header class="d-grid gap-1">
        <h2
            :class="
                variant === 'small'
                    ? 'fs-5 fw-medium mb-0'
                    : 'fs-4 fw-semibold mb-0'
            "
        >
            {{ title }}
        </h2>
        <p v-if="description" class="text-muted mb-0">
            {{ description }}
        </p>
    </header>
</template>
