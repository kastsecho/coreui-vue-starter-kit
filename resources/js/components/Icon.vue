<script setup lang="ts">
import { computed } from 'vue';
import type { HTMLAttributes } from 'vue';
import { cn } from '@/lib/utils';
import type { Color } from '@/types';

type Props = {
    name: string;
    color?: Color;
    class?: HTMLAttributes['class'];
};

const props = withDefaults(defineProps<Props>(), {
    class: '',
});

const className = computed(() => cn(icon.value, props.class));

const icon = computed(() => {
    const iconName = `bi-${props.name}`;
    return props.color ? `${iconName} text-${props.color}` : iconName;
});
</script>

<template>
    <span :class="className" aria-hidden="true" />
</template>
