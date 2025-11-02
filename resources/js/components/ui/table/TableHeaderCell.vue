<script setup lang="ts">
import type { Color } from '@/types/coreui';
import { CTableHeaderCell } from '@coreui/vue';
import type { HTMLAttributes } from 'vue';

const props = defineProps<{
    color?: Color;
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <CTableHeaderCell
        data-slot="table-header-cell"
        :class="props.class"
        :color="color"
    >
        <slot />
    </CTableHeaderCell>
</template>
