<script setup lang="ts">
import { CTableBody } from '@coreui/vue';
import { type HTMLAttributes } from 'vue';
import { type Color } from '@/types/coreui';

const props = defineProps<{
    color?: Color;
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <CTableBody
        data-slot="table-content"
        :color="color"
        :class="props.class"
    >
        <slot />
    </CTableBody>
</template>
