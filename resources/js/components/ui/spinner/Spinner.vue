<script setup lang="ts">
import { CSpinner } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';
import type { Color } from '@/types';

type Props = {
    color?: Exclude<Color, 'link' | 'transparent'>;
    label?: string;
    size?: 'sm';
    variant?: 'border' | 'grow';
    visuallyHiddenLabel?: string;
    class?: HTMLAttributes['class'];
};

const props = withDefaults(defineProps<Props>(), {
    size: 'sm',
    variant: 'border',
    visuallyHiddenLabel: 'Loading...',
});

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CSpinner
        data-slot="spinner"
        role="status"
        aria-label="Loading"
        v-bind="delegatedProps"
        :class="props.class"
    />
</template>
