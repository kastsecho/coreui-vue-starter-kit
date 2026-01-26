<script setup lang="ts">
import { CFormCheck } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import { type HTMLAttributes } from 'vue';

type CheckboxProps = {
    label?: string;
    indeterminate?: boolean;
    inline?: boolean;
    invalid?: boolean;
    reverse?: boolean;
    valid?: boolean;
};

const props = defineProps<CheckboxProps & {
    class?: HTMLAttributes['class'];
}>();

const modelValue = defineModel<string | boolean | string[]>();

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CFormCheck
        v-model="modelValue"
        data-slot="checkbox"
        v-bind="delegatedProps"
        :class="props.class"
    />
</template>
