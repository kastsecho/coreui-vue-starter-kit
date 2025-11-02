<script setup lang="ts">
import { CSidebarNav } from '@coreui/vue';
import type { Component, HTMLAttributes } from 'vue';

const props = defineProps<{
    as?: string | Component;
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <CSidebarNav
        data-slot="sidebar-content"
        :class="props.class"
        :as="as"
    >
        <slot />
    </CSidebarNav>
</template>
