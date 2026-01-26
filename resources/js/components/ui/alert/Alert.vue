<script setup lang="ts">
import { CAlert } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import { type HTMLAttributes } from 'vue';
import { type Color } from '@/types';

type Props = {
    color: Color;
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
        v-bind="delegatedProps"
        :class="props.class"
    >
        <slot />
    </CAlert>
</template>
