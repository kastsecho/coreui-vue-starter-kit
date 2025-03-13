<script setup lang="ts">
import AppLayout from '@/layouts/app/AppHeaderLayout.vue';
import type { BreadcrumbItem } from '@/types';
import { CToaster } from '@coreui/vue';

interface Props {
    breadcrumbs?: BreadcrumbItem[];
}

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});
</script>

<template>
    <AppLayout :breadcrumbs>
        <slot />

        <CToaster placement="bottom-end" class="p-3">
            <slot name="toast" />
        </CToaster>
    </AppLayout>
</template>
