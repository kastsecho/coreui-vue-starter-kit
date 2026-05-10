<script setup lang="ts">
import { CCard } from '@coreui/vue';
import type { Colors } from '@coreui/vue/src/types';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';
import type { TextColors } from '@/types';

const props = defineProps<{
    color?: Colors;
    textBgColor?: Colors;
    textColor?: TextColors;
    class?: HTMLAttributes['class'];
}>();

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CCard data-slot="card" v-bind="delegatedProps" :class="props.class">
        <slot />
    </CCard>
</template>
