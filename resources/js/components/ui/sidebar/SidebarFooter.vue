<script setup lang="ts">
import { cn } from '@/lib/utils';
import { CSidebarFooter } from '@coreui/vue';
import type { HTMLAttributes } from 'vue';

const props = defineProps<{
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <CSidebarFooter
        data-slot="sidebar-footer"
        :class="cn('border-top d-none d-lg-flex', props.class)"
    >
        <slot />
    </CSidebarFooter>
</template>
