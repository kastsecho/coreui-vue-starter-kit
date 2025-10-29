<script setup lang="ts">
import { CInputGroup } from '@coreui/vue';
import type { HTMLAttributes } from 'vue';

const props = defineProps<{
    size?: 'sm' | 'lg';
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <CInputGroup
        data-slot="label"
        :class="props.class"
        :size="size"
    >
        <slot/>
    </CInputGroup>
</template>
