<script setup lang="ts">
import { CSidebarToggler } from '@coreui/vue';
import { type HTMLAttributes } from 'vue';
import { useSidebar } from '.';

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
        aria-label="Toggle Sidebar"
        :tabindex="-1"
        title="Toggle Sidebar"
        @click="sidebar.setOpenMobile(!sidebar.openMobile)"
    >
        <slot />
    </CSidebarToggler>
</template>
