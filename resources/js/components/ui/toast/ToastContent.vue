<script setup lang="ts">
import { CToastBody } from '@coreui/vue';
import type { HTMLAttributes } from 'vue';

const props = defineProps<{
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <CToastBody
        data-slot="toast-content"
        :class="props.class"
    >
        <slot/>
    </CToastBody>
</template>
