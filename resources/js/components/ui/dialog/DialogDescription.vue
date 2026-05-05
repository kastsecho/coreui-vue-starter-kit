<script setup lang="ts">
import type { HTMLAttributes } from 'vue';
import { cn } from '@/lib/utils';

const props = defineProps<{
    color?: string;
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <p
        data-slot="dialog-description"
        :class="
            cn(
                'small fw-medium mb-0',
                {
                    [`text-${color}`]: color,
                },
                props.class,
            )
        "
    >
        <slot />
    </p>
</template>
