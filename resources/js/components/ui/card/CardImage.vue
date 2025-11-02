<script setup lang="ts">
import { CCardImage } from '@coreui/vue';
import type { HTMLAttributes, ImgHTMLAttributes } from 'vue';

const props = defineProps<{
    alt?: ImgHTMLAttributes['alt'];
    src?: ImgHTMLAttributes['src'];
    orientation?: 'top' | 'bottom';
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <CCardImage
        data-slot="card-header"
        v-bind="props"
        :class="props.class"
    />
</template>
