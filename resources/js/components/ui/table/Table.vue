<script setup lang="ts">
import { CTable } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';
import type { CTableColumn } from '@/types';

const props = defineProps<{
    align?: 'bottom' | 'middle' | 'top';
    columns?: CTableColumn[] | string[];
    small?: boolean;
    striped?: boolean;
    stripedColumns?: boolean;
    class?: HTMLAttributes['class'];
}>();

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CTable data-slot="table" :class="props.class" v-bind="delegatedProps">
        <slot />
    </CTable>
</template>
