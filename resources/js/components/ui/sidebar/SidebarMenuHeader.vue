<script setup lang="ts">
import { CHeader } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';
import type { CContainer } from '@/types';

const props = defineProps<{
    container?: CContainer;
    position?: 'fixed' | 'sticky';
    class?: HTMLAttributes['class'];
}>();

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CHeader
        data-slot="sidebar-menu-header"
        v-bind="delegatedProps"
        :class="props.class"
    >
        <slot />
    </CHeader>
</template>
