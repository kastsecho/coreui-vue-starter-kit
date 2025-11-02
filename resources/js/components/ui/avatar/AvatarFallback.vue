<script setup lang="ts">
import type { Color, Shape } from '@/types/coreui';
import { CAvatar } from '@coreui/vue';
import type { HTMLAttributes } from 'vue';

interface Props {
    color?: Color
    shape?: Shape;
    size?: 'sm' | 'md' | 'lg' | 'xl';
    status?: Color;
    class?: HTMLAttributes['class'];
}

const props = withDefaults(defineProps<Props>(), {
    color: 'secondary',
    shape: 'rounded-circle',
});
</script>

<template>
    <CAvatar
        data-slot="avatar-fallback"
        v-bind="props"
        :class="props.class"
    >
        <slot/>
    </CAvatar>
</template>
