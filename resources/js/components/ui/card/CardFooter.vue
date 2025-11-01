<script setup lang="ts">
import { CCardFooter } from '@coreui/vue';
import type { HTMLAttributes } from 'vue';

const props = defineProps<{
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <CCardFooter
        data-slot="card-footer"
        :class="props.class"
    >
        <slot/>
    </CCardFooter>
</template>
