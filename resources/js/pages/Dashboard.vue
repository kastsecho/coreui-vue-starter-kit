<script setup lang="ts">
import { setLayoutProps } from '@inertiajs/vue3';
import PlaceholderPattern from '@/components/PlaceholderPattern.vue';
import { Alert } from '@/components/ui/alert';
import { Column, Container, Row } from '@/components/ui/grid';
import { dashboard } from '@/routes';

defineProps<{
    status?: string;
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

            <Column v-for="column in 3" :key="column" :md="4">
                <PlaceholderPattern />
            </Column>

            <Column>
                <PlaceholderPattern />
            </Column>
        </Row>
    </Container>
</template>
