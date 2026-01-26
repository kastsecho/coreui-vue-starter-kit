<script setup lang="ts">
import { CSidebarHeader } from '@coreui/vue';
import type { HTMLAttributes } from 'vue';
import { cn } from '@/lib/utils';

const props = defineProps<{
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <CSidebarHeader
        data-slot="sidebar-menu-header"
        :class="cn('border-bottom', props.class)"
    >
        <slot />
    </CSidebarHeader>
</template>
