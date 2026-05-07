<script setup lang="ts">
import { CFormInput, CFormSelect } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';

type Option = {
    disabled?: boolean;
    label?: string;
    selected?: boolean;
    value?: string;
};

const props = defineProps<{
    feedback?: string;
    feedbackInvalid?: string;
    feedbackValid?: string;
    floatingLabel?: string;
    htmlSize?: number;
    id?: string;
    invalid?: boolean;
    label?: string;
    multiple?: boolean;
    options?: Option[] | string[];
    size?: 'sm' | 'lg';
    text?: string;
    tooltipFeedback?: boolean;
    valid?: boolean;
    class?: HTMLAttributes['class'];
}>();

const modelValue = defineModel<string | string[]>();

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CFormSelect
        data-slot="select"
        v-bind="delegatedProps"
        v-model="modelValue"
        :class="props.class"
    >
        <slot />
    </CFormSelect>
</template>
