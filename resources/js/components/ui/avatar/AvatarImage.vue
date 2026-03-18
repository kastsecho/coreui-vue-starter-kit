<script setup lang="ts">
import { CAvatar } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import type { ImgHTMLAttributes } from 'vue';
import type { CColor, CShape } from '@/types';

type Props = ImgHTMLAttributes & {
    color?: CColor
    shape?: CShape;
    size?: 'sm' | 'md' | 'lg' | 'xl';
    status?: CColor;
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
        data-slot="avatar-image"
        :class="props.class"
        v-bind="delegatedProps"
    />
</template>
