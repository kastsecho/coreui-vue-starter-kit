<script setup lang="ts">
import { Head, setLayoutProps } from '@inertiajs/vue3';
import AppearanceTabs from '@/components/AppearanceTabs.vue';
import Heading from '@/components/Heading.vue';
import { edit } from '@/routes/appearance';

setLayoutProps({
    breadcrumbs: [
        {
            title: 'Appearance settings',
            href: edit(),
        },
    ],
});
</script>

<template>
    <Head title="Appearance settings" />

    <h1 class="visually-hidden">Appearance settings</h1>
    <div class="d-grid row-gap-3">
        <Heading
            variant="small"
            title="Appearance settings"
            description="Update your account's appearance settings"
        />
        <AppearanceTabs />
    </div>
</template>
