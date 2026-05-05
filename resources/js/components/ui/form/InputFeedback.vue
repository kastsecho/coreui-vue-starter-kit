<script setup lang="ts">
import { CFormFeedback } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';

type Props = {
    as?: string;
    invalid?: boolean;
    message?: string;
    tooltip?: boolean;
    valid?: boolean;
    class?: HTMLAttributes['class'];
};

const props = withDefaults(defineProps<Props>(), {
    as: 'div',
});

const delegatedProps = reactiveOmit(props, 'message', 'class');
</script>

<template>
    <CFormFeedback
        data-slot="input-feedback"
        v-bind="delegatedProps"
        v-show="message"
        :class="props.class"
    >
        <strong>{{ message }}</strong>
    </CFormFeedback>
</template>
