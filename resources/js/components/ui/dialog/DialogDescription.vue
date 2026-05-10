<script setup lang="ts">
import type { HTMLAttributes } from 'vue';
import { cn } from '@/lib/utils';
import type { TextColors } from '@/types';

const props = defineProps<{
    textColor?: TextColors;
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
                    [`text-${textColor}`]: textColor,
                },
                props.class,
            )
        "
    >
        <slot />
    </p>
</template>
