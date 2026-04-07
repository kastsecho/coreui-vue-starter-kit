<script setup lang="ts">
import { CTableHead } from '@coreui/vue';
import type { HTMLAttributes } from 'vue';
import type { CColor } from '@/types';

const props = defineProps<{
    color?: CColor;
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <CTableHead data-slot="table-header" :class="props.class" :color="color">
        <slot />
    </CTableHead>
</template>
