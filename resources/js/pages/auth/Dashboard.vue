<script setup lang="ts">
import Heading from '@/components/Heading.vue';
import Icon from '@/components/Icon.vue';
import { Alert } from '@/components/ui/alert';
import { Badge } from '@/components/ui/badge';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import {
    Table,
    TableCell,
    TableContent,
    TableHeaderCell,
    TableRow,
} from '@/components/ui/table';
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard, home } from '@/routes';
import type { BreadcrumbItem, User } from '@/types';
import { CCol, CRow } from '@coreui/vue';
import { Head, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

interface UserStats {
    latest: string;
    total: number;
    unverified: number;
    verified: number;
}

defineProps<{
    status?: string;
    users: UserStats;
    recentUsers: User[];
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Home',
        href: home().url,
    },
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
];

const page = usePage();
const user = computed(() => page.props.auth.user);
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <Heading title="Dashboard" :description="`Welcome, ${user.name}`" />

        <Alert
            v-if="status"
            class="text-center fw-medium rounded-4 shadow-sm"
            color="success"
        >
            {{ status }}
        </Alert>

        <CRow class="row-gap-3">
            <CCol sm="6" lg="3">
                <Card class="rounded-4 shadow-sm">
                    <CardContent class="d-flex align-items-center">
                        <div class="flex-grow-1 text-center">
                            <CardTitle>Total User</CardTitle>
                            <small class="text-muted">{{ users.total }}</small>
                        </div>

                        <Icon
                            class="mb-0 flex-shrink-0 card-title"
                            name="people-fill"
                            color="info"
                        />
                    </CardContent>
                </Card>
            </CCol>
            <CCol sm="6" lg="3">
                <Card class="rounded-4 shadow-sm">
                    <CardContent class="d-flex align-items-center">
                        <div class="flex-grow-1 text-center">
                            <CardTitle>Latest User</CardTitle>
                            <small v-text="users.latest" class="text-muted" />
                        </div>

                        <Icon
                            class="mb-0 flex-shrink-0 card-title"
                            name="person-badge-fill"
                            color="info"
                        />
                    </CardContent>
                </Card>
            </CCol>
            <CCol sm="6" lg="3">
                <Card class="rounded-4 shadow-sm">
                    <CardContent class="d-flex align-items-center">
                        <div class="flex-grow-1 text-center">
                            <CardTitle>Verified Users</CardTitle>
                            <small v-text="users.verified" class="text-muted" />
                        </div>

                        <Icon
                            class="mb-0 flex-shrink-0 card-title"
                            name="check-circle-fill"
                            color="success"
                        />
                    </CardContent>
                </Card>
            </CCol>
            <CCol sm="6" lg="3">
                <Card class="rounded-4 shadow-sm">
                    <CardContent class="d-flex align-items-center">
                        <div class="flex-grow-1 text-center">
                            <CardTitle>Unverified Users</CardTitle>
                            <small
                                v-text="users.unverified"
                                class="text-muted"
                            />
                        </div>

                        <Icon
                            class="mb-0 flex-shrink-0 card-title"
                            name="x-circle-fill"
                            color="warning"
                        />
                    </CardContent>
                </Card>
            </CCol>

            <CCol lg="6">
                <Card class="rounded-4 shadow-sm">
                    <CardHeader class="rounded-top-4">
                        <Icon class="me-2" name="table" />
                        Recent Users
                    </CardHeader>
                    <CardContent class="text-center p-0">
                        <Table
                            class="m-0 rounded-bottom-4 overflow-hidden"
                            :columns="['ID', 'Name', 'Status', 'Created']"
                            striped
                        >
                            <TableContent>
                                <TableRow
                                    v-for="user in recentUsers"
                                    :key="user.id"
                                >
                                    <TableHeaderCell>
                                        <span v-text="user.id" />
                                    </TableHeaderCell>
                                    <TableCell>{{ user.name }}</TableCell>
                                    <TableCell align="middle">
                                        <Badge
                                            shape="rounded-pill"
                                            :text-bg-color="
                                                user.email_verified_at
                                                    ? 'success'
                                                    : 'warning'
                                            "
                                        >
                                            {{
                                                user.email_verified_at
                                                    ? 'Verified'
                                                    : 'Unverified'
                                            }}
                                        </Badge>
                                    </TableCell>
                                    <TableCell>
                                        {{
                                            new Date(user.created_at)
                                                .toISOString()
                                                .slice(0, 10)
                                        }}
                                    </TableCell>
                                </TableRow>
                            </TableContent>
                        </Table>
                    </CardContent>
                </Card>
            </CCol>
        </CRow>
    </AppLayout>
</template>
