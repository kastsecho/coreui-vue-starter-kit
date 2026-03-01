<script setup lang="ts">
import { CCardImage } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import type { ImgHTMLAttributes } from 'vue';

const props = defineProps<{
    alt?: ImgHTMLAttributes['alt'];
    src?: ImgHTMLAttributes['src'];
    orientation?: 'top' | 'bottom';
    class?: ImgHTMLAttributes['class'];
}>();

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CCardImage
        data-slot="card-image"
        :class="props.class"
        v-bind="delegatedProps"
    />
</template>
