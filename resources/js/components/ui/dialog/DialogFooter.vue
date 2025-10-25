<script setup lang="ts">
import { CModalFooter } from '@coreui/vue';
import type { HTMLAttributes } from 'vue';

const props = defineProps<{
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <CModalFooter
        data-slot="dialog-footer"
        :class="props.class"
    >
        <slot/>
    </CModalFooter>
</template>
