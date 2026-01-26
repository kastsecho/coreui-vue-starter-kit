<script setup lang="ts">
import { CToast } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import { type HTMLAttributes } from 'vue';
import { type Color } from '@/types';

type Props = {
    autohide?: boolean;
    delay?: number;
    color?: Color;
    dismissible?: boolean;
    visible?: boolean;
    class?: HTMLAttributes['class'];
};

const props = withDefaults(defineProps<Props>(), {
    autohide: true,
    delay: 5000,
    visible: true,
});

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CToast
        data-slot="toast"
        v-bind="delegatedProps"
        :class="props.class"
    >
        <slot/>
    </CToast>
</template>
