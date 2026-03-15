<script setup lang="ts">
import { CAlert } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';
import type { CColor } from '@/types';

type Props = {
    color: CColor;
    dismissible?: boolean;
    variant?: 'solid';
    visible?: boolean;
    class?: HTMLAttributes['class'];
};

const props = withDefaults(defineProps<Props>(), {
    visible: true,
});

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CAlert
        data-slot="alert"
        role="alert"
        :class="props.class"
        v-bind="delegatedProps"
    >
        <slot />
    </CAlert>
</template>
