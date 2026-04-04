<script setup lang="ts">
import { CCard } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';
import type { CBgTextColor, CColor, CTextColor } from '@/types';

const props = defineProps<{
    color?: CColor;
    textColor?: CTextColor;
    textBgColor?: CBgTextColor;
    class?: HTMLAttributes['class'];
}>();

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CCard data-slot="card" :class="props.class" v-bind="delegatedProps">
        <slot />
    </CCard>
</template>
