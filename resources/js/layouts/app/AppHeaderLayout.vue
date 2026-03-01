<script setup lang="ts">
import AppContent from '@/components/AppContent.vue';
import AppHeader from '@/components/AppHeader.vue';
import AppShell from '@/components/AppShell.vue';
import type { AppBreadcrumbProps } from '@/types';

withDefaults(defineProps<AppBreadcrumbProps>(), {
    breadcrumbs: () => [],
});
</script>

<template>
    <AppShell class="flex-column">
        <AppHeader :breadcrumbs="breadcrumbs" />
        <AppContent class="py-4" container>
            <slot />
        </AppContent>
    </AppShell>
</template>
