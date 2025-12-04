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
        :class="props.class"
        v-bind="props"
    >
        <slot/>
    </CPaginationItem>
</template>
