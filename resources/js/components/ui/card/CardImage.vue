<script setup lang="ts">
import { CCardImage } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import type { ImgHTMLAttributes } from 'vue';

type Props = {
    alt?: ImgHTMLAttributes['alt'];
    as?: string;
    orientation?: 'top' | 'bottom';
    src?: ImgHTMLAttributes['src'];
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
        v-bind="delegatedProps"
        :class="props.class"
    />
</template>
