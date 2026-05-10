<script setup lang="ts">
import { CTable } from '@coreui/vue';
import type {
    Column,
    FooterItem,
    Item,
} from '@coreui/vue/src/components/table/types';
import type { Colors } from '@coreui/vue/src/types';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';

const props = defineProps<{
    align?: 'bottom' | 'middle' | 'top';
    borderColor?: Colors;
    bordered?: boolean;
    borderless?: boolean;
    caption?: string;
    captionTop?: string;
    columns?: Column[] | string[];
    color?: Colors;
    footer?: FooterItem[] | string[];
    hover?: boolean;
    items?: Item[];
    responsive?: boolean | 'sm' | 'md' | 'lg' | 'xl' | 'xxl';
    small?: boolean;
    striped?: boolean;
    stripedColumns?: boolean;
    tableFootProps?: object;
    tableHeadProps?: object;
    class?: HTMLAttributes['class'];
}>();

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CTable data-slot="table" v-bind="delegatedProps" :class="props.class">
        <slot />
    </CTable>
</template>
