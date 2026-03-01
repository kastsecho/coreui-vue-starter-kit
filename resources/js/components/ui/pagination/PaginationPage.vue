<script setup lang="ts">
import { CPaginationItem } from '@coreui/vue';
import type { HTMLAttributes } from 'vue';

const props = defineProps<{
    active?: boolean;
    disabled?: boolean;
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <CPaginationItem
        data-slot="pagination-page"
        v-bind="props"
        :class="props.class"
    >
        <slot/>
    </CPaginationItem>
</template>
