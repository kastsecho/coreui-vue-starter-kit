<script setup lang="ts">
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import { CCard, CCardBody, CCardHeader, CCardText, CCardTitle, CCol, CContainer, CRow } from '@coreui/vue';
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
                <CCol md="7" lg="5" class="d-grid gap-2">
                    <header class="text-center">
                        <Link :href="route('home')">
                            <AppLogoIcon class="text-danger size-9" />
                            <span class="visually-hidden">{{ title }}</span>
                        </Link>
                    </header>

                    <CCard class="rounded-3 shadow-sm">
                        <CCardHeader class="text-center">
                            <CCardTitle>{{ title }}</CCardTitle>
                            <CCardText class="text-muted">
                                {{ description }}
                            </CCardText>
                        </CCardHeader>
                        <CCardBody>
                            <slot />
                        </CCardBody>
                    </CCard>
                </CCol>
            </CRow>
        </CContainer>
    </div>
</template>
