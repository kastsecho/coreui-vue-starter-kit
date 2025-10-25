<script setup lang="ts">
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import { home } from '@/routes';
import { CCol, CContainer } from '@coreui/vue';
import { Link, usePage } from '@inertiajs/vue3';

defineProps<{
    title?: string;
    description?: string;
}>();

const page = usePage();
const quote = page.props.quote;
</script>

<template>
    <div class="d-flex rows-cols-lg-2 px-0">
        <CCol class="d-none vh-100 d-lg-flex flex-column">
            <CContainer class="p-5 d-grid justify-content-between h-100">
                <Link class="link-danger fw-medium size-9" :href="home()">
                    <AppLogoIcon height="36" width="36" />
                    <span class="visually-hidden">{{ title }}</span>
                </Link>

                <div v-if="quote" class="mt-auto border-start border-4 border-secondary ps-3">
                    <blockquote class="blockquote">
                        <p>&ldquo;{{ quote.message }}&rdquo;</p>
                        <footer class="blockquote-footer">
                            {{ quote.author }}
                        </footer>
                    </blockquote>
                </div>
            </CContainer>
        </CCol>

        <CCol class="bg-body vh-100 d-flex flex-column align-items-center justify-content-center">
            <CCol md="6" lg="8">
                <div class="d-flex flex-column align-items-center">
                    <h1 class="fs-4 fw-medium" v-if="title">
                        {{ title }}
                    </h1>
                    <p class="text-muted" v-if="description">
                        {{ description }}
                    </p>
                </div>
                <slot />
            </CCol>
        </CCol>
    </div>
</template>
