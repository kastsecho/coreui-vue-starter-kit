<script setup lang="ts">
import { CSpinner } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';
import type { CColor } from '@/types';

type Props = {
    color?: CColor;
    label?: string;
    size?: 'sm';
    variant?: 'border' | 'grow';
    visuallyHiddenLabel?: string;
    class?: HTMLAttributes['class'];
};

const props = withDefaults(defineProps<Props>(), {
    size: 'sm',
    variant: 'border',
    visuallyHiddenLabel: 'Loading',
});

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CSpinner
        data-slot="spinner"
        role="status"
        :aria-label="visuallyHiddenLabel"
        :class="props.class"
        v-bind="delegatedProps"
    />
</template>
