<script setup lang="ts">
import { CModalTitle } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';

const props = defineProps<{
    as?: string;
    class?: HTMLAttributes['class'];
}>();

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CModalTitle
        data-slot="dialog-title"
        v-bind="delegatedProps"
        :class="props.class"
    >
        <slot />
    </CModalTitle>
</template>
