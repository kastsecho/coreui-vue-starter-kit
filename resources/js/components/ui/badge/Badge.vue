<script setup lang="ts">
import { Color, Shape, TextColor } from '@/types/coreui';
import type { HTMLAttributes } from 'vue';
import { CBadge } from '@coreui/vue';

const props = defineProps<{
    as?: string;
    color?: Color;
    position?: 'top-start' | 'top-end' | 'bottom-end' | 'bottom-start';
    shape?: Shape;
    size?: 'sm';
    textBgColor?: Color;
    textColor?: TextColor;
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <CBadge
        data-slot="badge"
        v-bind="props"
        :class="props.class"
    >
        <slot />
    </CBadge>
</template>
