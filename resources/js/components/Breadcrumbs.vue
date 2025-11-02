<script setup lang="ts">
import {
    Breadcrumb,
    BreadcrumbLink,
    BreadcrumbPage,
} from '@/components/ui/breadcrumb';
import type { BreadcrumbItem as BreadcrumbItemType } from '@/types';

defineProps<{
    breadcrumbs: BreadcrumbItemType[];
}>();
</script>

<template>
    <Breadcrumb>
        <template v-for="(item, index) in breadcrumbs" :key="index">
            <BreadcrumbPage v-if="index === breadcrumbs.length - 1">
                {{ item.title }}
            </BreadcrumbPage>
            <BreadcrumbLink v-else :href="item.href ?? '#'">
                {{ item.title }}
            </BreadcrumbLink>
        </template>
    </Breadcrumb>
</template>
