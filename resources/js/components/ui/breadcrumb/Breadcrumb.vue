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
        aria-label="Breadcrumb"
        data-slot="breadcrumb"
        :class="cn('mb-0', props.class)"
    >
        <slot />
    </CBreadcrumb>
</template>
