<script setup lang="ts">
import { CNavbar } from '@coreui/vue';
import { reactiveOmit } from '@vueuse/core';
import { type HTMLAttributes } from 'vue';
import type { Breakpoint, Color, Container, ResolvedAppearance } from '@/types';

type Placement = 'fixed-top' | 'fixed-bottom' | 'sticky-top';

const props = defineProps<{
    color?: Color;
    colorScheme?: ResolvedAppearance;
    container?: boolean | Container;
    expand?: boolean | Breakpoint;
    placement?: Placement;
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
