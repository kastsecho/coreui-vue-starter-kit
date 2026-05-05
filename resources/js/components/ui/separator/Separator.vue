<script setup lang="ts">
import type { HTMLAttributes } from 'vue';
import { cn } from '@/lib/utils';
import type { TextColors } from '@/types';

type Props = {
    color?: TextColors;
    spacing?: number | string;
    class?: HTMLAttributes['class'];
};

const props = withDefaults(defineProps<Props>(), {
    color: 'body-emphasis',
    spacing: 4,
});
</script>

<template>
    <div
        data-slot="separator"
        role="separator"
        class="d-flex align-items-center justify-content-center w-100"
        :class="props.class"
    >
        <hr class="flex-grow-1" aria-hidden="true" />
        <span
            :class="
                cn(
                    `text-${props.color}`,
                    `px-${props.spacing}`,
                    'fw-semibold small',
                )
            "
        >
            <slot />
        </span>
        <hr class="flex-grow-1" aria-hidden="true" />
    </div>
</template>
