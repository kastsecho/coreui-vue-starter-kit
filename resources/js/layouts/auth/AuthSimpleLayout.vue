<script setup lang="ts">
import AppLogoIcon from '@/components/AppLogoIcon.vue';
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
                        <Link class="link-danger fw-medium size-9" :href="home()">
                            <AppLogoIcon height="36" width="36" />
                            <span class="visually-hidden">{{ title }}</span>
                        </Link>

                        <div class="d-flex flex-column align-items-center">
                            <h1 class="fs-4 fw-medium" v-if="title">{{ title }}</h1>
                            <p class="text-center text-muted" v-if="description">
                                {{ description }}
                            </p>
                        </div>
                    </div>
                    <slot />
                </CCol>
            </CRow>
        </CContainer>
    </div>
</template>
