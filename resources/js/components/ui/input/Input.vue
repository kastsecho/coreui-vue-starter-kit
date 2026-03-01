<script setup lang="ts">
import { CFormInput } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';

type Props = {
    floatingLabel?: string;
    invalid?: boolean;
    size?: 'sm' | 'lg';
    plainText?: boolean;
    valid?: boolean;
};

const props = defineProps<Props & {
    class?: HTMLAttributes['class'];
}>();

const modelValue = defineModel<string | number>();

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CFormInput
        v-model="modelValue"
        data-slot="input"
        v-bind="delegatedProps"
        :class="props.class"
    />
</template>
