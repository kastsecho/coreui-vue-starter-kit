<script setup lang="ts">
import type { HTMLAttributes } from 'vue';
import { cn } from '@/lib/utils';

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
