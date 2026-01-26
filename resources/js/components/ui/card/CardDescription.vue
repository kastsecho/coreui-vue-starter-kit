<script setup lang="ts">
import { CCardText } from '@coreui/vue';
import { type HTMLAttributes } from 'vue';
import { cn } from '@/lib/utils';

const props = defineProps<{
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <CCardText
        data-slot="card-description"
        :class="cn('text-muted', props.class)"
    >
        <slot />
    </CCardText>
</template>
