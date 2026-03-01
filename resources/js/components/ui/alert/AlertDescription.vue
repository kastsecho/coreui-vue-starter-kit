<script setup lang="ts">
import type { HTMLAttributes } from 'vue';
import { cn } from '@/lib/utils';

const props = defineProps<{
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <p
        data-slot="alert-description"
        :class="cn('mb-0', props.class)"
    >
        <slot />
    </p>
</template>
