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
                    ? 'mb-0 fs-5 fw-medium'
                    : 'mb-0 fs-4 fw-semibold'
            "
        >
            {{ title }}
        </h2>
        <p v-if="description" class="mb-0 text-muted">
            {{ description }}
        </p>
    </header>
</template>
