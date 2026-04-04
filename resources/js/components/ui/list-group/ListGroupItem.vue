<script setup lang="ts">
import { CListGroupItem } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';
import type { CColor } from '@/types';

const props = defineProps<{
    active?: boolean;
    as?: string;
    color?: CColor;
    disabled?: boolean;
    class?: HTMLAttributes['class'];
}>();

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CListGroupItem
        data-slot="list-group-item"
        v-bind="delegatedProps"
        :class="props.class"
    >
        <slot />
    </CListGroupItem>
</template>
