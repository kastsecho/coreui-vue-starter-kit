<script setup lang="ts">
import { CCardImage } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import type { ImgHTMLAttributes } from 'vue';

type Props = ImgHTMLAttributes & {
    as?: string;
    orientation?: 'top' | 'bottom';
    class?: ImgHTMLAttributes['class'];
};

const props = withDefaults(defineProps<Props>(), {
    as: 'img',
});

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CCardImage
        data-slot="card-image"
        :class="props.class"
        v-bind="delegatedProps"
    />
</template>
