<script setup lang="ts">
import { CBadge } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import { type HTMLAttributes } from 'vue';
import type { Color, Shape, TextColor } from '@/types';

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

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CBadge
        data-slot="badge"
        v-bind="delegatedProps"
        :class="props.class"
    >
        <slot />
    </CBadge>
</template>
