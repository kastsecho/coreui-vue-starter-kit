<script setup lang="ts">
import { setLayoutProps, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import PlaceholderPattern from '@/components/PlaceholderPattern.vue';
import { Alert } from '@/components/ui/alert';
import { Column, Container, Row } from '@/components/ui/skeleton';
import { dashboard } from '@/routes';

defineProps<{
    status?: string;
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
