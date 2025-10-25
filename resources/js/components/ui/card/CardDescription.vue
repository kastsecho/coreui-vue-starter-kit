<script setup lang="ts">
import { cn } from '@/lib/utils';
import { CCardText } from '@coreui/vue';
import type { HTMLAttributes } from 'vue';

const props = defineProps<{
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <CCardText
        data-slot="card-description"
        :class="cn('text-muted', props.class)"
    >
        <slot/>
    </CCardText>
</template>
