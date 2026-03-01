<script setup lang="ts">
import { CToastHeader } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';

const props = defineProps<{
    closeButton?: boolean;
    class?: HTMLAttributes['class'];
}>();

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CToastHeader
        data-slot="toast-header"
        v-bind="delegatedProps"
        :class="props.class"
    >
        <slot/>
    </CToastHeader>
</template>
