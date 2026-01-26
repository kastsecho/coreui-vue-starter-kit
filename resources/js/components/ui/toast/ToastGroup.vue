<script setup lang="ts">
import { CToaster } from '@coreui/vue';
import { type HTMLAttributes } from 'vue';

type Placement =
    | 'top-start'
    | 'top-center'
    | 'top-end'
    | 'middle-start'
    | 'middle-center'
    | 'middle-end'
    | 'bottom-start'
    | 'bottom-center'
    | 'bottom-end';

const props = defineProps<{
    placement?: Placement;
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <CToaster
        data-slot="toast-content"
        :placement="placement"
        :class="props.class"
    >
        <slot/>
    </CToaster>
</template>
