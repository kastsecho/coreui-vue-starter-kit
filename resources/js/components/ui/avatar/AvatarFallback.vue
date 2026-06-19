<script setup lang="ts">
import { CAvatar } from '@coreui/vue';
import type { Colors, Shapes } from '@coreui/vue/src/types';
import { reactiveOmit } from '@vueuse/core';
import type { ImgHTMLAttributes } from 'vue';
import type { TextColors } from '@/types';

type Props = {
    color?: Colors;
    shape?: Shapes;
    size?: 'sm' | 'md' | 'lg' | 'xl';
    status?: Colors;
    textColor?: TextColors | string;
    class?: ImgHTMLAttributes['class'];
};

const props = withDefaults(defineProps<Props>(), {
    color: 'secondary',
    shape: 'rounded-circle',
    textColor: 'white',
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
