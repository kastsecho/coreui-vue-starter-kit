<script setup lang="ts">
import type { HTMLAttributes } from 'vue';
import { cn } from '@/lib/utils';
import type { AppShellVariant } from '@/types';

type Props = {
    variant?: AppShellVariant;
    class?: HTMLAttributes['class'];
};

const props = withDefaults(defineProps<Props>(), {
    variant: 'header',
});
</script>

<template>
    <div
        v-if="variant === 'header'"
        :class="cn('d-flex min-vh-100 w-100', props.class)"
    >
        <slot />
    </div>
    <div v-else :class="props.class">
        <slot />
    </div>
</template>
