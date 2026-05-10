<script setup lang="ts">
import { cilHome } from '@coreui/icons';
import { CIcon } from '@coreui/icons-vue';
import type { Colors } from '@coreui/vue/src/types';
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';
import { Button } from '@/components/ui/button';
import { Card, CardContent } from '@/components/ui/card';
import { Container, Column, Row } from '@/components/ui/skeleton';
import { Spinner } from '@/components/ui/spinner';
import { home } from '@/routes';

const props = defineProps<{
    exception?: string;
    responseStart: number;
    responseEnd: number;
}>();

const responseTime = computed(() =>
    Math.round((props.responseEnd - props.responseStart) * 1000),
);

const statuses: Record<string, { color: Colors; description: string }> = {
    healthy: {
        color: 'success',
        description: 'up',
    },
    error: {
        color: 'danger',
        description: 'experiencing problems',
    },
};

const goBack = () => window.history.back();

const status = computed(() =>
    props.exception ? statuses.error : statuses.healthy,
);
</script>

<template>
    <Head title="Health" />
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
                                    <Spinner
                                        :color="status.color"
                                        variant="grow"
                                        style="
                                            --cui-spinner-animation-speed: 1.8s;
                                        "
                                    />
                                    <h1 class="fs-3 text-body-emphasis mt-4">
                                        Application
                                        <small :class="`text-${status.color}`">
                                            {{ status.description }}
                                        </small>
                                    </h1>
                                    <p class="fw-medium">
                                        HTTP request received. Response rendered
                                        in
                                        {{ responseTime }} ms.
                                    </p>
                                </Column>
                                <Column
                                    :md="6"
                                    class="d-flex flex-column justify-content-center gap-3"
                                >
                                    <Button
                                        as="Link"
                                        :color="status.color"
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
