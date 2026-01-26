<script setup lang="ts">
import type { HTMLAttributes } from 'vue';
import { cn } from '@/lib/utils';

const props = defineProps<{
  class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <main
        data-slot="sidebar-inset"
        :class="cn('wrapper d-flex flex-column min-vh-100', props.class)"
    >
        <slot />
    </main>
</template>
