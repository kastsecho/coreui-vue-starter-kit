<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';
import { Column, Container, Row } from '@/components/ui/grid';
import { home } from '@/routes';

defineProps<{
    title?: string;
    description?: string;
}>();
</script>

<template>
    <div
        class="d-flex min-vh-100 flex-column align-items-center justify-content-center gap-3"
    >
        <Container>
            <Row class="justify-content-center">
                <Column :md="7" :lg="5">
                    <div class="d-flex flex-column align-items-center gap-4">
                        <Link :href="home()" class="link-danger fw-medium">
                            <AppLogoIcon height="36" width="36" />
                        </Link>

                        <Card class="rounded-4 shadow-sm">
                            <CardHeader class="rounded-top-4 text-center">
                                <CardTitle>{{ title }}</CardTitle>
                                <CardDescription text-color="secondary">
                                    {{ description }}
                                </CardDescription>
                            </CardHeader>
                            <CardContent>
                                <slot />
                            </CardContent>
                        </Card>
                    </div>
                </Column>
            </Row>
        </Container>
    </div>
</template>
