<script setup lang="ts">
import { CCardHeader } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';

type Props = {
    as?: string;
    class?: HTMLAttributes['class'];
};

const props = withDefaults(defineProps<Props>(), {
    as: 'div',
});

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CCardHeader
        data-slot="card-header"
        v-bind="delegatedProps"
        :class="props.class"
    >
        <slot />
    </CCardHeader>
</template>
