<script setup lang="ts">
import { CCardTitle } from '@coreui/vue';
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
    <CCardTitle
        data-slot="card-title"
        v-bind="delegatedProps"
        :class="props.class"
    >
        <slot />
    </CCardTitle>
</template>
