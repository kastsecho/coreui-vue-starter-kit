<script setup lang="ts">
import type { HTMLAttributes } from 'vue';
import { cn } from '@/lib/utils';
import type { CColor } from '@/types';

const props = defineProps<{
    name: string;
    color?: CColor;
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <span
        :class="
            cn(
                {
                    [`bi-${name}`]: name,
                    [`text-${color}`]: color,
                },
                props.class,
            )
        "
        aria-hidden="true"
    />
</template>
