<script setup lang="ts">
import { CFormLabel } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';

const props = defineProps<{
    customClassName?: string | string[];
    class?: HTMLAttributes['class'];
}>();

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CFormLabel
        data-slot="label"
        :class="props.class"
        v-bind="delegatedProps"
    >
        <slot />
    </CFormLabel>
</template>
