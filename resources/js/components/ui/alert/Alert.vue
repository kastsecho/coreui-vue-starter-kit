<script setup lang="ts">
import type { Color } from '@/types/coreui';
import { CAlert } from '@coreui/vue';
import type { HTMLAttributes } from 'vue';

interface Props {
    color: Color;
    dismissible?: boolean;
    variant?: 'solid';
    visible?: boolean;
    class?: HTMLAttributes['class'];
}

const props = withDefaults(defineProps<Props>(), {
    visible: true,
});
</script>

<template>
    <CAlert
        data-slot="alert"
        role="alert"
        v-bind="props"
        :color="color"
    >
        <slot />
    </CAlert>
</template>
