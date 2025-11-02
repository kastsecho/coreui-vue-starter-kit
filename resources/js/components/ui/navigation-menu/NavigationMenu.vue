<script setup lang="ts">
import type { ResolvedAppearance } from '@/composables/useAppearance';
import type { Breakpoint, Color, Container } from '@/types/coreui';
import { CNavbar } from '@coreui/vue';
import type { HTMLAttributes } from 'vue';

type Placement = 'fixed-top' | 'fixed-bottom' | 'sticky-top';

const props = defineProps<{
    color?: Color;
    colorScheme?: ResolvedAppearance;
    container?: boolean | Container;
    expand?: boolean | Breakpoint;
    placement?: Placement;
    class?: HTMLAttributes['class'];
}>();
</script>

<template>
    <CNavbar
        data-slot="navigation-menu"
        v-bind="props"
        :class="props.class"
    >
        <slot/>
    </CNavbar>
</template>
