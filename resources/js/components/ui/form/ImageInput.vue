<script setup lang="ts">
import { useTemplateRef } from 'vue';
import type { HTMLAttributes } from 'vue';

const emit = defineEmits(['loaded']);

const props = defineProps<{
    class?: HTMLAttributes['class'];
}>();

const inputRef = useTemplateRef('inputRef');

const onChange = (e: any) => {
    if (!e.target.files.length) {
        return;
    }

    const file = e.target.files[0];

    if (!file || !file.type.startsWith('image/')) {
        return;
    }

    const reader = new FileReader();
    reader.readAsDataURL(file);

    reader.onload = (e) => {
        const src = e.target?.result;

        emit('loaded', { src, file });
    };
};

const reset = () => {
    if (inputRef.value) {
        inputRef.value.value = '';
    }
};

defineExpose({
    $el: inputRef,
    click: () => inputRef.value?.click(),
    reset: () => reset(),
});
</script>

<template>
    <input
        ref="inputRef"
        type="file"
        :class="props.class"
        accept="image/*"
        @change="onChange"
    />
</template>
