<script setup lang="ts">
import { CBreadcrumbItem } from '@coreui/vue';
import type { HTMLAttributes } from 'vue';

interface Props {
    active?: boolean;
    class?: HTMLAttributes['class'];
}

const props = withDefaults(defineProps<Props>(), {
    active: true,
});
</script>

<template>
    <CBreadcrumbItem
        data-slot="breadcrumb-page"
        :class="props.class"
        :active="active"
    >
        <slot/>
    </CBreadcrumbItem>
</template>
