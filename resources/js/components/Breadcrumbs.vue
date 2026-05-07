<script setup lang="ts">
import {
    Breadcrumb,
    BreadcrumbLink,
    BreadcrumbPage,
} from '@/components/ui/breadcrumb';
import type { BreadcrumbItem } from '@/types';

defineProps<{
    breadcrumbs: BreadcrumbItem[];
}>();
</script>

<template>
    <Breadcrumb v-if="breadcrumbs">
        <template v-for="(item, index) in breadcrumbs" :key="index">
            <template v-if="index === breadcrumbs.length - 1">
                <BreadcrumbPage>{{ item.title }}</BreadcrumbPage>
            </template>
            <template v-else>
                <BreadcrumbLink
                    text-color="body-emphasis"
                    :href="item.href ?? '#'"
                >
                    {{ item.title }}
                </BreadcrumbLink>
            </template>
        </template>
    </Breadcrumb>
</template>
