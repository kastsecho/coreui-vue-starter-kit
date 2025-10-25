<script setup lang="ts">
import type { Color, TextColor } from '@/types/coreui';
import { CCard } from '@coreui/vue';
import type { HTMLAttributes } from 'vue';

const props = defineProps<{
    color?: Color;
    textColor?: Color;
    textBgColor?: TextColor;
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <CCard
        data-slot="card"
        :class="props.class"
        :color="color"
        :text-color="textColor"
        :text-bg-color="textBgColor"
    >
        <slot/>
    </CCard>
</template>
