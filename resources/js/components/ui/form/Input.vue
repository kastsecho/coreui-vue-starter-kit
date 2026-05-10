<script setup lang="ts">
import { CFormInput } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';

type Props = {
    disabled?: boolean;
    feedback?: string;
    feedbackInvalid?: string;
    feedbackValid?: string;
    floatingLabel?: string;
    id?: string;
    invalid?: boolean;
    label?: string;
    plainText?: boolean;
    readonly?: boolean;
    size?: 'sm' | 'lg';
    text?: string;
    tooltipFeedback?: boolean;
    type?: 'color' | 'file' | 'text' | string;
    valid?: boolean;
    class?: HTMLAttributes['class'];
};

const props = withDefaults(defineProps<Props>(), {
    type: 'text',
});

const File =
    typeof window === 'undefined' ? class File extends Object {} : window.File;

const modelValue = defineModel<typeof File | number | string>();

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CFormInput
        data-slot="input"
        v-bind="delegatedProps"
        v-model="modelValue"
        :class="props.class"
    />
</template>
