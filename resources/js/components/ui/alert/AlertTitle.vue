<script setup lang="ts">
import { CAlertHeading } from '@coreui/vue';
import { type HTMLAttributes } from 'vue';

const props = defineProps<{
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <CAlertHeading
        data-slot="alert-title"
        :class="props.class"
    >
        <slot />
    </CAlertHeading>
</template>
