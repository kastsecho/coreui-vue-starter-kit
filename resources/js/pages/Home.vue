<script setup lang="ts">
import type { Auth, SharedData } from '@/types';
import { CCard, CCardBody, CCardHeader, CCol, CContainer, CRow } from '@coreui/vue';
import { Head, Link, usePage } from '@inertiajs/vue3';

const page = usePage<SharedData>();
const auth = page.props.auth as Auth;

import LaravelLogo from '../../svg/laravelLogo.svg?raw';
import LaravelVersion from '../../svg/laravelVersion.svg?raw';
</script>

<template>
    <Head title="Home" />

    <CContainer class="py-4">
        <CRow class="justify-content-center">
            <CCol md="6" lg="10" class="d-grid gap-3">
                <nav class="text-end">
                    <Link v-if="auth.user" :href="route('dashboard')" class="btn btn-danger">Dashboard</Link>
                    <template v-else>
                        <Link :href="route('login')" class="btn btn-link link-danger text-decoration-none">Log in</Link>
                        <Link :href="route('register')" class="btn btn-danger ms-3">Register</Link>
                    </template>
                </nav>

                <CCard class="rounded-3 shadow-sm">
                    <CCardHeader class="rounded-3 d-lg-none text-danger overflow-hidden p-0 shadow-sm">
                        <div v-html="LaravelLogo"></div>
                        <div v-html="LaravelVersion"></div>
                    </CCardHeader>
                    <CCardBody class="p-lg-0">
                        <div class="d-flex row-cols-1 row-cols-lg-2 h-100 w-100">
                            <CCol class="d-flex flex-column justify-content-lg-center p-lg-4">
                                <h1 class="fs-6 fw-medium mb-1">Let's get started</h1>
                                <p class="small fw-medium mb-2 text-muted">
                                    Laravel has an incredibly rich ecosystem.<br />We suggest starting with the following.
                                </p>
                                <ul>
                                    <li class="fw-medium">
                                        Read the
                                        <a href="https://laravel.com/docs" target="_blank" class="link-danger">
                                            <span>Documentation</span>
                                            <span class="bi-box-arrow-up-right ms-2"></span>
                                        </a>
                                    </li>
                                    <li class="fw-medium">
                                        Watch video tutorials at
                                        <a href="https://laracasts.com" target="_blank" class="link-danger">
                                            <span>Laracasts</span>
                                            <span class="bi-box-arrow-up-right ms-2"></span>
                                        </a>
                                    </li>
                                </ul>

                                <div>
                                    <a href="https://cloud.laravel.com" target="_blank" class="btn btn-danger px-4">Deploy now</a>
                                </div>
                            </CCol>

                            <CCol
                                class="border-danger rounded-3 d-none d-lg-block text-danger overflow-hidden border shadow-sm"
                                style="background-color: var(--bs-card-cap-bg)"
                            >
                                <div v-html="LaravelLogo"></div>
                                <div v-html="LaravelVersion"></div>
                            </CCol>
                        </div>
                    </CCardBody>
                </CCard>
            </CCol>
        </CRow>
    </CContainer>
</template>
