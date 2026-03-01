<script setup lang="ts">
import { CSidebarToggler } from '@coreui/vue';
import type { HTMLAttributes } from 'vue';
import { useSidebar } from '@/components/ui/sidebar';

const sidebar = useSidebar();

const props = defineProps<{
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <CSidebarToggler
        data-sidebar="rail"
        data-slot="sidebar-rail"
        :class="props.class"
        aria-label="Toggle sidebar"
        :tabindex="-1"
        title="Toggle sidebar"
        @click="sidebar.toggleCollapse"
    >
        <slot />
    </CSidebarToggler>
</template>
