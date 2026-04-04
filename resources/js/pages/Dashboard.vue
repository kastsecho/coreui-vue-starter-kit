<script setup lang="ts">
import { CCol, CRow } from '@coreui/vue';
import { Head, setLayoutProps, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
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
import { dashboard } from '@/routes';
import type { User } from '@/types';

type UserStats = {
    latest: string;
    total: number;
    unverified: number;
    verified: number;
};

defineProps<{
    status?: string;
    users: UserStats;
    recentUsers: User[];
}>();

const page = usePage();
const user = computed(() => page.props.auth.user);

const dashboardUrl = computed(() =>
    page.props.currentTeam ? dashboard(page.props.currentTeam.slug).url : '/',
);

const columns: string[] = ['ID', 'Name', 'Status', 'Created'];

const toDateString = (date: string): string => {
    return new Date(date).toISOString().slice(0, 10);
};

setLayoutProps({
    breadcrumbs: [
        {
            title: 'Dashboard',
            href: dashboardUrl.value,
        },
    ],
});
</script>

<template>
    <Head title="Dashboard" />

    <div class="d-grid gap-3">
        <Heading title="Dashboard" :description="`Welcome, ${user.name}`" />

        <Alert
            v-if="status"
            color="success"
            class="fw-medium rounded-4 shadow-sm text-center"
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
                            class="mb-0 card-title flex-shrink-0"
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
                            class="mb-0 card-title flex-shrink-0"
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
                            class="mb-0 card-title flex-shrink-0"
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
                            class="mb-0 card-title flex-shrink-0"
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
                    <CardContent class="p-0 text-center">
                        <Table
                            class="m-0 rounded-bottom-4 overflow-hidden"
                            :columns="columns"
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
                                            v-if="user.email_verified_at"
                                            shape="rounded-pill"
                                            text-bg-color="success"
                                        >
                                            Verified
                                        </Badge>
                                        <Badge
                                            v-else
                                            shape="rounded-pill"
                                            text-bg-color="warning"
                                        >
                                            Unverified
                                        </Badge>
                                    </TableCell>
                                    <TableCell>
                                        {{ toDateString(user.created_at) }}
                                    </TableCell>
                                </TableRow>
                            </TableContent>
                        </Table>
                    </CardContent>
                </Card>
            </CCol>
        </CRow>
    </div>
</template>
