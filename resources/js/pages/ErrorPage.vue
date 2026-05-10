<script setup lang="ts">
import { cilHome } from '@coreui/icons';
import { CIcon } from '@coreui/icons-vue';
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import { Button } from '@/components/ui/button';
import { Card, CardContent } from '@/components/ui/card';
import { Column, Container, Row } from '@/components/ui/skeleton';
import { home } from '@/routes';

const props = defineProps<{
    description: string;
    status: number;
}>();

const errors: Record<number, { title: string; description: string }> = {
    401: {
        title: 'Unauthorized',
        description: props.description,
    },
    402: {
        title: 'Payment Required',
        description: props.description,
    },
    403: {
        title: 'Forbidden',
        description: props.description,
    },
    404: {
        title: 'Not Found',
        description: props.description,
    },
    418: {
        title: "I'm a teapot",
        description: props.description,
    },
    419: {
        title: 'Page Expired',
        description: props.description,
    },
    429: {
        title: 'Too Many Requests',
        description: props.description,
    },
    500: {
        title: 'Server Error',
        description: props.description,
    },
    503: {
        title: 'Service Unavailable',
        description: props.description,
    },
};

const goBack = () => window.history.back();

const error = computed(
    () =>
        errors[props.status] ?? {
            title: 'Error',
            description: 'An unexpected error occurred.',
        },
);
</script>

<template>
    <Head :title="error.title" />
    <div
        class="d-flex flex-column align-items-center justify-content-center vh-100"
    >
        <Container fluid>
            <Row class="justify-content-center">
                <Column :md="10" :lg="8" :xl="6">
                    <Card class="rounded-5 shadow-sm">
                        <CardContent class="p-5">
                            <Row>
                                <Column :md="6" class="text-muted text-center">
                                    <AppLogoIcon
                                        class="text-danger mb-3"
                                        width="48"
                                        height="48"
                                    />
                                    <h1 class="fs-3 text-body-emphasis">
                                        {{ props.status }}
                                        <small class="text-danger">
                                            {{ error.title }}
                                        </small>
                                    </h1>
                                    <p class="fw-medium text-center">
                                        {{ error.description }}
                                    </p>
                                </Column>
                                <Column
                                    :md="6"
                                    class="d-flex flex-column justify-content-center gap-3"
                                >
                                    <Button
                                        as="Link"
                                        color="danger"
                                        :href="home()"
                                        shape="rounded-pill"
                                        variant="outline"
                                    >
                                        Go Home
                                        <CIcon :icon="cilHome" />
                                    </Button>

                                    <Button
                                        type="button"
                                        color="light"
                                        shape="rounded-pill"
                                        @click="goBack"
                                    >
                                        Go Back
                                    </Button>
                                </Column>
                            </Row>
                        </CardContent>
                    </Card>
                </Column>
            </Row>
        </Container>
    </div>
</template>
