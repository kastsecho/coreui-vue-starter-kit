<script setup lang="ts">
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import { CCol, CContainer, CRow } from '@coreui/vue';
import { Link } from '@inertiajs/vue3';

defineProps<{
    title?: string;
    description?: string;
}>();
</script>

<template>
    <div class="d-flex min-vh-100 flex-column align-items-center justify-content-center gap-3">
        <CContainer>
            <CRow class="justify-content-center">
                <CCol md="7" lg="5">
                    <header class="d-grid gap-1 text-center">
                        <Link :href="route('home')">
                            <AppLogoIcon class="text-danger size-9" />
                            <span class="visually-hidden">{{ title }}</span>
                        </Link>

                        <h1 class="fs-5 fw-medium">{{ title }}</h1>
                        <p class="text-muted">{{ description }}</p>
                    </header>

                    <slot />
                </CCol>
            </CRow>
        </CContainer>
    </div>
</template>
