<script setup lang="ts">
import { computed, type HTMLAttributes } from 'vue';

interface Props {
    variant?: 'header' | 'sidebar';
    class?: HTMLAttributes['class'];
}

const props = defineProps<Props>();
const className = computed(() => props.class);
</script>

<template>
    <div v-if="variant === 'sidebar'" :class="className">
        <slot />
    </div>
    <div v-else class="d-flex min-vh-100 w-100 flex-column" :class="className">
        <slot />
    </div>
</template>
