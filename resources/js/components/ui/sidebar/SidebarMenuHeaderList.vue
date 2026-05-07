<script setup lang="ts">
import { CHeaderNav } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';

type Props = {
    as?: string;
    class?: HTMLAttributes['class'];
};

const props = withDefaults(defineProps<Props>(), {
    as: 'ul',
});

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CHeaderNav
        data-slot="sidebar-header-list"
        v-bind="delegatedProps"
        :class="props.class"
    >
        <slot />
    </CHeaderNav>
</template>
