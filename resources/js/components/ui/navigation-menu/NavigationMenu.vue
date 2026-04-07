<script setup lang="ts">
import { CNavbar } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';
import type {
    CColor,
    CContainer,
    CExpand,
    CNavbarPlacement,
    ResolvedAppearance,
} from '@/types';

const props = defineProps<{
    color?: CColor;
    colorScheme?: ResolvedAppearance;
    container?: CContainer;
    expand?: CExpand;
    placement?: CNavbarPlacement;
    class?: HTMLAttributes['class'];
}>();

const delegatedProps = reactiveOmit(props, 'class');
</script>

<template>
    <CNavbar
        data-slot="navigation-menu"
        v-bind="delegatedProps"
        :class="props.class"
    >
        <slot />
    </CNavbar>
</template>
