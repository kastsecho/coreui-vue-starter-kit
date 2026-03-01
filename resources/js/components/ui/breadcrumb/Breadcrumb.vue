<script lang="ts" setup>
import { CBreadcrumb } from '@coreui/vue';
import type { HTMLAttributes } from 'vue';
import { cn } from '@/lib/utils';

const props = defineProps<{
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <CBreadcrumb
        data-slot="breadcrumb"
        aria-label="Breadcrumb"
        :class="cn('mb-0', props.class)"
    >
        <slot />
    </CBreadcrumb>
</template>
