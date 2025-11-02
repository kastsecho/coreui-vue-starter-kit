<script setup lang="ts">
import { cn } from '@/lib/utils';
import type { HTMLAttributes } from 'vue';

const props = defineProps<{
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <p
        data-slot="dialog-description"
        :class="cn('mb-0 small text-muted', props.class)"
    >
        <slot />
    </p>
</template>
