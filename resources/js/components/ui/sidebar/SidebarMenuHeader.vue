<script setup lang="ts">
import { CHeader } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';

type Props = {
    as?: string;
    container?: boolean | 'sm' | 'md' | 'lg' | 'xl' | 'xxl' | 'fluid';
    position?: 'fixed' | 'sticky';
    class?: HTMLAttributes['class'];
};

const props = withDefaults(defineProps<Props>(), {
    as: 'div',
});

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
