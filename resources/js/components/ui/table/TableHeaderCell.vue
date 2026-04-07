<script setup lang="ts">
import { CTableHeaderCell } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';
import type { CColor } from '@/types';

const props = defineProps<{
    color?: CColor;
    class?: HTMLAttributes['class'];
}>();

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CTableHeaderCell
        data-slot="table-header-cell"
        v-bind="delegatedProps"
        :class="props.class"
    >
        <slot />
    </CTableHeaderCell>
</template>
