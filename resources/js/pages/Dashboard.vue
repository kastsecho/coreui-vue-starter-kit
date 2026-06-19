<script setup lang="ts">
import { Head, setLayoutProps, usePage } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import PendingInvitationsModal from '@/components/PendingInvitationsModal.vue';
import PlaceholderPattern from '@/components/PlaceholderPattern.vue';
import { Alert } from '@/components/ui/alert';
import { Column, Container, Row } from '@/components/ui/skeleton';
import { dashboard } from '@/routes';
import type { DashboardInvitation } from '@/types';

const props = defineProps<{
    status?: string;
    pendingInvitations?: DashboardInvitation[];
}>();

const page = usePage();

const dashboardUrl = computed(() =>
    page.props.currentTeam ? dashboard(page.props.currentTeam.slug).url : '/',
);

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

    <PendingInvitationsModal
        v-if="pendingInvitations && pendingInvitations.length > 0"
        :invitations="pendingInvitations"
    />

    <Container>
        <Row class="justify-content-center row-gap-3">
            <Alert v-if="status" color="success">
                {{ status }}
            </Alert>

            <Column
                v-for="column in 3"
                :key="column"
                :xs="column < 3 ? 6 : 12"
                :md="4"
            >
                <PlaceholderPattern />
            </Column>

            <Column>
                <PlaceholderPattern />
            </Column>
        </Row>
    </Container>
</template>
