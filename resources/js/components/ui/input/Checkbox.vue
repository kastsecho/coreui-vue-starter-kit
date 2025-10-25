<script setup lang="ts">
import { CFormCheck } from '@coreui/vue';
import type { HTMLAttributes } from 'vue';

const props = defineProps<{
    label?: string;
    class?: HTMLAttributes['class'];
}>();

const modelValue = defineModel<boolean|string[]>();
</script>

<template>
    <CFormCheck
        v-model="modelValue"
        data-slot="checkbox"
        :class="props.class"
        :label="label"
    />
</template>
