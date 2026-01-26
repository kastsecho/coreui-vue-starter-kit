<script setup lang="ts">
import { CNavbarNav } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import { type HTMLAttributes } from 'vue';

type Props = {
    as?: string;
    class?: HTMLAttributes['class'];
};

const props = withDefaults(defineProps<Props>(), {
    as: 'nav',
});

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CNavbarNav
        data-slot="navigation-menu-list"
        v-bind="delegatedProps"
        :class="props.class"
    >
        <slot />
    </CNavbarNav>
</template>
