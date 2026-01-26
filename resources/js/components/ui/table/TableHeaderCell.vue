<script setup lang="ts">
import { CTableHeaderCell } from '@coreui/vue';
import { type HTMLAttributes } from 'vue';
import { type Color } from '@/types/coreui';

const props = defineProps<{
    color?: Color;
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <CTableHeaderCell
        data-slot="table-header-cell"
        :color="color"
        :class="props.class"
    >
        <slot />
    </CTableHeaderCell>
</template>
