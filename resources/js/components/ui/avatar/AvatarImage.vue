<script setup lang="ts">
import { CAvatar } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import { type ImgHTMLAttributes } from 'vue';
import type { Color, Shape } from '@/types';

type Props = {
    alt?: ImgHTMLAttributes['alt'];
    src?: ImgHTMLAttributes['src'];
    shape?: Shape;
    size?: 'sm' | 'md' | 'lg' | 'xl';
    status?: Color;
    class?: ImgHTMLAttributes['class'];
};

const props = withDefaults(defineProps<Props>(), {
    shape: 'rounded-circle',
});

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CAvatar
        data-slot="avatar-image"
        v-bind="delegatedProps"
        :class="props.class"
    />
</template>
