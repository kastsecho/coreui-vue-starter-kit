<script setup lang="ts">
import AppearanceTabs from '@/components/AppearanceTabs.vue';
import HeadingSmall from '@/components/HeadingSmall.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import type { BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Home',
        href: '/',
    },
    {
        title: 'Appearance settings',
        href: '/settings/appearance',
    },
];
</script>

<template>
    <AppLayout :breadcrumbs>
        <Head title="Appearance settings" />

        <SettingsLayout>
            <div class="d-grid gap-3">
                <HeadingSmall title="Appearance settings" description="Update your account's appearance settings" />

                <AppearanceTabs />
            </div>
        </SettingsLayout>
    </AppLayout>
</template>
