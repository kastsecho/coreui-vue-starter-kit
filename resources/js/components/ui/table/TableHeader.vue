<script setup lang="ts">
import { CTableHead } from '@coreui/vue';
import { type HTMLAttributes } from 'vue';
import { type Color } from '@/types/coreui';

const props = defineProps<{
    color?: Color;
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <CTableHead
        data-slot="table-header"
        :color="color"
        :class="props.class"
    >
        <slot />
    </CTableHead>
</template>
