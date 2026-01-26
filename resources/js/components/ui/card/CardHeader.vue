<script setup lang="ts">
import { CCardHeader } from '@coreui/vue';
import { type HTMLAttributes } from 'vue';

const props = defineProps<{
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <CCardHeader
        data-slot="card-header"
        :class="props.class"
    >
        <slot />
    </CCardHeader>
</template>
