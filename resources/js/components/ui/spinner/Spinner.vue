<script setup lang="ts">
import { CSpinner } from '@coreui/vue';
import type { Colors } from '@coreui/vue/src/types';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';

type Props = {
    color?: Colors;
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
        v-bind="delegatedProps"
        :aria-label="visuallyHiddenLabel"
        :class="props.class"
    />
</template>
