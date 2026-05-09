<script setup lang="ts">
import { CContainer } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';

const props = defineProps<{
    sm?: boolean;
    md?: boolean;
    lg?: boolean;
    xl?: boolean;
    xxl?: boolean;
    fluid?: boolean;
    class?: HTMLAttributes['class'];
}>();

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CContainer
        data-slot="container"
        v-bind="delegatedProps"
        :class="props.class"
    >
        <slot />
    </CContainer>
</template>
