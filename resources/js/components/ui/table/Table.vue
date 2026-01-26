<script setup lang="ts">
import { ColumnItem } from '@/types';
import { CTable } from '@coreui/vue';
import type { HTMLAttributes } from 'vue';

const props = defineProps<{
    align?: 'bottom' | 'middle' | 'top';
    columns?: ColumnItem[]|string[];
    small?: boolean;
    striped?: boolean;
    stripedColumns?: boolean;
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <CTable
        data-slot="table"
        v-bind="props"
        :class="props.class"
    >
        <slot />
    </CTable>
</template>
