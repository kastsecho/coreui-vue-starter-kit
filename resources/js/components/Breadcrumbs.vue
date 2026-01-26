<script setup lang="ts">
import {
    Breadcrumb,
    BreadcrumbLink,
    BreadcrumbPage,
} from '@/components/ui/breadcrumb';
import { type BreadcrumbItem } from '@/types';

type Props = {
    breadcrumbs: BreadcrumbItem[];
};

defineProps<Props>();
</script>

<template>
    <Breadcrumb>
        <template v-for="(item, index) in breadcrumbs" :key="index">
            <template v-if="index === breadcrumbs.length - 1">
                <BreadcrumbPage>{{ item.title }}</BreadcrumbPage>
            </template>
            <template v-else>
                <BreadcrumbLink :href="item.href ?? '#'">
                    {{ item.title }}
                </BreadcrumbLink>
            </template>
        </template>
    </Breadcrumb>
</template>
