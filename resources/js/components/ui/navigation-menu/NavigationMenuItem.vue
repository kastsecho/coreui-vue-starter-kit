<script setup lang="ts">
import { CNavItem } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';

type Props = {
    as?: string;
    class?: string;
};

const props = withDefaults(defineProps<Props>(), {
    as: 'li',
});

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CNavItem
        data-slot="navigation-menu-item"
        :class="props.class"
        v-bind="delegatedProps"
    >
        <slot />
    </CNavItem>
</template>
