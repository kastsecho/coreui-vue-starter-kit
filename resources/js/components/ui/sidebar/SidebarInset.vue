<script setup lang="ts">
import { cn } from '@/lib/utils';
import type { HTMLAttributes } from 'vue';

const props = defineProps<{
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <div
        data-slot="sidebar-inset"
        :class="cn('wrapper d-flex flex-column min-vh-100', props.class)"
    >
        <slot/>
    </div>
</template>
