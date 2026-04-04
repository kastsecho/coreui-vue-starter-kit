<script setup lang="ts">
import type { HTMLAttributes } from 'vue';
import { cn } from '@/lib/utils';

type Props = {
    message?: string;
    variant?: 'default' | 'tooltip';
    class?: HTMLAttributes['class'];
};

const props = withDefaults(defineProps<Props>(), {
    variant: 'default',
});
</script>

<template>
    <strong
        v-show="message"
        :class="
            cn(
                {
                    ['invalid-feedback']: variant === 'default',
                    ['invalid-tooltip']: variant === 'tooltip',
                },
                props.class,
            )
        "
        role="alert"
    >
        {{ message }}
    </strong>
</template>
