<script setup lang="ts">
import { CAvatar } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import type { ImgHTMLAttributes } from 'vue';
import type { CColor, CShape, CTextColor } from '@/types';

type Props = {
    color?: CColor;
    shape?: CShape;
    size?: 'sm' | 'md' | 'lg' | 'xl';
    status?: CColor;
    textColor?: CTextColor;
    class?: ImgHTMLAttributes['class'];
};

const props = withDefaults(defineProps<Props>(), {
    color: 'secondary',
    shape: 'rounded-circle',
    textColor: 'body',
});

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CAvatar
        data-slot="avatar-fallback"
        v-bind="delegatedProps"
        :class="props.class"
    >
        <slot />
    </CAvatar>
</template>
