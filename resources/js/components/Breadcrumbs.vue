<script setup lang="ts">
import type { BreadcrumbItem } from '@/types';
import { CBreadcrumb, CBreadcrumbItem } from '@coreui/vue';
import { Link } from '@inertiajs/vue3';

defineProps<{
    breadcrumbs: BreadcrumbItem[];
}>();
</script>

<template>
    <CBreadcrumb class="mb-0">
        <template v-for="(item, index) in breadcrumbs" :key="index">
            <template v-if="index === breadcrumbs.length - 1">
                <CBreadcrumbItem>{{ item.title }}</CBreadcrumbItem>
            </template>
            <template v-else>
                <Link class="breadcrumb-item" :href="item.href">{{ item.title }}</Link>
            </template>
        </template>
    </CBreadcrumb>
</template>
