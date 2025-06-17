<script setup lang="ts">
import Heading from '@/components/Heading.vue';
import Toast from '@/components/Toast.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import type { Auth, BreadcrumbItem, SharedData, User } from '@/types';
import {
    CBadge,
    CCard,
    CCardBody,
    CCardHeader,
    CCardTitle,
    CCol,
    CRow,
    CTable,
    CTableBody,
    CTableDataCell,
    CTableHead,
    CTableHeaderCell,
    CTableRow,
} from '@coreui/vue';
import { Head, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

defineProps<{
    status?: string;
    users: {
        total: number;
        verified: number;
        unverified: number;
        latest: string;
    };
    recentUsers: User[];
}>();

const page = usePage<SharedData>();
const auth = computed<Auth>(() => page.props.auth);

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

        <Heading title="Dashboard" :description="`Welcome, ${auth.user.name}`" />

        <CRow class="row-gap-3">
            <CCol sm="6" lg="3">
                <CCard class="rounded-3 shadow-sm h-100">
                    <CCardBody class="d-flex align-items-center">
                        <div class="flex-grow-1 text-center">
                            <CCardTitle>Total Users</CCardTitle>
                            <small>{{ users.total }}</small>
                        </div>

                        <CCardTitle class="mb-0 flex-shrink-0 bi-people-fill text-info"></CCardTitle>
                    </CCardBody>
                </CCard>
            </CCol>

            <CCol sm="6" lg="3">
                <CCard class="rounded-3 shadow-sm h-100">
                    <CCardBody class="d-flex align-items-center">
                        <div class="flex-grow-1 text-center">
                            <CCardTitle>Latest User</CCardTitle>
                            <small>{{ users.latest }}</small>
                        </div>

                        <CCardTitle class="mb-0 flex-shrink-0 bi-person-badge-fill text-info"></CCardTitle>
                    </CCardBody>
                </CCard>
            </CCol>

            <CCol sm="6" lg="3">
                <CCard class="rounded-3 shadow-sm h-100">
                    <CCardBody class="d-flex align-items-center">
                        <div class="flex-grow-1 text-center">
                            <CCardTitle>Verified Users</CCardTitle>
                            <small>{{ users.verified }}</small>
                        </div>

                        <CCardTitle class="mb-0 flex-shrink-0 bi-check-circle-fill text-success"></CCardTitle>
                    </CCardBody>
                </CCard>
            </CCol>

            <CCol sm="6" lg="3">
                <CCard class="rounded-3 shadow-sm h-100">
                    <CCardBody class="d-flex align-items-center">
                        <div class="flex-grow-1 text-center">
                            <CCardTitle>Unverified Users</CCardTitle>
                            <small>{{ users.unverified }}</small>
                        </div>

                        <CCardTitle class="mb-0 flex-shrink-0 bi-x-circle-fill text-warning"></CCardTitle>
                    </CCardBody>
                </CCard>
            </CCol>
        </CRow>

        <CRow class="mt-3">
            <CCol lg="6">
                <CCard class="rounded-3 shadow-sm">
                    <CCardHeader>
                        <span class="me-2 bi-table"></span>
                        Recent Users
                    </CCardHeader>

                    <CCardBody class="text-center p-0">
                        <CTable striped class="m-0 rounded-bottom-3 overflow-hidden">
                            <CTableHead>
                                <CTableRow>
                                    <CTableHeaderCell>ID</CTableHeaderCell>
                                    <CTableHeaderCell>Name</CTableHeaderCell>
                                    <CTableHeaderCell>Status</CTableHeaderCell>
                                    <CTableHeaderCell>Created</CTableHeaderCell>
                                </CTableRow>
                            </CTableHead>

                            <CTableBody>
                                <CTableRow class="position-relative" v-for="user in recentUsers" :key="user.id">
                                    <CTableHeaderCell>{{ user.id }}</CTableHeaderCell>
                                    <CTableDataCell>{{ user.name }}</CTableDataCell>
                                    <CTableDataCell>
                                        <CBadge shape="rounded-pill" :text-bg-color="user.email_verified_at ? 'success' : 'warning'">
                                            {{ user.email_verified_at ? 'Verified' : 'Unverified' }}
                                        </CBadge>
                                    </CTableDataCell>
                                    <CTableDataCell>
                                        {{ new Date(user.created_at).toISOString().slice(0, 10) }}
                                    </CTableDataCell>
                                </CTableRow>
                            </CTableBody>
                        </CTable>
                    </CCardBody>
                </CCard>
            </CCol>
        </CRow>
    </AppLayout>
</template>
