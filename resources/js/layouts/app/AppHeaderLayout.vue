<script setup lang="ts">
import AppHeader from '@/components/AppHeader.vue';
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
        <AppHeader :breadcrumbs />

        <!-- Page Content -->
        <main class="py-4">
            <CContainer>
                <slot />
            </CContainer>
        </main>
    </div>
</template>
