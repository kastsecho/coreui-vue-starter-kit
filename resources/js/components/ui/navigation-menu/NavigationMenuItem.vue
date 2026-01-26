<script setup lang="ts">
import { CNavItem } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import { type HTMLAttributes } from 'vue';

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
    <CNavItem
        data-slot="navigation-menu-item"
        v-bind="delegatedProps"
        :class="props.class"
    >
        <slot />
    </CNavItem>
</template>
