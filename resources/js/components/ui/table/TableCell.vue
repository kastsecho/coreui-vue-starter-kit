<script setup lang="ts">
import { CTableDataCell } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import { type HTMLAttributes } from 'vue';
import { type Color } from '@/types';

const props = defineProps<{
    active?: boolean;
    align?: 'bottom' | 'middle' | 'top';
    color?: Color;
    class?: HTMLAttributes['class'];
}>();

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CTableDataCell
        data-slot="table-cell"
        v-bind="delegatedProps"
        :class="props.class"
    >
        <slot />
    </CTableDataCell>
</template>
