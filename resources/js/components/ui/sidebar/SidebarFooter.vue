<script setup lang="ts">
import { CSidebarFooter } from '@coreui/vue';
import type { HTMLAttributes } from 'vue';

const props = defineProps<{
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <CSidebarFooter
        data-slot="sidebar-footer"
        data-sidebar="footer"
        :class="props.class"
    >
        <slot />
    </CSidebarFooter>
</template>
