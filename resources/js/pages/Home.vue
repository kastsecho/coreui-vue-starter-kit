<script setup lang="ts">
import type { Auth, SharedData } from '@/types';
import { CCard, CCardBody, CCardImage, CCardText, CCol, CContainer, CListGroup, CListGroupItem, CRow } from '@coreui/vue';
import { Head, Link, usePage } from '@inertiajs/vue3';

defineProps<{
    laravel?: string;
    php?: string;
}>();

const page = usePage<SharedData>();
const auth = page.props.auth as Auth;
</script>

<template>
    <Head title="Home" />

    <CContainer class="d-grid align-items-center justify-content-center min-vh-100">
        <CRow>
            <CCol md="5">
                <CCard class="rounded-4 shadow w-100 mb-4 h-100">
                    <CCardBody class="d-flex flex-column">
                        <h1 class="card-title fs-2 fw-light">Let's get started</h1>
                        <CCardText class="small fw-medium text-muted">
                            Your Laravel project is set up and styled with CoreUI components.
                            <br />We suggest starting with the following.
                        </CCardText>

                        <CListGroup as="nav" flush>
                            <CListGroupItem as="a" class="fw-medium" href="https://coreui.io/docs" target="_blank">
                                <span class="bi-box-arrow-up-right text-danger me-2"></span>
                                Read the
                                <span class="text-danger">CoreUI Documentation</span>
                            </CListGroupItem>
                            <CListGroupItem as="a" class="fw-medium" href="https://laravel.com/docs" target="_blank">
                                <span class="bi-box-arrow-up-right text-danger me-2"></span>
                                Read the
                                <span class="text-danger">Laravel Documentation</span>
                            </CListGroupItem>
                            <CListGroupItem as="a" class="fw-medium" href="https://laracasts.com" target="_blank">
                                <span class="bi-box-arrow-up-right text-danger me-2"></span>
                                Watch video tutorials at
                                <span class="text-danger">Laracasts</span>
                            </CListGroupItem>
                        </CListGroup>

                        <div class="mt-auto" id="cta">
                            <Link v-if="auth.user" :href="route('dashboard')" class="btn btn-danger">Dashboard</Link>
                            <template v-else>
                                <Link :href="route('login')" class="btn btn-danger">Log in</Link>
                                <Link :href="route('register')" class="btn btn-danger ms-3">Register</Link>
                            </template>
                        </div>
                    </CCardBody>
                </CCard>
            </CCol>

            <CCol md="7">
                <CCard class="rounded-4 shadow-sm h-100">
                    <CCardImage orientation="top" class="rounded-4" src="/img/coreui-screenshot.png" alt="Dashboard Preview" />
                    <CCardBody class="card-body">
                        <CCardText class="text-center text-muted"> Dashboard Preview </CCardText>
                    </CCardBody>
                </CCard>
            </CCol>
        </CRow>

        <small class="text-center fw-medium text-muted">Laravel v{{ laravel }} &dotsquare; PHP v{{ php }}</small>
    </CContainer>
</template>
