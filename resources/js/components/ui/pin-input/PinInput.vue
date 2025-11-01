<script setup lang="ts">
import { computed, type HTMLAttributes, onMounted, ref, watch } from 'vue';

const props = defineProps<{
    class?: HTMLAttributes['class'];
}>();

const code = defineModel<number[]>({ default: [] });
const codeValue = computed<string>(() => code.value.join(''));
const container = ref<HTMLElement>();
const inputs = ref<NodeListOf<HTMLInputElement>>();

const focusSlot = (index: number) => {
    if (!inputs.value?.[index]) return;

    inputs.value[index].focus();
};

watch(() => codeValue.value, (value: string, oldValue: string) => {
    if (value.length === 0) return;

    value.length > oldValue.length
        ? focusSlot(value.length)
        : focusSlot(value.length - 1);
});

onMounted(() => {
    if (!container.value) return;

    inputs.value = container.value
        .querySelectorAll('input[data-slot="pin-input-slot"]');
    focusSlot(0);
});
</script>

<template>
    <div
        data-slot="pin-input"
        ref="container"
        :class="props.class"
    >
        <slot />
    </div>
</template>
