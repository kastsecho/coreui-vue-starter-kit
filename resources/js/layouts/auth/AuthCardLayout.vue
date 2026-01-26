<script setup lang="ts">
import { CCol, CContainer, CRow } from '@coreui/vue';
import { Link, usePage } from '@inertiajs/vue3';
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';
import { home } from '@/routes';

const page = usePage();
const name = page.props.name;

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
                            :href="home()"
                            class="link-danger fw-medium size-9"
                        >
                            <AppLogoIcon height="36" width="36" />
                            <span class="visually-hidden">{{ name }}</span>
                        </Link>

                        <Card class="rounded-4 shadow-sm">
                            <CardHeader class="text-center rounded-top-4">
                                <CardTitle>{{ title }}</CardTitle>
                                <CardDescription>
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
