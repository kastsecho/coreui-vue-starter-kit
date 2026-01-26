<script setup lang="ts">
import { reactiveOmit } from '@vueuse/core';
import { type HTMLAttributes } from 'vue';
import type { OTPInputEmits, OTPInputProps } from 'vue-input-otp';
import { OTPInput } from 'vue-input-otp';

const props = defineProps<OTPInputProps & {
    class?: HTMLAttributes['class'];
}>();

const emit = defineEmits<OTPInputEmits & {
    (e: 'update:modelValue', value: any): void
}>();

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <OTPInput
        data-slot="input-otp"
        v-bind="delegatedProps"
        v-slot="slotProps"
        :container-class="props.class"
        @complete="(v) => emit('complete', v)"
        @update:modelValue="(v) => emit('update:modelValue', v)"
    >
        <slot v-bind="slotProps" />
    </OTPInput>
</template>
