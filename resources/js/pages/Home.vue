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

    <CContainer class="d-grid align-items-center justify-content-center min-vh-100 py-4">
        <CRow class="align-items-center row-gap-3 row-gap-md-0">
            <CCol md="7" lg="5" class="d-flex flex-column align-items-center">
                <CCard class="rounded-4 shadow-sm w-100">
                    <CCardBody>
                        <h1 class="card-title fs-2 fw-light">Let's get started</h1>
                        <CCardText class="small fw-medium text-muted">
                            Your Laravel project is set up and styled with CoreUI.
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
                            <CListGroupItem as="a" class="fw-medium" href="https://cloud.laravel.com" target="_blank">
                                <span class="bi-box-arrow-up-right text-danger me-2"></span>
                                <span class="text-danger">&nbsp;Deploy now</span>
                            </CListGroupItem>
                        </CListGroup>

                        <div class="mt-3">
                            <Link v-if="auth.user" :href="route('dashboard')" class="btn btn-danger">Dashboard</Link>
                            <template v-else>
                                <Link :href="route('login')" class="btn btn-danger">Log in</Link>
                                <Link :href="route('register')" class="btn btn-danger ms-3">Register</Link>
                            </template>
                        </div>
                    </CCardBody>
                </CCard>
            </CCol>

            <CCol md="5" lg="7" class="d-flex flex-column align-items-center">
                <CCard class="rounded-4 shadow-sm w-100">
                    <CCardImage
                        orientation="top"
                        class="rounded-4 border border-secondary"
                        src="/img/coreui-screenshot.jpg"
                        alt="Dashboard Preview"
                    />
                    <CCardBody class="text-center text-danger">
                        <CCardText class="small fw-semibold"> Laravel v{{ laravel }} &mdash; PHP v{{ php }} </CCardText>
                    </CCardBody>
                </CCard>
            </CCol>
        </CRow>
    </CContainer>
</template>
