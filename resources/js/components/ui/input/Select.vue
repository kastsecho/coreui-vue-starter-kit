<script setup lang="ts">
import { CFormSelect } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';

type Props = {
    floatingLabel?: string;
    invalid?: boolean;
    multiple?: boolean;
    options?: string[];
    size?: 'sm' | 'lg';
    plainText?: boolean;
    valid?: boolean;
};

const props = defineProps<Props & {
    class?: HTMLAttributes['class'];
}>();

const modelValue = defineModel<string | string[]>();

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CFormSelect
        v-model="modelValue"
        data-slot="select"
        v-bind="delegatedProps"
        :class="props.class"
    >
        <slot />
    </CFormSelect>
</template>
