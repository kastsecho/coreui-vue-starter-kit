<script setup lang="ts">
import { Input } from '@/components/ui/input';
import type { HTMLAttributes } from 'vue';

const emit = defineEmits(['complete']);

const props = defineProps<{
    index: number;
    disabled?: boolean;
    placeholder?: string;
    invalid?: boolean;
    class?: HTMLAttributes['class'];
}>();

const pin = defineModel<string>();
</script>

<template>
    <Input
        data-slot="pin-input-slot"
        v-model="pin"
        :class="props.class"
        type="text"
        autocomplete="one-time-code"
        inputmode="numeric"
        :tabindex="index"
        maxlength="1"
        :disabled="disabled"
        :placeholder="placeholder"
        @handleKeydown="emit('complete', pin)"
        @update:modelValue="emit('complete', pin)"
    />
</template>
