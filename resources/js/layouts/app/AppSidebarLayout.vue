<script setup lang="ts">
import AppSidebar from '@/components/AppSidebar.vue';
import AppSidebarFooter from '@/components/AppSidebarFooter.vue';
import AppSidebarHeader from '@/components/AppSidebarHeader.vue';
import type { BreadcrumbItem } from '@/types';
import { CContainer } from '@coreui/vue';

interface Props {
    breadcrumbs?: BreadcrumbItem[];
}

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});
</script>

<template>
    <div>
        <AppSidebar />
        <div class="wrapper d-flex flex-column min-vh-100">
            <AppSidebarHeader :breadcrumbs />

            <!-- Page Content -->
            <main class="body flex-grow-1">
                <CContainer class="px-4" lg>
                    <slot />
                </CContainer>
            </main>

            <!-- Page Footer -->
            <AppSidebarFooter />
        </div>
    </div>
</template>
