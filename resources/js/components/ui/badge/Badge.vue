<script setup lang="ts">
import { CBadge } from '@coreui/vue';
import type { Colors, Shapes } from '@coreui/vue/src/types';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';
import type { TextColors } from '@/types';

type Props = {
    as?: string;
    color?: Colors;
    position?: 'top-start' | 'top-end' | 'bottom-end' | 'bottom-start';
    shape?: Shapes;
    size?: 'sm';
    textBgColor?: Colors;
    textColor?: TextColors;
    class?: HTMLAttributes['class'];
};

const props = withDefaults(defineProps<Props>(), {
    as: 'span',
});

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CBadge data-slot="badge" v-bind="delegatedProps" :class="props.class">
        <slot />
    </CBadge>
</template>
