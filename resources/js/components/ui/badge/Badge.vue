<script setup lang="ts">
import { CBadge } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';
import type { CColor, CShape, CTextColor } from '@/types';

const props = defineProps<{
    as?: string;
    color?: CColor;
    position?: 'top-start' | 'top-end' | 'bottom-end' | 'bottom-start';
    shape?: CShape;
    size?: 'sm';
    textBgColor?: CColor;
    textColor?: CTextColor;
    class?: HTMLAttributes['class'];
}>();

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CBadge data-slot="badge" v-bind="delegatedProps" :class="props.class">
        <slot />
    </CBadge>
</template>
