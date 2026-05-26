<script setup lang="ts">
import { CAvatar } from '@coreui/vue';
import type { Colors, Shapes } from '@coreui/vue/src/types';
import { reactiveOmit } from '@vueuse/core';
import type { ImgHTMLAttributes } from 'vue';

type Props = {
    alt?: ImgHTMLAttributes['alt'];
    color?: Colors;
    shape?: Shapes;
    size?: 'sm' | 'md' | 'lg' | 'xl';
    src?: ImgHTMLAttributes['src'];
    status?: Colors;
    class?: ImgHTMLAttributes['class'];
};

const props = withDefaults(defineProps<Props>(), {
    color: 'secondary',
    shape: 'rounded-3',
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
