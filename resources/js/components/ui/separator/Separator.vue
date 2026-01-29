<script setup lang="ts">
import { type HTMLAttributes } from 'vue';
import { cn } from '@/lib/utils';
import type { Spacing, TextColor } from '@/types';

type Props = {
    color?: TextColor;
    spacing?: Spacing;
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
        class="d-flex w-100 align-items-center justify-content-center"
        :class="props.class"
        role="separator"
    >
        <hr class="flex-grow-1" aria-hidden="true" />
        <span
            :class="cn(
                `text-${props.color}`,
                `px-${props.spacing}`,
                'fw-semibold small',
            )"
        >
            <slot />
        </span>
        <hr class="flex-grow-1" aria-hidden="true" />
    </div>
</template>
