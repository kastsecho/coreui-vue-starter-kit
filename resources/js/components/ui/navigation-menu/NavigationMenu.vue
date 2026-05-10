<script setup lang="ts">
import { CNavbar } from '@coreui/vue';
import type { Colors } from '@coreui/vue/src/types';
import { reactiveOmit } from '@vueuse/core';
import type { HTMLAttributes } from 'vue';
import type { ResolvedAppearance } from '@/types';

type Props = {
    as?: string;
    color?: Colors;
    colorScheme?: ResolvedAppearance;
    container?: boolean | string;
    expand?: boolean | string;
    placement?: 'fixed-top' | 'fixed-bottom' | 'sticky-top';
    class?: HTMLAttributes['class'];
};

const props = withDefaults(defineProps<Props>(), {
    as: 'nav',
});

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
