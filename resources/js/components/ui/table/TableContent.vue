<script setup lang="ts">
import { CTableBody } from '@coreui/vue';
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
    <CTableBody
        data-slot="table-content"
        v-bind="delegatedProps"
        :class="props.class"
    >
        <slot />
    </CTableBody>
</template>
