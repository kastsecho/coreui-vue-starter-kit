<script setup lang="ts">
import { CModalTitle } from '@coreui/vue';
import type { HTMLAttributes } from 'vue';

const props = defineProps<{
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <CModalTitle
        data-slot="dialog-title"
        :class="props.class"
    >
        <slot/>
    </CModalTitle>
</template>
