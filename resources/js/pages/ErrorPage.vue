<script setup lang="ts">
import { CIcon } from '@coreui/icons-vue';
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';
import Heading from '@/components/Heading.vue';
import { Button } from '@/components/ui/button';
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
    <div class="d-grid justify-content-center min-vh-100" role="main">
        <div
            class="d-flex flex-column justify-content-start justify-content-sm-center gap-3"
        >
            <div
                class="d-flex align-items-center align-items-sm-start pt-sm-0 pt-4"
            >
                <h1
                    class="display-6 text-danger border-end border-secondary border-2 px-4"
                    v-text="status"
                />

                <Heading class="text-body ms-4" v-bind="error" />
            </div>

            <div class="d-flex justify-content-between gap-3">
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
            </div>
        </div>
    </div>
</template>
