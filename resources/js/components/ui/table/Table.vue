<script setup lang="ts">
import { CTable } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import { type HTMLAttributes } from 'vue';
import { type TableColumn } from '@/types';

const props = defineProps<{
    align?: 'bottom' | 'middle' | 'top';
    columns?: TableColumn[]|string[];
    small?: boolean;
    striped?: boolean;
    stripedColumns?: boolean;
    class?: HTMLAttributes['class'];
}>();

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CTable
        data-slot="table"
        v-bind="delegatedProps"
        :class="props.class"
    >
        <slot />
    </CTable>
</template>
