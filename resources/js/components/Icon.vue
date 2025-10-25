<script setup lang="ts">
import { cn } from '@/lib/utils';
import type { Color } from '@/types/coreui';
import { computed, type HTMLAttributes } from 'vue';

interface Props {
    name: string;
    class?: HTMLAttributes['class'];
    color?: Color;
}

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
