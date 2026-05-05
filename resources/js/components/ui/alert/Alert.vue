<script setup lang="ts">
import { CAlert } from '@coreui/vue';
import type { Colors } from '@coreui/vue/src/types';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';

type Props = {
    color?: Colors;
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
    <CAlert data-slot="alert" v-bind="delegatedProps" :class="props.class">
        <slot />
    </CAlert>
</template>
