<script setup lang="ts">
import { CModalHeader } from '@coreui/vue';
import type { HTMLAttributes } from 'vue';

interface Props {
    closeButton?: boolean;
    class?: HTMLAttributes['class'];
}

const props = withDefaults(defineProps<Props>(), {
    closeButton: false,
});
</script>

<template>
    <CModalHeader
        data-slot="dialog-header"
        :class="props.class"
        :close-button="closeButton"
    >
        <slot/>
    </CModalHeader>
</template>
