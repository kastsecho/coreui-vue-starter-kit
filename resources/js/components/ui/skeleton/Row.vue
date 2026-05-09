<script setup lang="ts">
import { CRow } from '@coreui/vue';
import type { BPObject } from '@coreui/vue/src/components/grid/CRow';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';

const props = defineProps<{
    xs?: BPObject;
    sm?: BPObject;
    md?: BPObject;
    lg?: BPObject;
    xl?: BPObject;
    xxl?: BPObject;
    class?: HTMLAttributes['class'];
}>();

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CRow data-slot="row" v-bind="delegatedProps" :class="props.class">
        <slot />
    </CRow>
</template>
