<script setup lang="ts">
import { CHeader } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import { type HTMLAttributes } from 'vue';
import { Container } from '@/types';

const props = defineProps<{
    container?: boolean | Container;
    position?: 'fixed' | 'sticky';
    class?: HTMLAttributes['class'];
}>();

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CHeader
        data-slot="sidebar-header"
        data-sidebar="header"
        v-bind="delegatedProps"
        :class="props.class"
    >
        <slot />
    </CHeader>
</template>
