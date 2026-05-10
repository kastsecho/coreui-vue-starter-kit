<script setup lang="ts">
import { CModalTitle } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';

type Props = {
    as?: string;
    class?: HTMLAttributes['class'];
};

const props = withDefaults(defineProps<Props>(), {
    as: 'h5',
});

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
