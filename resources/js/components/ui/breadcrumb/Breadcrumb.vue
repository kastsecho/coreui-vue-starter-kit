<script setup lang="ts">
import { cn } from '@/lib/utils';
import { CBreadcrumb } from '@coreui/vue';
import type { HTMLAttributes } from 'vue';

const props = defineProps<{
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <CBreadcrumb
        data-slot="breadcrumb"
        :class="cn('mb-0', props.class)"
    >
        <slot/>
    </CBreadcrumb>
</template>
