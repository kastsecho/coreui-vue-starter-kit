<script setup lang="ts">
import { CContainer } from '@coreui/vue';
import AppContent from '@/components/AppContent.vue';
import AppShell from '@/components/AppShell.vue';
import AppSidebar from '@/components/AppSidebar.vue';
import AppSidebarHeader from '@/components/AppSidebarHeader.vue';
import type { AppBreadcrumbProps } from '@/types';

withDefaults(defineProps<AppBreadcrumbProps>(), {
    breadcrumbs: () => [],
});
</script>

<template>
    <AppShell variant="sidebar">
        <AppSidebar />
        <AppContent variant="sidebar" class="overflow-x-hidden">
            <AppSidebarHeader :breadcrumbs="breadcrumbs" />
            <main class="body flex-grow-1">
                <CContainer class="px-4" lg>
                    <slot />
                </CContainer>
            </main>
        </AppContent>
    </AppShell>
</template>
