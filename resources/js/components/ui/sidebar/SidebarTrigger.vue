<script setup lang="ts">
import { CSidebarToggler } from '@coreui/vue';
import type { HTMLAttributes } from 'vue';

const props = defineProps<{
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <CSidebarToggler
        data-slot="sidebar-trigger"
        :class="props.class"
    >
        <slot />
    </CSidebarToggler>
</template>
