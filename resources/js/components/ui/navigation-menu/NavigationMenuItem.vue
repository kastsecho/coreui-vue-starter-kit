<script setup lang="ts">
import { CNavItem } from '@coreui/vue';
import type { HTMLAttributes } from 'vue';

const props = defineProps<{
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <CNavItem
        data-slot="navigation-menu-item"
        :class="props.class"
    >
        <slot />
    </CNavItem>
</template>
