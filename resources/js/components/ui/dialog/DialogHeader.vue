<script setup lang="ts">
import { CModalHeader } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';

type Props = {
    closeButton?: boolean;
    class?: HTMLAttributes['class'];
};

const props = withDefaults(defineProps<Props>(), {
    closeButton: false,
});

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CModalHeader
        data-slot="dialog-header"
        :class="props.class"
        v-bind="delegatedProps"
    >
        <slot />
    </CModalHeader>
</template>
