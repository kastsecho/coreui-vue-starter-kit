<script setup lang="ts">
import { CToastHeader } from '@coreui/vue';
import type { HTMLAttributes } from 'vue';

const props = defineProps<{
    closeButton?: boolean;
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <CToastHeader
        data-slot="toast-header"
        :class="props.class"
        :close-button="closeButton"
    >
        <slot/>
    </CToastHeader>
</template>
