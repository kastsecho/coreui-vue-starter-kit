<script setup lang="ts">
import Toast from '@/components/Toast.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import type { BreadcrumbItem } from '@/types';
import { CCard, CCardBody, CCardHeader, CCol, CContainer, CRow } from '@coreui/vue';
import { Head } from '@inertiajs/vue3';

defineProps<{
    status?: string;
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Home',
        href: '/',
    },
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];
</script>

<template>
    <AppLayout :breadcrumbs>
        <Head title="Dashboard" />

        <template #toast>
            <Toast v-if="status" body-class="fw-medium text-success">
                {{ status }}
            </Toast>
        </template>

        <CContainer>
            <CRow class="justify-content-center">
                <CCol md="8">
                    <CCard class="rounded-3 shadow-sm">
                        <CCardHeader>Dashboard</CCardHeader>

                        <CCardBody>You are logged in!</CCardBody>
                    </CCard>
                </CCol>
            </CRow>
        </CContainer>
    </AppLayout>
</template>
