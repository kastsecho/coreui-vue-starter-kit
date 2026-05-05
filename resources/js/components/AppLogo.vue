<script setup lang="ts">
import type { InertiaLinkProps } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import AppLogoIcon from '@/components/AppLogoIcon.vue';

defineProps<{
    href?: NonNullable<InertiaLinkProps['href']>;
    alt?: string;
}>();
</script>

<template>
    <Link class="navbar-brand link-danger" :href="href">
        <AppLogoIcon height="32" width="32" :alt="alt" />
    </Link>
</template>
