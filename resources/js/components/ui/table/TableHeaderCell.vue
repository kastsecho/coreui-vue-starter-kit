<script setup lang="ts">
import { CTableHeaderCell } from '@coreui/vue';
import type { Colors } from '@coreui/vue/src/types';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';

const props = defineProps<{
    color?: Colors;
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
