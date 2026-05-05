<script setup lang="ts">
import { CToast } from '@coreui/vue';
import type { Colors } from '@coreui/vue/src/types';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';

type Props = {
    autohide?: boolean;
    color?: Colors;
    delay?: number;
    dismissible?: boolean;
    index?: number;
    title?: string;
    visible?: boolean;
    class?: HTMLAttributes['class'];
};

const props = withDefaults(defineProps<Props>(), {
    autohide: true,
    delay: 5000,
    dismissible: true,
});

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CToast data-slot="toast" v-bind="delegatedProps" :class="props.class">
        <slot />
    </CToast>
</template>
