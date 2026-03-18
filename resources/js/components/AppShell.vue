<script setup lang="ts">
import { SidebarProvider } from '@/components/ui/sidebar';
import type { AppVariant } from '@/types';

type Props = {
    variant?: AppVariant;
};

withDefaults(defineProps<Props>(), {
    variant: 'sidebar',
});
</script>

<template>
    <div
        v-if="variant === 'header'"
        class="d-flex flex-column min-vh-100 w-100"
    >
        <slot />
    </div>
    <SidebarProvider v-else>
        <slot />
    </SidebarProvider>
</template>
