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
        :close-button="closeButton"
        :class="props.class"
    >
        <slot/>
    </CToastHeader>
</template>
