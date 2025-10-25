<script setup lang="ts">
import type { Color, Shape } from '@/types/coreui';
import { CButton } from '@coreui/vue';
import type { HTMLAttributes } from 'vue';

interface Props {
    active?: boolean;
    color?: Color;
    shape?: Shape;
    size?: 'sm' | 'lg';
    variant?: 'ghost' | 'outline';
    class?: HTMLAttributes['class'];
}

const props = withDefaults(defineProps<Props>(), {
    as: 'button',
    color: 'primary',
});
</script>

<template>
    <CButton
        data-slot="button"
        v-bind="props"
        :class="props.class"
    >
        <slot/>
    </CButton>
</template>
