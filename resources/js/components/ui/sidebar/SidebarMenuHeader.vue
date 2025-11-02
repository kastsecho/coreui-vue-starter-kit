<script setup lang="ts">
import { cn } from '@/lib/utils';
import { CSidebarHeader } from '@coreui/vue';
import type { HTMLAttributes } from 'vue';

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
