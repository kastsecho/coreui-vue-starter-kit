<script setup lang="ts">
import { CFormCheck } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';

defineOptions({ inheritAttrs: false });

type Props = {
    button?: object;
    falseValue?: string;
    feedback?: string;
    feedbackInvalid?: string;
    feedbackValid?: string;
    hitArea?: 'full';
    id?: string;
    indeterminate?: boolean;
    inline?: boolean;
    invalid?: boolean;
    label?: string;
    reverse?: boolean;
    tooltipFeedback?: boolean;
    trueValue?: string;
    type?: 'checkbox' | 'radio';
    valid?: boolean;
    value?: string;
    class?: HTMLAttributes['class'];
};

const props = withDefaults(defineProps<Props>(), {
    type: 'checkbox',
});

const modelValue = defineModel<string[] | boolean | string>();

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CFormCheck
        data-slot="checkbox"
        v-bind="delegatedProps"
        v-model="modelValue"
        :class="props.class"
    />
</template>
