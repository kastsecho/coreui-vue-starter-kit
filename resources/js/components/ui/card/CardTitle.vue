<script setup lang="ts">
import { CCardTitle } from '@coreui/vue';
import type { HTMLAttributes } from 'vue';
import { cn } from '@/lib/utils';

const props = defineProps<{
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <CCardTitle
        data-slot="card-title"
        :class="cn('fw-semibold', props.class)"
    >
        <slot />
    </CCardTitle>
</template>
