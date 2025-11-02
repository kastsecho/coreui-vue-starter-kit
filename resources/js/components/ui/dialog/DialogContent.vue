<script setup lang="ts">
import { CModalBody } from '@coreui/vue';
import type { HTMLAttributes } from 'vue';

const props = defineProps<{
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <CModalBody
        data-slot="dialog-content"
        :class="props.class"
    >
        <slot/>
    </CModalBody>
</template>
