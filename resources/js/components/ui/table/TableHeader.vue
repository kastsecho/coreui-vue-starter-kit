<script setup lang="ts">
import type { Color } from '@/types/coreui';
import { CTableHead } from '@coreui/vue';
import type { HTMLAttributes } from 'vue';

const props = defineProps<{
    color?: Color;
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <CTableHead
        data-slot="table-header"
        :class="props.class"
        :color="color"
    >
        <slot />
    </CTableHead>
</template>
