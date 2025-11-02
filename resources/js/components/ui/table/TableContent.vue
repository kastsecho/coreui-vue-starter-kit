<script setup lang="ts">
import type { Color } from '@/types/coreui';
import { CTableBody } from '@coreui/vue';
import type { HTMLAttributes } from 'vue';

const props = defineProps<{
    color?: Color;
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <CTableBody
        data-slot="table-content"
        :class="props.class"
        :color="color"
    >
        <slot />
    </CTableBody>
</template>
