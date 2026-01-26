<script setup lang="ts">
import { CCardBody } from '@coreui/vue';
import { type HTMLAttributes } from 'vue';

const props = defineProps<{
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <CCardBody
        data-slot="card-content"
        :class="props.class"
    >
        <slot />
    </CCardBody>
</template>
