<script setup lang="ts">
import { CIcon } from '@coreui/icons-vue';
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';
import Heading from '@/components/Heading.vue';
import { Button } from '@/components/ui/button';
import { Column, Container, Row } from '@/components/ui/skeleton';
import { cilHome } from '@/icons';
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
        class="d-flex flex-column align-items-center justify-content-center min-vh-100"
    >
        <Container fluid>
            <Row class="flex-column align-items-center row-gap-3">
                <Column
                    class="d-flex align-items-center justify-content-center"
                    :md="10"
                    :lg="8"
                    :xl="6"
                >
                    <h1
                        class="display-6 text-danger border-end border-secondary mb-0 border-2 px-4"
                        v-text="status"
                    />

                    <Heading class="text-body ms-4 text-wrap" v-bind="error" />
                </Column>

                <Column
                    class="d-flex align-items-center justify-content-center gap-3"
                    :md="10"
                    :lg="8"
                    :xl="6"
                >
                    <Button
                        as="Link"
                        class="flex-grow-1"
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
                        class="flex-grow-1"
                        color="light"
                        shape="rounded-pill"
                        @click="goBack"
                    >
                        Go Back
                    </Button>
                </Column>
            </Row>
        </Container>
    </div>
</template>
