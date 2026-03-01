<script setup lang="ts">
import { CCard } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';
import type { Color, TextColor } from '@/types';

const props = defineProps<{
    color?: Color;
    textColor?: Color;
    textBgColor?: TextColor;
    class?: HTMLAttributes['class'];
}>();

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CCard
        data-slot="card"
        v-bind="delegatedProps"
        :class="props.class"
    >
        <slot />
    </CCard>
</template>
