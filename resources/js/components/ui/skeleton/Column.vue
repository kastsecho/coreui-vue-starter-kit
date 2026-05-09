<script setup lang="ts">
import { CCol } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';

type Span = 'auto' | number | string | boolean | null;

type BPObject = {
    span?: Span;
    offset?: number | string | null;
    order?: 'first' | 'last' | number | string | null;
};

type Columns = Span | BPObject;

const props = defineProps<{
    xs?: Columns;
    sm?: Columns;
    md?: Columns;
    lg?: Columns;
    xl?: Columns;
    xxl?: Columns;
    class?: HTMLAttributes['class'];
}>();

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CCol data-slot="column" v-bind="delegatedProps" :class="props.class">
        <slot />
    </CCol>
</template>
