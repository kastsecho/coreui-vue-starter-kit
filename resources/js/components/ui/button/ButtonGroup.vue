<script setup lang="ts">
import { CButtonGroup } from '@coreui/vue';
import type { HTMLAttributes } from 'vue';

const props = defineProps<{
    size?: 'sm' | 'lg';
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <CButtonGroup
        data-slot="button-group"
        v-bind="props"
        :class="props.class"
    >
        <slot/>
    </CButtonGroup>
</template>
