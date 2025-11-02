<script setup lang="ts">
import { CSpinner } from '@coreui/vue';
import type { HTMLAttributes } from 'vue';

type Color =
    | 'primary'
    | 'secondary'
    | 'success'
    | 'danger'
    | 'warning'
    | 'info'
    | 'dark'
    | 'light';

interface Props {
    color?: Color;
    label?: string;
    size?: 'sm';
    variant?: 'border' | 'grow';
    class?: HTMLAttributes['class'];
}

const props = withDefaults(defineProps<Props>(), {
    label: 'Loading...',
});
</script>

<template>
    <CSpinner
        data-slot="toast"
        role="status"
        :class="props.class"
        v-bind="props"
        :visuallyHiddenLabel="label"
    >
        <slot/>
    </CSpinner>
</template>
