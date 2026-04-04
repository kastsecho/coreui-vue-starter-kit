<script setup lang="ts">
import { CFormCheck } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';

type Props = {
    label?: string;
    indeterminate?: boolean;
    inline?: boolean;
    invalid?: boolean;
    reverse?: boolean;
    valid?: boolean;
    class?: HTMLAttributes['class'];
};

const props = defineProps<Props>();

const modelValue = defineModel<string | boolean | string[]>();
const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CFormCheck
        v-model="modelValue"
        data-slot="checkbox"
        :class="props.class"
        v-bind="delegatedProps"
    />
</template>
