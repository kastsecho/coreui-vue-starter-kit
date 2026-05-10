<script setup lang="ts">
import {
    cilPeople,
    cilCheckCircle,
    cilXCircle,
    cilSpreadsheet,
} from '@coreui/icons';
import { CIcon } from '@coreui/icons-vue';
import { setLayoutProps } from '@inertiajs/vue3';
import { Alert } from '@/components/ui/alert';
import { Badge } from '@/components/ui/badge';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Column, Container, Row } from '@/components/ui/skeleton';
import {
    Table,
    TableCell,
    TableContent,
    TableHeaderCell,
    TableRow,
} from '@/components/ui/table';
import { dashboard } from '@/routes';
import type { ApiCollection, User } from '@/types';

type UserStats = {
    total: number;
    unverified: number;
    verified: number;
};

defineProps<{
    status?: string;
    users: UserStats;
    recentUsers: ApiCollection<User, { readable_created_at: string }>;
}>();

setLayoutProps({
    breadcrumbs: [
        {
            title: 'Dashboard',
            href: dashboard(),
        },
    ],
});
</script>

<template>
    <Container>
        <Row class="justify-content-center row-gap-3">
            <Alert v-if="status" color="success">
                {{ status }}
            </Alert>

            <Column :xs="6" :md="4">
                <Card class="rounded-4 shadow-sm">
                    <CardContent class="d-flex align-items-center">
                        <div class="flex-grow-1 text-center">
                            <CardTitle>Total Users</CardTitle>
                            <small class="text-muted" v-text="users.total" />
                        </div>

                        <CIcon
                            class="text-info mb-0 flex-shrink-0"
                            :icon="cilPeople"
                            size="xl"
                        />
                    </CardContent>
                </Card>
            </Column>

            <Column :xs="6" :md="4">
                <Card class="rounded-4 shadow-sm">
                    <CardContent class="d-flex align-items-center">
                        <div class="flex-grow-1 text-center">
                            <CardTitle>Verified Users</CardTitle>
                            <small class="text-muted" v-text="users.verified" />
                        </div>

                        <CIcon
                            class="text-success flex-shrink-0"
                            :icon="cilCheckCircle"
                            size="xl"
                        />
                    </CardContent>
                </Card>
            </Column>

            <Column :xs="12" :md="4">
                <Card class="rounded-4 shadow-sm">
                    <CardContent class="d-flex align-items-center">
                        <div class="flex-grow-1 text-center">
                            <CardTitle>Unverified Users</CardTitle>
                            <small
                                class="text-muted"
                                v-text="users.unverified"
                            />
                        </div>

                        <CIcon
                            class="text-warning flex-shrink-0"
                            :icon="cilXCircle"
                            size="xl"
                        />
                    </CardContent>
                </Card>
            </Column>

            <Column :md="12">
                <Card class="rounded-4 shadow-sm">
                    <CardHeader class="rounded-top-4">
                        <CIcon class="me-2" :icon="cilSpreadsheet" />
                        Recent Users
                    </CardHeader>
                    <CardContent class="p-0 text-center">
                        <Table
                            class="rounded-bottom-4 m-0 overflow-hidden"
                            :columns="['ID', 'Name', 'Status', 'Created']"
                            responsive
                            striped
                        >
                            <TableContent>
                                <TableRow
                                    v-for="user in recentUsers.data"
                                    :key="user.id"
                                >
                                    <TableHeaderCell>
                                        <span v-text="user.id" />
                                    </TableHeaderCell>
                                    <TableCell>{{
                                        user.attributes.name
                                    }}</TableCell>
                                    <TableCell align="middle">
                                        <Badge
                                            v-if="
                                                user.attributes
                                                    .email_verified_at
                                            "
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
                                        {{ user.meta?.readable_created_at }}
                                    </TableCell>
                                </TableRow>
                            </TableContent>
                        </Table>
                    </CardContent>
                </Card>
            </Column>
        </Row>
    </Container>
</template>
