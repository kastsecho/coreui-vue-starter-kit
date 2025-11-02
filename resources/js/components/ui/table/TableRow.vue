<script setup lang="ts">
import { CTableRow } from '@coreui/vue';
import type { HTMLAttributes } from 'vue';

const props = defineProps<{
    active?: boolean;
    align?: 'bottom' | 'middle' | 'top';
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <CTableRow
        data-slot="table-row"
        v-bind="props"
        :class="props.class"
    >
        <slot />
    </CTableRow>
</template>
