<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3';
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import { Column, Container } from '@/components/ui/skeleton';
import { home } from '@/routes';

const page = usePage();
const name = page.props.name;

defineProps<{
    title?: string;
    description?: string;
}>();
</script>

<template>
    <div class="d-flex rows-cols-lg-2 px-0">
        <Column class="d-none vh-100 d-lg-flex flex-column">
            <Container class="d-grid justify-content-between h-100 p-5">
                <Link :href="home()" class="link-danger fw-medium">
                    <AppLogoIcon height="36" width="36" />
                    <span class="visually-hidden">{{ name }}</span>
                </Link>
            </Container>
        </Column>
        <Column
            class="bg-body vh-100 d-flex flex-column align-items-center justify-content-center"
        >
            <Column :md="6" :lg="8">
                <div class="d-flex flex-column align-items-center">
                    <h1 class="fs-4 fw-medium">
                        {{ title }}
                    </h1>
                    <p class="text-muted">
                        {{ description }}
                    </p>
                </div>
                <slot />
            </Column>
        </Column>
    </div>
</template>
