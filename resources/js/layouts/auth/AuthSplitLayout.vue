<script setup lang="ts">
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import { type SharedData } from '@/types';
import { CCol, CRow } from '@coreui/vue';
import { Link, usePage } from '@inertiajs/vue3';

const page = usePage<SharedData>();
const name = page.props.name;
const quote = page.props.quote;

defineProps<{
    title?: string;
    description?: string;
}>();
</script>

<template>
    <CRow class="vh-100 vw-100">
        <CCol lg="6" class="d-none d-lg-flex flex-column p-5">
            <Link :href="route('home')" class="d-flex align-items-center fs-5 fw-medium text-decoration-none link-danger">
                <AppLogoIcon class="text-danger size-9" />
                <span class="ms-3">{{ name }}</span>
            </Link>

            <figure v-if="quote" class="border-start mt-auto border-4 border-secondary ps-3">
                <blockquote class="blockquote">
                    <p>&ldquo;{{ quote.message }}&rdquo;</p>
                    <footer class="blockquote-footer">{{ quote.author }}</footer>
                </blockquote>
            </figure>
        </CCol>

        <CCol lg="6" class="bg-body d-flex flex-column align-items-center justify-content-center">
            <header class="d-grid gap-1 text-center">
                <h1 class="fs-5 fw-medium">{{ title }}</h1>
                <p class="text-muted">{{ description }}</p>
            </header>

            <CCol sm="4" md="6">
                <slot />
            </CCol>
        </CCol>
    </CRow>
</template>
