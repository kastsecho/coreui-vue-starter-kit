<script setup lang="ts">
import { CNavTitle } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';

type Props = {
    as?: string;
    class?: HTMLAttributes['class'];
};

const props = withDefaults(defineProps<Props>(), {
    as: 'li',
});

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CNavTitle
        data-slot="sidebar-group-label"
        data-sidebar="group-label"
        v-bind="delegatedProps"
        :class="props.class"
    >
        <slot />
    </CNavTitle>
</template>
