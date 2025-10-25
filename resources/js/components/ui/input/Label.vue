<script setup lang="ts">
import { CFormLabel } from '@coreui/vue';
import type { HTMLAttributes } from 'vue';

const props = defineProps<{
    customClassName?: HTMLAttributes['class'];
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <CFormLabel
        data-slot="label"
        :class="props.class"
        :custom-class-name="customClassName"
    >
        <slot/>
    </CFormLabel>
</template>
