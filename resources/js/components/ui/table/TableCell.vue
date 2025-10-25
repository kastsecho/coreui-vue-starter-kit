<script setup lang="ts">
import type { Color } from '@/types/coreui';
import { CTableDataCell } from '@coreui/vue';
import type { HTMLAttributes } from 'vue';

const props = defineProps<{
    active?: boolean;
    align?: 'bottom' | 'middle' | 'top';
    color?: Color;
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <CTableDataCell
        data-slot="table-cell"
        v-bind="props"
        :class="props.class"
    >
        <slot />
    </CTableDataCell>
</template>
