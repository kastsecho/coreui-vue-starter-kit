<script setup lang="ts">
import { cn } from '@/lib/utils';
import { CCardTitle } from '@coreui/vue';
import type { HTMLAttributes } from 'vue';

const props = defineProps<{
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <CCardTitle
        data-slot="card-title"
        :class="cn('fw-semibold', props.class)"
    >
        <slot/>
    </CCardTitle>
</template>
