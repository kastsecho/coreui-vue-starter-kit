<script setup lang="ts">
import { cn } from '@/lib/utils';
import type { HTMLAttributes } from 'vue';

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
