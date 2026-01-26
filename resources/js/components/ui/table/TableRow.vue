<script setup lang="ts">
import { CTableRow } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import { type HTMLAttributes } from 'vue';

const props = defineProps<{
    active?: boolean;
    align?: 'bottom' | 'middle' | 'top';
    class?: HTMLAttributes['class'];
}>();

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CTableRow
        data-slot="table-row"
        v-bind="delegatedProps"
        :class="props.class"
    >
        <slot />
    </CTableRow>
</template>
