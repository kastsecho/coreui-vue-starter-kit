<script lang="ts" setup>
import { CBreadcrumbItem } from '@coreui/vue';
import { type HTMLAttributes } from 'vue';
import { cn } from '@/lib/utils';

const props = defineProps<{
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <CBreadcrumbItem
        data-slot="breadcrumb-page"
        role="link"
        aria-disabled="true"
        aria-current="page"
        :class="cn('text-muted', props.class)"
    >
        <slot />
    </CBreadcrumbItem>
</template>
