<script setup lang="ts">
import { CHeaderToggler } from '@coreui/vue';
import type { HTMLAttributes } from 'vue';

const props = defineProps<{
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <CHeaderToggler
        data-slot="sidebar-rail"
        :class="props.class"
    >
        <slot />
    </CHeaderToggler>
</template>
