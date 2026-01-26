<script setup lang="ts">
import { type HTMLAttributes } from 'vue';
import { cn } from '@/lib/utils';

const props = defineProps<{
    align?: 'start' | 'center' | 'end';
    size?: 'sm' | 'lg';
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <ul
        data-slot="pagination"
        :class="cn('mb-0 pagination', {
            [`justify-content-${props.align}`]: props.align,
            [`pagination-${props.size}`]: props.size,
        }, props.class)"
    >
        <slot/>
    </ul>
</template>
