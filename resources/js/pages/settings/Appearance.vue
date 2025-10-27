<script setup lang="ts">
import AppearanceTabs from '@/components/AppearanceTabs.vue';
import HeadingSmall from '@/components/HeadingSmall.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import type { BreadcrumbItem } from '@/types';
import { edit as editProfile } from '@/routes/profile';
import { edit as editAppearance } from '@/routes/appearance';
import { Head } from '@inertiajs/vue3';


const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'Settings',
        href: editProfile().url,
    },
    {
        title: 'Appearance settings',
        href: editAppearance().url,
    },
];
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <Head title="Appearance settings" />

        <SettingsLayout>
            <div class="d-grid gap-3">
                <HeadingSmall
                    title="Appearance settings"
                    description="Update your account's appearance settings"
                />

                <div>
                    <AppearanceTabs />
                </div>
            </div>
        </SettingsLayout>
    </AppLayout>
</template>
