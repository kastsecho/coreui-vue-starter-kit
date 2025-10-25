<script setup lang="ts">
import type { Color, Shape } from '@/types/coreui';
import { CAvatar } from '@coreui/vue';
import type { HTMLAttributes, ImgHTMLAttributes } from 'vue';

interface Props {
    alt?: ImgHTMLAttributes['alt'];
    src?: ImgHTMLAttributes['src'];
    shape?: Shape;
    size?: 'sm' | 'md' | 'lg' | 'xl';
    status?: Color;
    class?: HTMLAttributes['class'];
}

const props = withDefaults(defineProps<Props>(), {
    shape: 'rounded-circle',
});
</script>

<template>
    <CAvatar
        data-slot="avatar-image"
        v-bind="props"
        :class="props.class"
    />
</template>
