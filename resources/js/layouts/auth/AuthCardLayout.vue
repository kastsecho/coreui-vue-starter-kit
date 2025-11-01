<script setup lang="ts">
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';
import { home } from '@/routes';
import { CCol, CContainer, CRow } from '@coreui/vue';
import { Link } from '@inertiajs/vue3';

defineProps<{
    title?: string;
    description?: string;
}>();
</script>

<template>
    <div
        class="d-flex min-vh-100 flex-column align-items-center justify-content-center gap-3"
    >
        <CContainer>
            <CRow class="justify-content-center">
                <CCol md="7" lg="5">
                    <div class="d-flex flex-column align-items-center gap-4">
                        <Link
                            class="link-danger fw-medium size-9"
                            :href="home()"
                        >
                            <AppLogoIcon height="36" width="36" />
                            <span class="visually-hidden">{{ title }}</span>
                        </Link>

                        <Card class="rounded-4 shadow-sm">
                            <CardHeader class="text-center rounded-top-4">
                                <CardTitle v-if="title">{{ title }}</CardTitle>
                                <CardDescription v-if="description">
                                    {{ description }}
                                </CardDescription>
                            </CardHeader>
                            <CardContent>
                                <slot />
                            </CardContent>
                        </Card>
                    </div>
                </CCol>
            </CRow>
        </CContainer>
    </div>
</template>
