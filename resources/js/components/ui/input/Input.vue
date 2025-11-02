<script setup lang="ts">
import { CFormInput } from '@coreui/vue';
import type { HTMLAttributes } from 'vue';

interface Props {
    floatingLabel?: string;
    invalid?: boolean;
    size?: 'sm' | 'lg';
    plainText?: boolean;
    valid?: boolean;
    class?: HTMLAttributes['class'];
}

const props = defineProps<Props>();

const modelValue = defineModel<number|string>();
</script>

<template>
    <CFormInput
        v-model="modelValue"
        data-slot="input"
        v-bind="props"
        :class="props.class"
    />
</template>
