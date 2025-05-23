<script setup lang="ts">
import { CFormInput } from '@coreui/vue';
import { onMounted, ref, watch } from 'vue';

const emit = defineEmits(['complete']);
const passcode = defineModel<string>();
const props = defineProps<{
    length: number;
    invalid?: boolean;
}>();

const container = ref<HTMLElement>();
const inputs = ref<NodeListOf<HTMLInputElement>>();
const pin = ref<string[]>(Array(props.length).fill(''));

const handleKeydown = (event: KeyboardEvent, index: number) => {
    if (event.key === 'Backspace') {
        if (!pin.value[index] && index > 0) {
            event.preventDefault();
            inputs.value?.[index - 1]?.focus();
        }
    }
};

watch(
    () => passcode.value,
    (newValue) => {
        if (!inputs.value) return;

        if (!newValue) pin.value = Array(props.length).fill('');

        pin.value.forEach((val, i) => {
            if (val.length === 1 && inputs.value?.[i + 1]) inputs.value[i + 1].focus();
        });
    },
);

watch(
    () => props.invalid,
    (newValue) => {
        if (newValue) {
            inputs.value?.[0]?.focus();
            passcode.value = '';
        }
    },
);

onMounted(() => {
    if (!container.value) return;

    inputs.value = container.value.querySelectorAll('input');
});
</script>

<template>
    <div ref="container" class="d-flex justify-content-center gap-2">
        <CFormInput
            v-for="(_, index) in length"
            :key="index"
            :index="index"
            v-model="pin[index]"
            type="text"
            class="bg-body-secondary text-center border-2 border-secondary-subtle"
            autocomplete="one-time-code"
            placeholder="o"
            maxlength="1"
            @keydown="handleKeydown($event, index)"
            @update:modelValue="emit('complete', pin)"
        />
    </div>
</template>
