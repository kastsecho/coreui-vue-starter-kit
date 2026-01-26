<script setup lang="ts">
import type { HTMLAttributes } from 'vue';
import { cn } from '@/lib/utils';

const props = defineProps<{
    message?: string;
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <strong
        v-show="message"
        :class="cn('invalid-feedback', props.class)"
        role="alert"
    >
        {{ message }}
    </strong>
</template>
